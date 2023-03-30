<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
class MainController extends Controller
{
    public function home()
    {
        $search = filter_input(INPUT_GET, 'search');
        $videos = Video::latest()->limit(10);

        if($search != null)
            $videos = $videos->where('title','like', '%'.$search.'%')->get()->reverse();
        else
            $videos = $videos->get()->reverse();

        return view('home', ['videos' => $videos]);
    }

}
