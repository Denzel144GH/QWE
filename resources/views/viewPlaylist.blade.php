@extends('layout')
@section('title') @endsection
@section('main_content')

<div class="container">
        <div class="sidenav">
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Clients</a>
            <a href="#">Contact</a>
        </div>

        <!-- Page content -->
    @foreach($playlist as $el)
        <tr>
            <td><strong>{{$el->name}}</strong></td>
            <td><a class="btn btn-outline-info" href="{{route('playlist.show',$el->id)}}">Посмотреть</a></td>
            <td>
                <a ><button type="button" class="btn btn-outline-danger yd">Удалить</button></a>
                <a ><button type="button" class="btn btn-outline-warning yd">Отредактировать</button></a>
            </td>
        </tr>
    @endforeach
</div>
    <style>
        /* The sidebar menu */
        .sidenav {
            height: 100%; /* Full-height: remove this if you want "auto" height */
            width: 160px; /* Set the width of the sidebar */
            position: fixed; /* Fixed Sidebar (stay in place on scroll) */
            background-color: #111; /* Black */
            overflow-x: hidden; /* Disable horizontal scroll */
            padding-top: 20px;
        }

        /* The navigation menu links */
        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
        }

        /* When you mouse over the navigation links, change their color */
        .sidenav a:hover {
            color: #f1f1f1;
        }

        /* Style page content */
        .main {
            margin-left: 160px; /* Same as the width of the sidebar */
            padding: 0px 10px;
        }


    </style>
@endsection
