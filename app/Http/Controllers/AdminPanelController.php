<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
        $users = new User();
        return view('updateUser', ['users' => $users->find($id)]);
    }
    public function UpdateUser($id, Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|unique:users',

        ]);

        $users = new User();
        $users = $users->find($request->id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->role_id = $request->role_id;
        $users->save();

        return redirect()->route('adminPanel')->with('success', 'Пользователь был отредактирован');
    }

    public function RapidUser($id, Request $request)
    {

        $users = new User();
        $users = $users->find($request->id);
        $users->role_id = $request->role_id = 1;
        $users->save();

        return redirect()->route('adminPanel')->with('success', 'Роль пользователя была изменнена');
    }
    public function DeleteUser($id)
    {
        $videos = Video::all();

        foreach ($videos->where('user_id', $id) as $el) {
            $el->delete();
        }

        User::find($id)->delete();

        return redirect()->route('adminPanel')->with('success', 'Пользователь был удален');
    }
}
