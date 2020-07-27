<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
  <div id="app">
    @guest          <!--not logged in links-->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/landing') }}">
          {{ config('app.name', 'Book Store') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>
          @else               <!--logged in links-->
          <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
              <a class="navbar-brand" href="{{ url('/landing') }}">
                {{ config('app.name', 'Book Store') }}
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>
                @endguest
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                  <!-- Authentication Links -->
                  @guest
                  <li class="container">
                    <a class="btn btn-outline-success" href="{{ url('/booksPublic') }}">Books</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  @if (Route::has('register'))
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
                  @endif
                  @else
                  <li class="container">
                    <a class="btn btn-outline-success" href="{{ url('/booksLoggedIn') }}">Books</a>
                  </li>
                  <li class="container">
                    <a class="btn btn-outline-success" href="{{ url('/admin') }}">User Home</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </div>
                </li>
                <!--cart drop down menu-->
                <li class="dropdown" id="cartDropdown">
                  <button type="button" class="btn btn-info" data-toggle="dropdown">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                  </button>
                  <div class="dropdown-menu">
                    <div class="row total-header-section">
                      <div class="col-lg-6 col-sm-6 col-6">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                      </div>

                      <!--mini cart view-->
                      <?php $total = 0 ?>
                      @foreach((array) session('cart') as $id => $details)
                      <?php $total += $details['price'] * $details['quantity'] ?>
                      @endforeach

                      <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                        <p>Total: <span class="text-info">£ {{ $total }}</span></p>
                      </div>
                    </div>

                    @if(session('cart'))

                    <!--cycle through all items in cart and displays-->
                    @foreach(session('cart') as $id => $details)
                    <div class="row cart-detail">
                      <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                        <img src="{{ $details['cover_pic'] }}" />
                      </div>
                      <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                        <p>{{ $details['title'] }}</p>
                        <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                      </div>
                    </div>
                    @endforeach
                    @endif
                    <div class="row">
                      <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                        <!--button to take user to cart page-->
                        <a href="{{ url('cart') }}" class="btn btn-primary btn-block">View all</a>
                      </div>
                    </div>
                  </div>
                </li>

                @endguest
              </ul>
            </div>
          </div>
        </nav>

        <main class="py-4">
          @yield('content')
        </main>
      </div>

      @yield('scipts')
    </body>
    </html>
