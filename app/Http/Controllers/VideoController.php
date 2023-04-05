<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Video;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        $comments = Comment::Where('video_id', $id)->get();

        if ($video != null)
            return view('viewsVideo', ['video' => $video,'comments' =>$comments]);
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

        $fileName = Str::random(64);
        $filePath = 'videos/' . $fileName;

        $previewName = Str::random(64);
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
        $video = new Video;
        return view('updateVideo', ['video' => $video->find($id)]);
    }

    public function UpdateVideo(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:70',
            'preview' => 'file|mimes:jpg,jpeg,bmp,png',
            'description' => 'string|max:255',
        ]);
        if ($request->preview != null) {
            $previewName = Str::random(64);
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
        Video::find($id)->delete();
        return redirect()->route('user.profile')->with('success', 'Видео было удалено');
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
}
