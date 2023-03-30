<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class MainController extends Controller
{
    public function home()
    {
        $movies = new Movie();
        return view('home', ['movies' => $movies->latest()->limit(4)->get()->Reverse()]);
    }
    public function films()
    {
        $movies = new Movie();
        //dd($seances->whereDate('seanceDate', Carbon::today()->toDateString())->get());
        return view('films', ['movies' => $movies->all()]);
    }
    public function filmsId($id)
    {
        $movies = new Movie();
        $seances = new Seance();    
        if($movies->find($id) != null)
            return view('filmpage', ['movie' => $movies->find($id),
                                     'seances' => $seances->whereDate('seanceDate', Carbon::today()->toDateString())->where('idMovie','=', $id)->get()]);
        else
            return abort(404);
    }
    public function ticketbuy($idSeance)
    {
        $seances = new Seance();
        return view('ticketbuy',['seance' => $seances->find($idSeance)]);
    }
    public function test(Request $request)
    {
        dd($request);
    }
    
}
