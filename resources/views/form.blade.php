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

          {!! Form::open() !!}

            {!! Form::hidden('user_id', Auth::user()->id) !!}

            <div class="form-label-group">
              {!! Form::label('theme', 'Тема:') !!}
              {!! Form::text('theme', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-label-group">
              {!! Form::label('message', 'Сообщение:') !!}
              {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-label-group">
              {!! Form::submit('Отправить заявку', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
            </div>

          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
