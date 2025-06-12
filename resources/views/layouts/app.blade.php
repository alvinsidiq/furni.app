<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Untree.co">
  <meta name="description" content="">
  <meta name="keywords" content="bootstrap, bootstrap4">
  <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Stylesheets -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('css/tiny-slider.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  <title>Furni - @yield('title')</title>
</head>
<body>

<!-- Navigation -->
<!-- Navigation -->
<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">Furni<span>.</span></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsFurni">
      <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
        <li class="nav-item @if(request()->routeIs('home')) active @endif">
          <a class="nav-link" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item @if(request()->routeIs('shop')) active @endif">
          <a class="nav-link" href="{{ route('shop') }}">Shop</a>
        </li>
        <li class="nav-item @if(request()->routeIs('about')) active @endif">
          <a class="nav-link" href="{{ route('about') }}">About us</a>
        </li>
        <li class="nav-item @if(request()->routeIs('services')) active @endif">
          <a class="nav-link" href="{{ route('services') }}">Services</a>
        </li>
        <li class="nav-item @if(request()->routeIs('blog')) active @endif">
          <a class="nav-link" href="{{ route('blog') }}">Blog</a>
        </li>
        <li class="nav-item @if(request()->routeIs('contact')) active @endif">
          <a class="nav-link" href="{{ route('contact') }}">Contact us</a>
        </li>
      </ul>

      <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
       {{-- Cart Icon --}}
<li class="nav-item me-3 position-relative">
    @php
      $cart = session('cart', []);
      $cartCount = array_sum(array_column($cart, 'quantity'));
    @endphp
    <a class="nav-link" href="{{ route('cart.index') }}">
      <img src="{{ asset('images/cart.svg') }}" alt="Cart">
      @if($cartCount > 0)
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          {{ $cartCount }}
        </span>
      @endif
    </a>
  </li>


        {{-- User Icon --}}
        <li class="nav-item dropdown">
          @auth
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ asset('images/user.svg') }}" alt="User">
              <span class="ms-2 text-white">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="dropdown-item" type="submit">Logout</button>
                </form>
              </li>
            </ul>
          @else
            <a class="nav-link" href="{{ route('login') }}">
              <img src="{{ asset('images/user.svg') }}" alt="Login">
            </a>
          @endauth
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navigation -->

<!-- End Navigation -->

<main>
  @yield('content')
</main>

<!-- Footer -->
<footer class="footer-section">
  <div class="container relative">
    <div class="sofa-img">
      <img src="{{ asset('images/sofa.png') }}" alt="Image" class="img-fluid">
    </div>

    <div class="row">
      <div class="col-lg-8">
        <div class="subscription-form">
          <h3 class="d-flex align-items-center">
            <span class="me-1">
              <img src="{{ asset('images/envelope-outline.svg') }}" alt="Image" class="img-fluid">
            </span>
            <span>Subscribe to Newsletter</span>
          </h3>

          <form action="#" class="row g-3">
            <div class="col-auto">
              <input type="text" class="form-control" placeholder="Enter your name">
            </div>
            <div class="col-auto">
              <input type="email" class="form-control" placeholder="Enter your email">
            </div>
            <div class="col-auto">
              <button class="btn btn-primary">
                <span class="fa fa-paper-plane"></span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="row g-5 mb-5">
      <div class="col-lg-4">
        <div class="mb-4 footer-logo-wrap">
          <a href="#" class="footer-logo">Furni<span>.</span></a>
        </div>
        <p class="mb-4">Donec facilisis quam ut purus rutrum lobortis...</p>
        <ul class="list-unstyled custom-social">
          <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
          <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
          <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
          <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
        </ul>
      </div>

      <div class="col-lg-8">
        <div class="row links-wrap">
          <div class="col-6 col-sm-6 col-md-3">
            <ul class="list-unstyled">
              <li><a href="{{ route('about') }}">About us</a></li>
              <li><a href="{{ route('services') }}">Services</a></li>
              <li><a href="{{ route('blog') }}">Blog</a></li>
              <li><a href="{{ route('contact') }}">Contact us</a></li>
            </ul>
          </div>
          <div class="col-6 col-sm-6 col-md-3">
            <ul class="list-unstyled">
              <li><a href="#">Support</a></li>
              <li><a href="#">Knowledge base</a></li>
              <li><a href="#">Live chat</a></li>
            </ul>
          </div>
          <div class="col-6 col-sm-6 col-md-3">
            <ul class="list-unstyled">
              <li><a href="#">Jobs</a></li>
              <li><a href="#">Our team</a></li>
              <li><a href="#">Leadership</a></li>
              <li><a href="#">Privacy Policy</a></li>
            </ul>
          </div>
          <div class="col-6 col-sm-6 col-md-3">
            <ul class="list-unstyled">
              <li><a href="#">Nordic Chair</a></li>
              <li><a href="#">Kruzo Aero</a></li>
              <li><a href="#">Ergonomic Chair</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="border-top copyright">
      <div class="row pt-4">
        <div class="col-lg-6 text-center text-lg-start">
          <p class="mb-2">&copy; <script>document.write(new Date().getFullYear());</script> All Rights Reserved. Designed by <a href="https://untree.co">Untree.co</a></p>
        </div>
        <div class="col-lg-6 text-center text-lg-end">
          <ul class="list-unstyled d-inline-flex ms-auto">
            <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
            <li><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
      </div>
    </div>

  </div>
</footer>
<!-- End Footer -->

<!-- Scripts -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/tiny-slider.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
@stack('scripts')
</body>
</html>
