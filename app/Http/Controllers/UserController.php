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
    public function UpdateUser($id, Request $request)
    {

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
        $user->save();

        return redirect()->route('adminPanel')->with('success', 'Пользователь был отредактирован');
    }
    public function GetUpdateUser($id)
    {
        $user = User::find($id);
        return view('updateUser', ['users' => $user]);
    }
}