@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <h1 class="panel-heading">Заявки</h1>

        <div class="panel-body">

          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          <p>Вы не можете отправлять так часто заявки.</p>
          <p>Подождите пожалуйста {{ $restTime }}.</p>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
