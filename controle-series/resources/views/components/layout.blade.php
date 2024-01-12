<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='styleSheet' href="{{asset('/css/app.scss')}}">
  <title>{{$title}}</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        @auth
            <div class="ms-auto">
                <form action="{{ route('logout') }}" method='post'>
                    @csrf
                    <button class='btn btn-link'>Logout</button>
                </form>
            </div>
        @endauth

        @if(isset($path) && $path != 'login')
            @guest
                <a href="{{ route('login') }}" class="ms-auto">Login</a>
            @endguest
        @endif
    </div>
</nav>




<div class='container'>
  <h1 class="text-primary" >{{$title}}</h1>

    @isset($sessionMsg)
        <div class='alert alert-success'>
            {{$sessionMsg}}
        </div>
    @endisset

    @if ($errors->any())
        <div class='alert alert-danger'>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{$slot}}
</div>
</body>
</html>