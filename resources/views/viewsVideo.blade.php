@extends('layout')
@section('title') @endsection
@section('main_content')

<div class="container">
    <br>
    <video class="videow" controls
        poster="{{Storage::url($video->preview)}}"
        preload="auto">
        <source src="{{Storage::url($video->path)}}">
    </video>
    <div>
        <h1>{{$video->title}}</h1>
        <table>
            <tr>
                <td rowspan="5" class="first"><img class="image" src="{{ Storage::url($video->user->avatar) }}" width="64" height="64"></img></td>
                <td><strong>{{$video->user->name}}</strong></td>
            </tr>
            <tr>
                <td>{{$video->des}}</td>
            </tr>
            <tr>
                <td>{{$video->views}} просмотров</td>
            </tr>
        </table>
    </div>
    @if(auth()->user() != null && auth()->user()->role_id > 0)
    <form class="decor " method="post" action="{{ route('coments.check',$video->id) }}">
        @csrf
        <div class="form-inner">
            <textarea placeholder="Сообщение..." value="content" name="content" rows="3"></textarea>
            <input type="submit" value="Отправить">
        </div>
    </form>
    @endif
    @foreach($comments as $comment)
    <div class="container xr">
        <img class="image" src="{{ Storage::url($comment->user->avatar) }}" width="40" height="40">
        <strong>{{$comment->user->name}}</strong>
        <strong>{{$comment->created_at}}</strong>
        <h3 class="txtcomment">{{$comment->content}}</h3>
    </div>
    @endforeach

</div>

<style>
    .image {
        border-radius: 50%;
    }

    * {
        box-sizing: border-box;
    }

    .videow{
        background-color: #000000;
        position: relative;
        left: 15%;
        width: 800px;
        height: 450px;
    }


    .form-inner {
        padding: 50px;
    }

    .form-inner input,
    .form-inner textarea {
        display: block;
        width: 100%;
        padding: 0 20px;
        margin-bottom: 10px;
        background: #dfe0e1;
        line-height: 40px;
        border-width: 0;
        border-radius: 20px;
    }

    .form-inner input {
        margin-top: 30px;
        background: #dddee0;
        font-size: 16px;

    }

    .form-inner textarea {
        resize: none;
    }

    .txtcomment {
        font-size: 16px;
        overflow-wrap: anywhere;
        margin-top: 15px;
        margin-left: 10px;

    }

    .xr {
        width: 60%;
        height: 70%;
        margin: 35px;
        padding-bottom: 10px;
        padding-top: 10px;
        border-radius: 15px;
        background-color: rgba(179, 183, 183, 0.4);
    }
</style>
@endsection
