<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title> Laravel &dash; {{ $header }} </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse justify-content-md-center">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a href="" class="nav-link"> menu item 1 </a>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link"> menu item 2 </a>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link"> menu item 3 </a>
        </li>
      </ul>
    </div>
  </nav>

  <section class="container">

    <h1>{{ $header }}</h1>

    @if (count($errors))
      <ul class="error">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif

    @yield('content')

  </section>

</body>
</html>