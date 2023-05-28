@extends('layout')
@section('title') Профиль @endsection
@section('main_content')
    <?php
    use App\Models\Video;

    $user = auth()->user();
    $video = new Video();
    $video = $video->all()->where('user_id', $user->id);
    ?>
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" onclick="this.parentElement.style.display='none';" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if($user->avatar == null)
            <img src="{{ Storage::url('default.png') }}" alt="" class="_9Vd+W3TCjDmuEV7tOCemNA==">
        @else
            <img src="{{ Storage::url($user->avatar) }}" alt="" class="_9Vd+W3TCjDmuEV7tOCemNA==">
        @endif

        <h1 class="formdatacreate">
            {{$user->name}}
        </h1>
        <div class="">
            Дата регистрации:
        </div>
        <div>
            <a href=""> </a>
        </div>
        <div class="">
            {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d.m.Y')}}
        </div>

        <h3 class="center">
            Мои видео
        </h3>
        <div class=" row">
            @foreach($video as $el)

                <p class="col temp hy text-light">
                <table>
                    <tr>
                        <td rowspan="5" class="first"><a href="{{route('video.watch',$el->id)}}"> <img src="{{ Storage::url($el->preview) }}" ></img></a></td>
                        <td><strong>{{$el->title}}</strong></td>
                    </tr>
                    <tr>
                        <td>{{$el->user_id}}</td>
                    </tr>
                    <tr>
                        <td>{{$el->views}}</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{route('video.delete',$el->id)}}"><button type="button" class="btn btn-outline-danger">Удалить</button></a>
                            <a href="{{route('video.update.form',$el->id)}}"><button type="button" class="btn btn-outline-warning">Отредактировать</button></a>
                        </td>
                    </tr>
                </table>
                </p>

            @endforeach
        </div>
    </div>


@endsection

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
        border-radius: 30px;
    }

    a {
        text-decoration: none;

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
        width: 144px;
        height: 144px;
        border-radius: 50%;
    }

    body {
        background-image: initial;
        background-color: rgb(32, 34, 36);
        color: rgb(232, 230, 227);
    }
    .formdatacreate{
        text-align:center;
    }
    .center{
        text-align:center;
    }
</style>
