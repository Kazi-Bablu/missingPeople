<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome to missing people site</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
@include('asset.css')

<!-- Styles -->

</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}">FMP</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <ul class="nav navbar-nav navbar-right">
                    @if (Route::has('login'))
                        @if (Auth::check())
                            <li><a href="{{url('/home')}}">Dashboard</a></li>
                        @else
                            <li><a href="{{url('/register')}}">Register</a></li>
                            <li><a href="{{url('/login')}}">Login</a></li>
                        @endif
                        <li><a href="{{url('/missing/list')}}">Missing List</a></li>
                    @endif
                </ul>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<br>
<br>
<br>
<br>
<h1 style="text-align: center; font-size: 50px; font-weight: bold;font-family: 'Courier New'">Missing People</h1>
<br>
<br>
<br>
{!! Form::open(['id'=>'form','url'=> '/index/page/search','method'=>'GET']) !!}
<div class="col-md-6 col-md-offset-3">

    <input type="search" name="search_name" placeholder="Please search with name" class="form-control"
           value="{{old('search_name')}}">

</div>
<div class="col-md-1">
    <button type="submit" class="btn btn-primary pull-right"><i class="fas fa-search"></i> Search
    </button>
</div>
{!! Form::close() !!}
</div>
@include('asset.js')
</body>
</html>
