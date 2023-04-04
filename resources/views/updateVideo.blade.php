@extends('layout')
@section('title')Обновление записи @endsection
@section('main_content')

    <!DOCTYPE html>
<html>
<head>
    <title>Laravel Video Upload Form - ScratchCode.io</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2>Форма для обновление видео</h2>
        </div>
        <div class="panel-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" onclick="this.parentElement.style.display='none';" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <form action="{{ route('update.video',$video->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-12">
                        <div class="col-md-6 form-group">
                            <label>Тема:</label>
                            <input type="text" name="title" value="{{$video->title}}" class="form-control"/>
                            @error('title')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Описание:</label>
                            <input type="text" name="description" value="{{$video->description}}" class="form-control"/>
                            @error('description')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Выберите файл превью вашего видео:</label>
                            <input type="file" name="preview" value="{{$video->preview}}" id="preview_out" class="form-upload__input">
                            @error('preview')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <button type="submit" class="btn btn-success">Загрузить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
@endsection
<style>




    .form-upload__input {
        font-size: 15px;
        font-weight: 300;
        font-family: inherit;
    }

    .form-upload__input::file-selector-button {
        margin-right: 20px;
        padding: 9px 15px;
        border: none;
        border-radius: 6px;
        font-weight: inherit;
        font-family: inherit;
        cursor: pointer;
    }

</style>
