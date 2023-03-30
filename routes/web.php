<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DefController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\Admin\DownloadController;

//use App\Http\Controllers\PostController;

use App\Models\Movie;
use App\Models\Download;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  [MainController::class,'home'])->name('mainpage');

Route::get('/about', function(){
    return view('about');
});
Route::get('/films', [MainController::class,'films']);
Route::get('/films/{id}', [MainController::class,'filmsId']);
Route::get('/ticket/{idSeance}', [MainController::class,'ticketbuy']);
Route::resource('/news', NewsController::class);

Route::name('user.')->group(function(){

    Route::get('/profile',[AuthController::class,'profile'])->middleware('auth')->name('profile');

    Route::get('/login', function(){
        if(Auth::check()){
            return redirect(route('user.profile'));
        }
        return view('login');
    })->name('login');

    Route::post('/login',[AuthController::class,'login']);

    Route::get('/logout', function(){
        if(Auth::check())
        Auth::logout();
        return redirect('/');
    })->name('logout');

    Route::get('/registration', function(){
        if(Auth::check()){
            return redirect(route('user.profile'));
        }
        return view('register');
    })->name('registration');
    Route::post('/registration',[AuthController::class,'register']);




});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});




//Route::post('/post','post');

Route::resource('/download', 'DownloadController')->only(['store', 'update', 'destroy']);
Route::get('/download/{download?}', ['DownloadController'])->name('download');

//Route::post('/default', ['DefController'])->name('image.upload');
Route::post('/default',  [DefController::class,'default']);

Route::get('/video-upload', [ VideoController::class, 'GetVideoUploadForm' ])->name('get.video.upload'); //
Route::post('/video-upload', [ VideoController::class, 'UploadVideo' ])->name('store.video');            //

Route::get('/updateVideo/{id}', [ VideoController::class, 'GetUpdateVideo' ]);
Route::post('/updateVideo/{id}', [ VideoController::class, 'UpdateVideo' ])->name('update.video');

Route::get('/deleteVideo/{id}', [ VideoController::class, 'DeleteVideo' ]);
Route::post('/deleteVideo/{id}', [ VideoController::class, 'DeleteVideo' ])->name('delete-video');
//
//
//Route::get('/video/all',[ VideoController::class, 'videoall' ]);

Route::get('/video/{id}', [VideoController::class,'ShowVideo'])->name('video.show');

