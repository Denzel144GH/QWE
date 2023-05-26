<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Role;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminPanelController extends Controller
{
    public function index()
    {
        $search = filter_input(INPUT_GET, 'search');
        $users = User::latest();

        if ($search != null)
            $users = $users->where('name', 'like', '%' . $search . '%')->get()->reverse();
        else
            $users = $users->get()->reverse();

        return view('adminPanel', ['users' => $users]);
    }
    public function GetUpdateUser($id)
    {
        $user = User::find($id);
        $roles = new Role();
        return view('updateUser', ['users' => $user, 'roles' => $roles->get()]);
    }
    public function UpdateUser($id, Request $request)
    {
        if (auth()->user()->role_id < 2)
            return redirect()->route('mainpage')->with('danger', 'Неожиданная ошибка');
        if ($request->role_id > auth()->user()->role_id)
            return redirect()->route('adminPanel')->with('danger', 'Нельзя установить роль выше своей');


        $user = User::find($request->id);

        $this->validate($request, [
            'avatar' => 'file|mimes:jpg,jpeg,bmp,png'
        ]);


        if ($request->avatar != null) {
            $fileName = Str::random(64).'.png';
            $filePath = 'users/' . $fileName;
            $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->avatar));

            if ($isFileUploaded)
                $user->avatar = $filePath;
        }


        if ($user->email != $request->email) {
            $this->validate($request, [
                'email' => 'required|email|unique:users'
            ]);
        }


        $user->name = $request->name;
        if ($user->email != $request->email)
            $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('adminPanel')->with('success', 'Пользователь был отредактирован');
    }

    public function RapidUser($id, Request $request)
    {
        $user = auth()->user();
        $role_id = User::find($request->id)->role_id;
        if ($user->role_id < 2)
            return redirect()->route('mainpage')->with('danger', 'Неожиданная ошибка');
        if ($user->id == $id)
            return redirect()->route('adminPanel')->with('danger', 'Нельзя установить себе роль');
        if ($role_id > $user->role_id)
            return redirect()->route('adminPanel')->with('danger', 'Нельзя установить роль выше своей');
        $users = User::find($request->id);
        $users->role_id = 1;
        $users->save();

        return redirect()->route('adminPanel')->with('success', 'Роль пользователя была изменена');
    }

    public function DeleteUser($id)
    {
        if (auth()->user()->role_id < 2)
            return redirect()->route('mainpage')->with('danger', 'Неожиданная ошибка');
        if (auth()->user()->id != $id) {
            $videos = Video::where('user_id', $id)->get();

            foreach ($videos as $el) {
                $el->delete();
            }

            $comments = Comment::where('user_id',$id)->get();
            foreach ($comments as $el) {
                $el->delete();
            }

            User::find($id)->delete();

            return redirect()->route('adminPanel')->with('success', 'Пользователь был удален');
        } else
            return redirect()->route('adminPanel')->with('danger', 'Нельзя удалить себя');
    }

}
