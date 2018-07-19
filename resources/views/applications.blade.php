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

          @if (count($applications))
            <div class="row">
              @foreach ($applications as $item)
                <article class="col-md-4">
                  <h2>{{ $item->theme }}</h2>
                  <p>{{ $item->message }}</p>
                  <p>{{ $item->name }}</p>
                  <p>{{ $item->email }}</p>
                  <p>{{ $item->created_at }}</p>
                  <p>{{ $item->updated_at }}</p>
                  <form action="{{ route('applicationDelete', ['id' => $item->id]) }}" method="post">
                    {{-- <input type="hidden" name="_method" value="DELETE"> --}}
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger" type="submit">Удалить</button>
                  </form>
                </article>
              @endforeach
            </div>
          @else
            <p> Пока нет заявок. </p>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
