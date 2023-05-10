@extends('layout')
@section('title')Создание плейлиста@endsection
@section('main_content')

    <!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
<div class="backform mt-5 ">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2>Форма для создания плейлиста</h2>
        </div>
        <div class="panel-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" onclick="this.parentElement.style.display='none';" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <form action="{{ route('create.playlist') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">

                        <div class="col-md-6 form-group">
                            <label>Напишите название плейлиста:</label>

                            <input type="text"  name="name" class="form-control"/>
                            @error('name')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <button type="submit" class="btn btn-success">Создать</button>
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

    .backform{
        border-radius: 15px;
        width: 35%;
        margin-left: 25%;
        background-color: #fcfafa;
        padding: 15px;
    }
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
</style

<script>

</script>
