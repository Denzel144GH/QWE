<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
</head>

<body class="">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow ">
        <a class="my-0 mr-md-auto font-weight-normal h5 text-dark" href="/">Томское управление лесами</a>
        <nav class="my-2 my-md-0 mr-md-3">
            @if(auth()->check())
            <!-- Пример разделенной кнопки опасности-->
            <div class="btn-group">
                @if(auth()->user()->role_id > 0)
                    <a class="btn btn-outline-info" href="/CreatePlaylist">Создать плейлист</a>
                @endif
                <a class="btn btn-outline-info" href="/ViewAllPlaylist">Плейлисты</a>
                <a class="btn btn-outline-primary mr-md-3r" href="/login">Профиль</a>
                <button type="button" class="btn btn-outline-primary mr-md-3r dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false"></button>
                @if(auth()->user()->role_id > 0)
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('video.upload.form')}}">Загрузить видео</a>
                    <a class="dropdown-item" href="{{route('user.profile.update.form', auth()->user()->id)}}">Редактировать профиль</a>
                    <a class="dropdown-item" href="{{route('playlist.watch.my')}}">Мои плейлисты</a>
                    @if(auth()->user()->role_id >= 2)
                    <a class="dropdown-item" href="/adminPanel">Админ панель</a>
                    @endif
                </div>
                @endif
            </div>
            {{-- <a class="btn btn-outline-primary mr-md-3" href="/login">Профиль</a>--}}
            <!-- кнопка тригера формы -->
            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">
                Выход
            </button>
            <!-- форма -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">Вы действительно хотите выйти?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-footer">
                            <a href="/logout" class="btn btn-outline-primary">Да</a>
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">нет</button>

                        </div>
                    </div>
                </div>
            </div>
            @else
            <a class="btn btn-outline-success mr-md-3" href="/registration">Регистрация</a>
            <a class="btn btn-outline-primary" href="/login">Авторизация</a>

            @endif
        </nav>

    </div>
    </div>
    @yield('main_content')
</body>

</html>
<style scoped>
</style>
