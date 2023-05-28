@extends('layout')
@section('title') @endsection
@section('main_content')


<div class="container">
    <form action="{{route('playlist.watch',$playlist->id)}}" method="get">
        <input name="search" value="" type="search">
        <button class="flest btn-outline-success" type="submit">Поиск</button>
    </form>
    <br>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" onclick="this.parentElement.style.display='none';" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="row">
        <h4 class="center">{{$playlist->name}}</h4>
        <a class="btn btn-outline-info" href="{{route('playlist.add.video.form',$playlist->id)}}">Добавить видео</a>

        <table class="table table-bordered mgtop ">
            <thead class="thead-light">

                <tr>
                    <th scope="col">Имя</th>
                    <th scope="col">Превью</th>
                    <th scope="col">Содержание</th>
                    @if($playlist->user_id == Auth::user()->id)
                    <th scope="col">Инструменты</th>
                    @endif
                </tr>
            </thead>
            @foreach($plVideos as $el)
            <tr>
                <td>
                    <p>{{$el->video->title}}</p>
                </td>
                <td>
                    @if($el->video->preview == null)
                    <img src="{{ Storage::url('default.png') }}" alt="" class="_9Vd+W3TCjDmuEV7tOCemNA==">
                    @else
                    <img src="{{ Storage::url($el->video->preview) }}" width="120" height="120" alt="" class="_9Vd+W3TCjDmuEV7tOCemNA==">
                    @endif
                </td>
                <td><a class="btn btn-outline-info" href="{{route('video.watch',$el->video->id)}}">Посмотреть</a></td>
                @if($playlist->user_id == Auth::user()->id)
                <td>
                    <a><button type="button" class="btn btn-outline-danger yd">Удалить</button></a>
                    <a><button type="button" class="btn btn-outline-warning yd">Отредактировать</button></a>
                </td>
                @endif
            </tr>


            @endforeach
        </table>
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
        border: 5px solid #000000;
        margin-top: 20pt;
        margin-left: 20pt;
        margin-right: 20pt;
        margin-bottom: 20pt;
        border-radius: 15px;
        border-color: #000000;
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
        width: 80px;
        height: 42px;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        padding: 5px;
    }

    .center {
        display: block;
        margin-left: auto;
        margin-right: auto
    }
</style>
@endsection