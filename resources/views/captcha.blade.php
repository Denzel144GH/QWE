@extends('layout')
@section('title')Проверка авторизации@endsection
@section('main_content')
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<div class="container">
    <center>
    <svg class="bd-placeholder-img card-img-top crum" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
        <rect  width="100%" height="100%" ></rect></svg>

    <div class="card-body">
        <h1 class="card-title">Ожидайте подтверждение учетной записи</h1>

        <a href="/profile" class="btn btn-success">Обновить</a>
    </center>
    </div>
</div>
</body>
</html>
<style>
.crum{
    border-radius: 5px;

    fill: #20c997;
}
</style>
@endsection

