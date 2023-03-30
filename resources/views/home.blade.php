@extends('layout')
@section('title') Главная страница @endsection
@section('main_content')
    <?php
    use App\Models\Video;
    use App\Models\Ticket;
    $user = auth()->user();
    $video = new Video();
    $video = $video->all();
    ?>
<div class="container">

    <div class=" row">
            @foreach($video as $el)

            <a class="col temp hy text-light" href="video/1">
            <table>
                <tr>
                    <td rowspan="5" class="first"><img  src="{{ Storage::url($el->preview) }}" width="256" height="256"></img></td>
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
        .hy{
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
    </style>
@endsection