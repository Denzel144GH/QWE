@extends('layout')
@section('title') @endsection
@section('main_content')
<?php

use App\Models\User;

$user = User::where('id', $video->user_id)->get()->first();
?>
<div class="container">
    <br>
    <video width="100%" controls>
        <source src="{{Storage::url($video->path)}}" type="video/mp4">
    </video>
    <div>
        <h1>{{$video->title}}</h1>
        <table>
            <tr>
            <td rowspan="5" class="first"><img  src="{{ Storage::url($user->avatar) }}" width="64" height="64"></img></td>
                <td><strong>{{$user->name}}</strong></td>
            </tr>
            <tr>

                <td>{{$video->des}}</td>
            </tr>
            <tr>
                <td>{{$video->views}} просмотров</td>
            </tr>
        </table>
    </div>
    <form class="decor " method="post" action="{{ route('coments.check') }}">

        <div class="form-inner">

            <textarea placeholder="Сообщение..." value="description"name="description" rows="3"></textarea>
            <input type="submit" value="Отправить">
        </div>

        <div class="container xr ">

            <img  src="{{ Storage::url($user->avatar) }}" width="40" height="40">
            <strong>Гусли</strong>
            <h3 class="txtcomment">укоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапв</h3>
        </div>

        <div class="container xr">
            <img  src="{{ Storage::url($user->avatar) }}" width="40" height="40">
            <h3 class="txtcomment">укоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапв</h3>
        </div>
        <div class="container xr">
            <img  src="{{ Storage::url($user->avatar) }}" width="40" height="40">
            <h3 class="txtcomment">укоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапв</h3>
        </div>
        <div class="container xr">
            <img  src="{{ Storage::url($user->avatar) }}" width="40" height="40">
            <h3 class="txtcomment">укоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапвукоывапвыапв</h3>
        </div>

    </form>
</div>
<style>
    .image {
        border-radius: 50%;
    }
    * {
        box-sizing: border-box;
    }




    .form-inner {
        padding: 50px;
    }
    .form-inner input, .form-inner textarea {
        display: block;
        width: 100%;
        padding: 0 20px;
        margin-bottom: 10px;
        background: white;
        line-height: 40px;
        border-width: 0;
        border-radius: 20px;

    }
    .form-inner input {
        margin-top: 30px;
        background: white;
        font-size: 16px;

    }
    .form-inner textarea {
        resize: none;
    }
    .txtcomment{
        font-size: 16px;
        overflow-wrap: anywhere;
        margin-top: 15px;
        margin-left: 10px;

    }

    .xr{
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
