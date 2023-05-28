@extends('layout')
@section('title')Редактирование пользователя @endsection
@section('main_content')
<!DOCTYPE html>
<html>

<body>
    <div class="backform mt-5">
        <div class="panel panel-primary">
            <div class=" panel-heading">
                <h2>Изменение профиля</h2>
            </div>
            <div class="panel-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" onclick="this.parentElement.style.display='none';" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <form action="{{ route('user.profile.update',$users->id) }}" method="POST" enctype="multipart/form-data">
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
                                <label>Выберите файл аватара:</label>

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
</style>
