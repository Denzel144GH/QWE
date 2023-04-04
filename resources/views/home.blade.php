@extends('layout')
@section('title') Главная страница @endsection
@section('main_content')
<?php

?>
<div class="container">
    <form action="{{route('mainpage')}}" method="get">
        <input name="search" value="" type="search">
        <button class="flest" type="submit">🔎</button>
    </form>
    <div class=" row">
        @foreach($videos as $el)
        <a class="col temp hy text-light" href="{{route('video.show',$el->id)}}">
            <table>
                <tr>
                    <td rowspan="5" class="first"><img src="{{ Storage::url($el->preview) }}" width="256" height="256"></img></td>
                    <td><strong>{{$el->title}}</strong></td>
                </tr>
                <tr>
                    <td>{{$el->user_id}}</td>
                </tr>
                <tr>
                    <td>{{$el->views}}</td>
                </tr>
            </table>
        </a>
        @endforeach
    </div>
</div>
<style scoped>
    .hy:hover {
        transform: scale(1.05);
        cursor: pointer;
        text-decoration: none;
    }

    .hy {
        transition: .5s ease;
        box-sizing: border-box;
        text-decoration: none;
    }

    a {
        text-decoration: none;
        color: #FFFFFF;
    }


    td {
        font-size: 1.5em;
        padding: 5px;
        text-align: left;
    }

    .first {
        font-size: 1em;
        font-weight: bold;
        text-align: center;
    }

    .temp {
        border: 5px solid white;
        margin-top: 20pt;
        margin-left: 20pt;
        margin-right: 20pt;
        margin-bottom: 20pt;
        border-radius: 15px;
        border-color: #F4F1F8;
        width: 450pt;
        word-break: break-word;

    }

    img {
        padding: 15px;
    }

    * {
        box-sizing: border-box;
    }

    form {
        position: relative;
        width: 300px;
        margin: 0 auto;
    }

    input {
        width: 100%;
        height: 42px;
        padding-left: 10px;
        border: 3px solid #232526;
        border-radius: 5px;
        outline: none;
        background: #F9F0DA;
        color: #000000;
    }

    .flest {
        position: absolute;
        top: 0;
        right: 0px;
        width: 42px;
        height: 42px;
        border: none;
        background: #5e9d75;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
    }
</style>
@endsection