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
</div>
<style>
    .image {
        border-radius: 50%;
    }
</style>
@endsection