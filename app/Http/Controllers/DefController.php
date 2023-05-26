<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefController extends Controller
{
    public function upload(Request $request)
    {
        $path = $request->file('image')->store('uploads', 'public');

        return view('default', [$path => $path]);
    }
}
