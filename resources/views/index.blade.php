@extends('layouts/site')

@section('content')

  @if (count($applications))
    <div>
      @foreach ($applications as $item)
        <article class="row">
          <h2>{{ $item->theme }}</h2>
          <p>{{ $item->message }}</p>
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

@endsection