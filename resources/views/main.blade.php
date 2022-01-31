<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NETS') }}</title>
    <link rel="shortcut icon" href="{{ asset('loginAssets/img/nets-logo.png') }}">

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('loginAssets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('loginAssets/css/plugins.css') }}">
</head>
<body>
    <div id="app">
        <div class="content-wrapper">
    <header class="wrapper bg-soft-primary">
        <nav class="navbar navbar-expand-lg classic transparent position-absolute bg-soft-primary">
        <div class="container flex-lg-row flex-nowrap align-items-center text-black">
          <div class="navbar-brand w-100">
            <a href="/">
              <img class="logo-dark" src="{{ asset('loginAssets/img/nets-logo.png') }}" srcset="{{ asset('loginAssets/img/nets-logo.png') }} 2x" alt="" style="width: 120px;"/>
              <img class="logo-light" src="{{ asset('loginAssets/img/nets-logo.png') }}" srcset="{{ asset('loginAssets/img/nets-logo.png') }} 2x" alt="" style="width: 120px;"/>
            </a>
          </div>
          <div class="navbar-collapse offcanvas-nav">
            <div class="offcanvas-header d-lg-none d-xl-none">
              <a href="/"><img src="{{ asset('loginAssets/img/nets-logo.png') }}" srcset="{{ asset('loginAssets/img/nets-logo.png') }} 2x" alt="" /></a>
              <button type="button" class="btn-close btn-close-white offcanvas-close offcanvas-nav-close" aria-label="Close"></button>
            </div>
            <?php
            
            ?>
            @if (\Request::is('admin/*')!=true)
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Sign In </a></li>
              
              <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Sign Up </a></li>
            </ul>
            @endif
            <!-- /.navbar-nav -->
          </div>
         
          <!-- /.navbar-other -->
        </div>
        <!-- /.container -->
      </nav>

    </header>
</div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
