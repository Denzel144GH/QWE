<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
use App\Models\coment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function coments_check(Request $request){
        $valid =$request->validate([
            'description' => '|string|max:255',
        ]);
        $review = new Coment();
        $review->description = $request->description;
        $review->user_id = Auth::user()->id;
        $review->save();
    }
}
