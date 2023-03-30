@extends('layout')
@section('title') Профиль @endsection
@section('main_content')
<?php
use App\Models\Video;
use App\Models\Ticket;
$user = auth()->user();
$video = new Video();
$video = $video->all()->where('user_id',$user->id);
?>
<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" onclick="this.parentElement.style.display='none';" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
  <div class="QmrM1BpKzwJBiWVcQyz7IA==">
          <div class="ATxV1Om0sePp4lDLnAq3uw==">
                  <div class="b1RziSFTnQbb3ZOTu1biwA==">
                          <div class="vPib8WA0Q1LBbqmrmssw9w==">
                                  <div class="jsOTYX0pH3oBjSKDdxqB+g==">
                                          <div class="vM5TY03rTJnyg7crh8SJog==">
                                            @if($user->avatar == null)
                                                  <img src="{{ Storage::url('users/default.png') }}" alt=""
                                                  class="_9Vd+W3TCjDmuEV7tOCemNA==">
                                                  @else
                                                  <img src="{{ Storage::url($user->avatar) }}" alt=""
                                                  class="_9Vd+W3TCjDmuEV7tOCemNA==">
                                                  @endif
                                          </div>
                                  </div>
                                  <div class="utcEQVpG2CxaNe0m6hZgMQ==">
                                          <div class="pIc9rKTJpEdd7VciCWj3iw==">
                                                  <h1 class="zCppf7+M8jUHTA54On7Qbg==">
                                                          {{$user->name}}
                                                  </h1>
                                          </div>
                                  </div>
                                  <div class="_3GrDbIeCB6CT1u2UFMXBug==">
                                          <div class="rcHM9OILKxbxImTkB1pK3w==">
                                                  <ul class="crIyOI3mLKETpDMVzHGm8A==">
                                                          <li class="ch0kxyCKroW+uLE+V2Wwuw==">
                                                                  <div class="ChjoCmoILbNVHvINAaI22w==">
                                                                          Дата регистрации:
                                                                  </div>
                                                                  <div class="PbfbBzFoBaCyzC8lPAjUOg==">
                                                                  <div class="PbfbBzFoBaCyzC8lPAjUOg==">
                                                                  {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d.m.Y')}}
                                                                  </div>

                                                          </li>
                                                  </ul>
                                          </div>
                                  </div>
                          </div>
                  </div>
          </div>
    </div>

   <center><h3>

           Мои видео
       </h3></center>
    <div class=" row">
                      @foreach($video as $el)

                              <p class="col temp hy text-light">
                                  <table>
                                      <tr>
                                          <td rowspan="5" class="first"><a href="video/1" > <img  src="{{ Storage::url($el->preview) }}" width="256" height="256"></img></a></td>
                                          <td><strong>{{$el->title}}</strong></td>
                                      </tr>
                                      <tr>
                                          <td>{{$el->user_id}}</td>
                                      </tr>
                                      <tr>
                                          <td>{{$el->views}}</td>
                                      </tr>
                                      <tr>
                                          <td>

                                              <a href="{{route('delete-video',$el->id)}}"><button type="button"  class="btn btn-outline-danger">🗑️</button></a>
                                             <a href="{{route('update.video',$el->id)}}"><button type="button"  class="btn btn-outline-warning">✏</button></a>
                                          </td>
                                      </tr>
                                  </table>
                              </p>

                              @endforeach
                          </div>
                  </div>
@endsection

<style scoped>
    .hy:hover {
        transform: scale(1.05);
        cursor: pointer;
        text-decoration: none;
    }
    .hy{
        transition: .5s ease;
        box-sizing: border-box;
        text-decoration: none;
        border-radius: 30px;
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
        border: 5px solid white;
        margin-top: 20pt;
        margin-left: 20pt;
        margin-right: 20pt;
        margin-bottom: 20pt;
        border-radius: 15px;
        border-color: #F4F1F8;
        width: 450pt;
        word-break: break-word;

    }
    img {
        padding: 15px;
    }
  body {
      background-image: initial;
      background-color: rgb(32, 34, 36);
      color: rgb(232, 230, 227);
  }
  .QmrM1BpKzwJBiWVcQyz7IA\=\= {
      min-height: 400px;
      padding-bottom: 24px;
      position: relative;
  }
  .ATxV1Om0sePp4lDLnAq3uw\=\= {
      padding-top: 36px;
  }
  ._2tZYHlF2\+gWqQWR1DpJc8g\=\=, .ATxV1Om0sePp4lDLnAq3uw\=\= {
      margin: 0 auto;
      max-width: 1300px;
      padding-left: 24px;
      padding-right: 24px;
      width: 100%;
  }
  .b1RziSFTnQbb3ZOTu1biwA\=\= {
      position: relative;
  }
  .vPib8WA0Q1LBbqmrmssw9w\=\= {
      grid-gap: 0 24px;
      display: grid;
      gap: 0 24px;
      grid-template-areas:
          "POSTER TITLE"
          "POSTER DESCRIPTION"
          "POSTER BUY";
      grid-template-columns: 1fr 3fr;
      position: relative;
  }
  .vPib8WA0Q1LBbqmrmssw9w\=\= .jsOTYX0pH3oBjSKDdxqB\+g\=\= {
      grid-area: POSTER;
  }
  .vM5TY03rTJnyg7crh8SJog\=\= {
      min-height: 450px;
      position: relative;
  }
  .vM5TY03rTJnyg7crh8SJog\=\= .AXbGlqIW8-xvJqlrhJG06g\=\= {
      position: absolute;
      right: 16px;
      top: 16px;
  }
  .vM5TY03rTJnyg7crh8SJog\=\= ._9Vd\+W3TCjDmuEV7tOCemNA\=\=, .vM5TY03rTJnyg7crh8SJog\=\= .xyAnrq\+0QwFpsmgTUiGJFg\=\= {
      border-radius: 16px;
      height: auto;
      overflow: hidden;
      width: 100%;
  }
  .BP6fAExrzlfYbjx4KdVO2w\=\= {
      margin-bottom: 25px;
      margin-top: 25px;
  }
  .vPib8WA0Q1LBbqmrmssw9w\=\= .utcEQVpG2CxaNe0m6hZgMQ\=\= {
      grid-area: TITLE;
  }
  .vPib8WA0Q1LBbqmrmssw9w\=\= ._3GrDbIeCB6CT1u2UFMXBug\=\= {
      grid-area: DESCRIPTION;
  }
  .pIc9rKTJpEdd7VciCWj3iw\=\= .zCppf7\+M8jUHTA54On7Qbg\=\= {
      margin: 0;
      padding-bottom: 8px;
  }
  .rcHM9OILKxbxImTkB1pK3w\=\= {
      padding-top: 16px;
  }
  .\+BiLLE7SLOmMkRUMNLiNKg\=\= {
      margin-bottom: 16px;
  }
  .nxntVeDQv-z4IZfaycC34A\=\= {
      height: 400px;
      width: 100%;
  }
  .rcHM9OILKxbxImTkB1pK3w\=\= .crIyOI3mLKETpDMVzHGm8A\=\= {
      grid-gap: 12px;
      display: grid;
      gap: 12px;
      margin: 0 0 16px;
      padding: 0;
  }
  .rcHM9OILKxbxImTkB1pK3w\=\= .ch0kxyCKroW\+uLE\+V2Wwuw\=\= {
      grid-gap: 24px;
      display: grid;
      gap: 24px;
      grid-template-columns: 1fr 2fr;
  }
  .ybbyOjyra9OK6pEYs0GTwA\=\=, .rcHM9OILKxbxImTkB1pK3w\=\= .ch0kxyCKroW\+uLE\+V2Wwuw\=\= .ChjoCmoILbNVHvINAaI22w\=\= {
      font-size: 16px;
      font-weight: 700;
      line-height: 20px;
  }
  .kaRdZQDlCIuHQz5e4H5f4A\=\=, .rcHM9OILKxbxImTkB1pK3w\=\= .ch0kxyCKroW\+uLE\+V2Wwuw\=\= .PbfbBzFoBaCyzC8lPAjUOg\=\=, .pIc9rKTJpEdd7VciCWj3iw\=\= .ZwQnWmCYFum0KJ-M7T89Pw\=\=, .pIc9rKTJpEdd7VciCWj3iw\=\= .tUe08bFdnrQqDUo8hGr8LA\=\= span, ._7TDk-AT3HlaUo5eO907zFg\=\= {
      font-size: 16px;
      line-height: 24px;
  }
  .vPib8WA0Q1LBbqmrmssw9w\=\= .Ro14HRU8UV7tl9Nli0GiUg\=\= {
      grid-area: BUY;
  }
  .s0yJuTknJkrvvHvKRx1h8w\=\= {
      grid-gap: 24px;
      display: grid;
      gap: 24px;
      grid-template-columns: 1fr 2fr;
      padding-top: 24px;
  }

  .ihOPr5gPPBXS8OHkFFwM2w\=\= {
      border: 1px solid red;
      border-radius: 8px;
      padding: 8px;
      text-align: center;
      color: azure;
      text-decoration: none;
      cursor: pointer;
  }
  </style>
