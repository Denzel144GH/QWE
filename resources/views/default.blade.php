@extends('layout')
@section('title')Видео @endsection
@section('main_content')

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <form action="{{image.upload}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="from-group">
            <input type="file" name="image">
        </div>
        <button class="btn btn-default" type="submit">Загрузка</button>
    </form>
    @isset($path)
    <img class="img-gfluid" src="{{asset('/storage/'.$path)}}" alt="">
    @endisset
</head>

<body>

</body>

</html>
@endsection