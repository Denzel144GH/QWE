@extends('layout')
@section('title') Добавление видео @endsection
@section('main_content')
<div class="container">
        <form action="{{ route('playlist.add.video',$playlist->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 form-group">
                                <label>Выбор видео:</label>

                                <select type="text" name="video_id" required="required">
                                    @foreach($videos as $vid)
                                    <option value="{{$vid->id}}">{{$vid->title}}</option>
                                    @endforeach

                                </select>
                                @error('role_id')
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
<style scoped>
    .hy:hover {
        cursor: pointer;
        text-decoration: none;
    }

    .hy {
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
    }

    * {
        box-sizing: border-box;
    }

    form {
        position: relative;
        width: 300px;
        margin: 0 auto;
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