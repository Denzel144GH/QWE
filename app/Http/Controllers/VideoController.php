<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function GetVideoUploadForm()
    {
        return view('videoupload');
    }
    public function ShowVideo($id)
    {
        $video = Video::find($id);
        $video->views = $video->views+1;
        $video->save();

        if($video != null)
            return view('viewsVideo', ['video' => $video]);
        else
            return abort(404);
    }

    public function UploadVideo(Request $request)
    {

        $this->validate($request,[
            'title' => 'required|string|max:70',
            'video' => 'required|file|mimetypes:video/webm',
            'preview' => 'required|file|mimes:jpg,jpeg,bmp,png',
            'description' => 'required|string|max:255',
        ]);

        $fileName = $request->video->getClientOriginalName();
        $filePath = 'videos/' . $fileName;

        $previewName = $request->preview->getClientOriginalName();
        $previewPath = 'preview/' . $previewName;

        $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));
        $isPreviewUploaded = Storage::disk('public')->put($previewPath, file_get_contents($request->preview));

        $url = Storage::disk('public')->url($filePath);

        if ($isFileUploaded && $isPreviewUploaded ) {
            $video = new Video();
            $video->title = $request->title;
            $video->description = $request->description;
            $video->path = $filePath;
            $video->preview = $previewPath;
            $video->user_id = Auth::user()->id;
            $video->views =0;
            $video->save();

            return back()
                ->with ('success','Видео успешно загружено.');
        }

        return back()
            ->with('error','Произошла непредвиденная ошибка');
    }

    public function GetUpdateVideo($id){
        $video = new Video;
        return view('updateVideo', ['video' => $video->find($id)]);
    }

    public function UpdateVideo(Request $request, $id){
        $this->validate($request,[
            'title' => 'required|string|max:70',
            'preview' => 'required|file|mimes:jpg,jpeg,bmp,png',
            'description' => 'required|string|max:255',
        ]);

        $previewName = $request->preview->getClientOriginalName();
        $previewPath = 'preview/' . $previewName;
        $isPreviewUploaded = Storage::disk('public')->put($previewPath, file_get_contents($request->preview));

        if ($isPreviewUploaded) 
        {

            $video = new Video();
            $video = $video->find($request->id);
            $video->title = $request->title;
            $video->description = $request->description;
            $video->preview = $previewPath;
            $video->save();

            return back()
                ->with ('success','Успешно отредактировано.');
        }
        
        return back()
            ->with('error','Произошла непредвиденная ошибка');
    }

    public function deleteVideo($id){

        Video::find($id)->delete();
    }
//    public function index()
//    {
//     $video
//
//        return view('videoupload', ['video' => $video->all()]);
//    }

}
