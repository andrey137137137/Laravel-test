@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Заявки</div>

                <div class="panel-body">

                  @if (session('status'))
                    <div class="alert alert-success">
                      {{ session('status') }}
                    </div>
                  @endif

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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
