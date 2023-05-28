<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Playlist;
use App\Models\PlaylistVideo;
use App\Models\Video;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function GuzzleHttp\Promise\all;

class VideoController extends Controller
{
    public function GetVideoUploadForm()
    {
        return view('videoupload');
    }
    public function ShowVideo($id)
    {
        $video = Video::find($id);
        $video->views = $video->views + 1;
        $video->save();

        $comments = Comment::Where('video_id', $id)->get()->reverse();

        if ($video != null)
            return view('viewsVideo', ['video' => $video, 'comments' => $comments]);
        else
            return abort(404);
    }

    public function UploadVideo(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|string|max:70',
            'video' => 'required|file|mimetypes:video/mp4',
            'preview' => 'required|file|mimes:jpg,jpeg,bmp,png',
            'description' => 'required|string|max:255',
        ]);

        $fileName = Str::random(64) . '.mp4';
        $filePath = 'videos/' . $fileName;

        $previewName = Str::random(64) . '.png';
        $previewPath = 'preview/' . $previewName;

        $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));
        $isPreviewUploaded = Storage::disk('public')->put($previewPath, file_get_contents($request->preview));

        //$url = Storage::disk('public')->url($filePath);

        if ($isFileUploaded && $isPreviewUploaded) {
            $video = new Video();
            $video->title = $request->title;
            $video->description = $request->description;
            $video->path = $filePath;
            $video->preview = $previewPath;
            $video->user_id = Auth::user()->id;
            $video->views = 0;
            $video->save();

            return back()
                ->with('success', 'Видео успешно загружено.');
        }

        return back()
            ->with('error', 'Произошла непредвиденная ошибка');
    }

    public function GetUpdateVideo($id)
    {
        $video = Video::find($id);
        if ($video == null)
            abort(404);
        if ($video->user->id == auth()->user()->id)
            return view('updateVideo', ['video' => $video]);
        else
            abort(403);
    }

    public function UpdateVideo(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required|string|max:70',
            'preview' => 'file|mimes:jpg,jpeg,bmp,png',
            'description' => 'string|max:255',
        ]);
        if ($request->preview != null) {
            $previewName = Str::random(64) . '.png';
            $previewPath = 'preview/' . $previewName;
            $isPreviewUploaded = Storage::disk('public')->put($previewPath, file_get_contents($request->preview));
        }

        if ($request->preview == null || $isPreviewUploaded) {

            $video = new Video();
            $video = $video->find($request->id);
            $video->title = $request->title;
            $video->description = $request->description;
            if ($request->preview != null)
                $video->preview = $previewPath;
            $video->save();

            return redirect()->route('user.profile')->with('success', 'Видео было успешно обновлено');
        }

        return back()
            ->with('error', 'Произошла непредвиденная ошибка');
    }

    public function deleteVideo($id)
    {
        $video = Video::find($id);
        if ($video->user->id != auth()->user()->id)
            abort(403);
        else {
            $comments = Comment::where('video_id', $id)->get();

            foreach ($comments as $el) {
                $el->delete();
            }
            $video->delete();
            return redirect()->route('user.profile')->with('success', 'Видео было удалено');
        }
    }
    public function AddComment(Request $request, $id)
    {
        $this->validate($request, [
            'content' => '|string|max:255',
        ]);
        $comment = new Comment();
        $comment->video_id = $id;
        $comment->user_id = Auth::user()->id;
        $comment->content = $request->content;
        $comment->save();
        return back();
    }
    public function CreatePlaylist(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:70',
        ]);

        $playlist = Playlist::create([

            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'views' => value(0),


        ]);
        return redirect()->route('playlist.watch.my')->with('success', 'Плейлист был успешно загружен');
    }

    public function AddVideoToPlaylistView($id)
    {

        $playlist = Playlist::find($id);

        $videos = Video::where('user_id', auth()->user()->id)->get();

        return view('playlistAddVideos', ['playlist' => $playlist, 'videos' => $videos]);
    }
    public function AddVideoToPlaylist($id, Request $request)
    {
        $this->validate($request, [
            'video_id' => 'required',
        ]);

        PlaylistVideo::create([

            'playlist_id' => $id,
            'video_id' => $request->video_id,
        ]);

        return redirect()->route('playlist.watch', $id)->with('success', 'Успешно');
    }


    public function ViewPlaylist()
    {
        return view('playlistCreate');
    }
    public function ViewAllPlaylist()
    {
        $playlists = Playlist::get();

        return view('viewAllPlaylist', ['playlists' => $playlists]);
    }
    public function ViewMyPlaylist()
    {
        $playlist = Playlist::where('user_id', Auth::user()->id)->get();

        return view('viewMyPlaylist', ['playlist' => $playlist]);
    }

    public function SearchPlaylist()
    {
        $search = filter_input(INPUT_GET, 'search');
        $playlist = new Playlist;

        if ($search != null)
            $playlist = $playlist->where('name', 'like', '%' . $search . '%')->get()->reverse();
        else
            $playlist = $playlist->get()->reverse();

        return view('viewMyPlaylist', ['playlist' => $playlist]);
    }

    public function ShowPlaylist($id)
    {
        $playlist = Playlist::find($id);
        $playlist->views = $playlist->views + 1;
        $playlist->save();

        $plVideos = PlaylistVideo::where('playlist_id', '=', $playlist->id)->get();

        if ($playlist != null)
            return view('viewPlaylist', ['plVideos' => $plVideos], ['playlist' => $playlist]);
        else
            return abort(404);
    }
    //    public function DeletePlaylist($id){
    //        $playlist = Playlist::find($id);
    //        if($playlist->user->id != auth()->user()->id)
    //            abort(403);
    //        else
    //        {
    //            $comments = Comment::where('video_id', $id)->get();
    //
    //            foreach ($comments as $el) {
    //                $el->delete();
    //            }
    //            $video->delete();
    //            return redirect()->route('user.profile')->with('success', 'Видео было удалено');
    //        }
    //    }

    public function UpdatePlaylist(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|string|max:70',
        ]);

        $playlist = new Playlist();
        $playlist = $playlist->find($request->id);
        $playlist->name = $request->name;
        $playlist->save();

        return view('update.playlist', ['playlist' => $playlist]);
    }
    public function GetUpdatePlaylist($id)
    {
        $playlist = Playlist::find($id);
        return view('updatePlaylist', ['playlist' => $playlist]);
    }
}
