@extends('layout')
@section('title')Редактирование пользователя @endsection
@section('main_content')
<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2>Форма для обновлений пользователей</h2>
            </div>
            <div class="panel-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" onclick="this.parentElement.style.display='none';" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <form action="{{ route('update.user',$users->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-md-6 form-group">
                                <label>Имя пользователя:</label>
                                <input type="name" name="name" value="{{$users->name}}" class="form-control" />
                                @error('name')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Почта пользователя:</label>
                                <input type="email" name="email" value="{{$users->email}}" class="form-control" />
                                @error('email')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Role_id пользователя:</label>

                                <select type="text" name="role_id" required="required">
                                    <option value="{{$users->role_id}}">{{$users->role_id}}:{{$users->role->display_name}}</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->id}}: {{$role->display_name}}</option>
                                    @endforeach

                                </select>
                                @error('role_id')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Выберите файл с видео:</label>

                                <input type="file" name="avatar" id="file_out" class="form-upload__input">
                                @error('avatar')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <button type="submit" class="btn btn-success">Редактировать</button>
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