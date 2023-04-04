<?php

namespace App\Http\Controllers;

use App\Models\Video;

class MainController extends Controller
{
    public function home()
    {
        $search = filter_input(INPUT_GET, 'search');
        $videos = Video::latest()->limit(10);

        if ($search != null)
            $videos = $videos->where('title', 'like', '%' . $search . '%')->get()->reverse();
        else
            $videos = $videos->get()->reverse();

        return view('home', ['videos' => $videos]);
    }
}
