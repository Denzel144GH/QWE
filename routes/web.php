<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DefController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DownloadController;

//use App\Http\Controllers\PostController;

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

Route::get('/',  [MainController::class, 'home'])->name('mainpage');

Route::name('user.')->group(function () {

    Route::get('/login', function () {
        if (Auth::check()) {
            return redirect(route('user.profile'));
        }
        return view('login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/logout', function () {
        if (Auth::check())
            Auth::logout();
        return redirect('/');
    })->name('logout');

    Route::get('/registration', function () {
        if (Auth::check()) {
            return redirect(route('user.profile'));
        }
        return view('register');
    })->name('registration');
    Route::post('/registration', [AuthController::class, 'register']);


    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

        #user update profile
        Route::get('/profile/update/{id}', [UserController::class, 'GetUpdateUser'])->name('profile.update.form');
        Route::post('/profile/update/{id}', [UserController::class, 'UpdateUser'])->name('profile.update');
    });
});

Route::name('video.')->group(function () {

    Route::get('/video/watch/{id}', [VideoController::class, 'ShowVideo'])->name('watch');


    #video only if auth
    Route::middleware(['auth'])->group(function () {

        #video upload
        Route::get('/video/upload', [VideoController::class, 'GetVideoUploadForm'])->name('upload.form'); 
        Route::post('/video/upload', [VideoController::class, 'UploadVideo'])->name('upload');            

        #video update
        Route::get('/video/update/{id}', [VideoController::class, 'GetUpdateVideo'])->name('update.form');
        Route::post('/video/update/{id}', [VideoController::class, 'UpdateVideo'])->name('update');

        #video delete
        Route::get('/video/delete/{id}', [VideoController::class, 'DeleteVideo'])->name('delete.form');
        Route::post('/video/delete/{id}', [VideoController::class, 'DeleteVideo'])->name('delete');
    });
});


Route::name('playlist.')->group(function () {

    Route::get('/playlist/watch/{id}', [VideoController::class, 'ShowPlaylist'])->name('watch');

    #playlist only if auth
    Route::middleware(['auth'])->group(function () {

        Route::get('/playlist/my', [VideoController::class, 'ViewMyPlaylist'])->name('watch.my');

        Route::get('/playlist/{id}/add/video', [VideoController::class, 'AddVideoToPlaylistView'])->name('add.video.form'); 
        Route::post('/playlist/{id}/add/video', [VideoController::class, 'AddVideoToPlaylist'])->name('add.video'); 
    });
});

Route::middleware(['auth'])->group(function () {

    Route::get('/updatePlaylist/{id}', [VideoController::class, 'GetUpdatePlaylist']);
    Route::post('/updatePlaylist/{id}', [VideoController::class, 'UpdatePlaylist'])->name('update.playlist');

    Route::get('/video-upload', [VideoController::class, 'GetVideoUploadForm'])->name('get.video.upload'); //
    Route::post('/video-upload', [VideoController::class, 'UploadVideo'])->name('store.video');            //

    Route::get('/updateVideo/{id}', [VideoController::class, 'GetUpdateVideo']);
    Route::post('/updateVideo/{id}', [VideoController::class, 'UpdateVideo'])->name('update.video');

    Route::get('/deleteVideo/{id}', [VideoController::class, 'DeleteVideo']);
    Route::post('/deleteVideo/{id}', [VideoController::class, 'DeleteVideo'])->name('delete.video');

    Route::get('/updateUser/{id}', [AdminPanelController::class, 'GetUpdateUser']);
    Route::post('/updateUser/{id}', [AdminPanelController::class, 'UpdateUser'])->name('update.user');

    Route::get('/ViewAllPlaylist', [VideoController::class, 'ViewAllPlaylist'])->name('view.all.playlists');


    Route::post('/video/{id}', [VideoController::class, 'AddComment'])->name('coments.check');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/adminPanel', [AdminPanelController::class, 'index'])->name('adminPanel');

    Route::get('/updateUser/{id}', [AdminPanelController::class, 'GetUpdateUser']);
    Route::post('/updateUser/{id}', [AdminPanelController::class, 'UpdateUser'])->name('profile.update');

    Route::get('/RapidUser/{id}', [AdminPanelController::class, 'RapidUser']);
    Route::post('/RapidUser/{id}', [AdminPanelController::class, 'RapidUser'])->name('rapid.User');

    Route::get('/CreatePlaylist', [VideoController::class, 'ViewPlaylist']);
    Route::post('/CreatePlaylist', [VideoController::class, 'CreatePlaylist'])->name('create.playlist');


    Route::get('/deleteUser/{id}', [AdminPanelController::class, 'DeleteUser']);
    Route::post('/deleteUser/{id}', [AdminPanelController::class, 'DeleteUser'])->name('delete.user');

    Route::get('/RapidUser/{id}', [AdminPanelController::class, 'RapidUser']);
    Route::post('/RapidUser/{id}', [AdminPanelController::class, 'RapidUser'])->name('rapid.User');
});