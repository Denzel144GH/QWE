@extends('layout')
@section('title')Админ панель@endsection
@section('main_content')
@auth
<form action="{{route('adminPanel')}}" method="get">
    <input name="search" value="" type="search">
    <button class="flest btn-outline-success" type="submit">Поиск</button>
</form>
<br>
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" onclick="this.parentElement.style.display='none';" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($message = Session::get('danger'))
    <div class="alert alert-danger alert-block">
        <button type="button" onclick="this.parentElement.style.display='none';" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <table class="table table-bordered ">
        <thead class="thead-light">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Имя</th>
                <th scope="col">Е-mail</th>
                <th scope="col">Аватар</th>
                <th scope="col">Role-id</th>
                <th scope="col">Инструменты</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td><img class="erqt" src="{{ Storage::url($user->avatar) }}" width="45" height="45"></img></td>
                <td>{{$user->role_id}}</td>
                <td>
                    <a href="{{route('delete.user',$user->id)}}"><button type="button" class="btn btn-outline-danger yd">Удалить</button></a>
                    <a href="{{route('profile.update',$user->id)}}"><button type="button" class="btn btn-outline-warning yd">Отредактировать</button></a>
                    <a href="{{route('rapid.User',$user->id)}}"><button type="button" class="btn btn-outline-success yd">Повысить</button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endauth
<style>
    .yd {
        margin: 5px;
    }

    * {
        box-sizing: border-box;
    }

    form {
        position: relative;
        width: 300px;
        margin: 0 auto;
    }
.erqt{
    border-radius: 50%;
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
</style>
@endsection
