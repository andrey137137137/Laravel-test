@extends('layouts/site')

@section('content')

  <form class="form-signin" method="POST" action="{{ route('applicationInsert') }}">

    <div class="form-label-group">
      <label for="user-id"></label>
      <input class="form-control" id="user-id" type="text" name="user_id" placeholder="Пользователь">
    </div>
    <div class="form-label-group">
      <label for="theme"></label>
      <input class="form-control" id="theme" type="text" name="theme" placeholder="Тема">
    </div>
    <div class="form-label-group">
      <label for="message"></label>
      <textarea class="form-control" id="message" name="message" placeholder="Сообщение"></textarea>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Отправить</button>

    {{ csrf_field() }}

  </form>

@endsection