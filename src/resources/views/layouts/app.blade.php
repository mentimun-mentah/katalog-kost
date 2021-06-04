<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>KATALOG KOS</title>
    <link rel="icon" href="{{asset('storage/logo.png')}}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com"> 
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link href="{{ asset('css/fontawesome/css/all.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
    <style>
      body{
        font-family: 'Poppins', sans-serif !important;
      }
      html {
        scroll-behavior: smooth;
      }

      /***** Footer *****/
      .footer-logo-text {
        color: #2c3e50;
      }
      .footer-top {
        padding: 60px 0;
        background: #fff;
        text-align: left;
        color: #757575;
      }
      .footer-top h3 {
        padding-bottom: 10px;
        color: #2c3e50;
      }

      .footer-about img.logo-footer {
        max-width: 74px;
        margin-top: 0;
        margin-bottom: 18px;
      }
      .footer-about p a {
        color: #aaa;
        border-bottom: 1px dashed #666;
      }
      .footer-about p a:hover,
      .footer-about p a:focus {
        color: #fff;
        border-color: #aaa;
      }

      .footer-contact p {
        word-wrap: break-word;
      }
      .footer-contact i {
        padding-right: 10px;
        font-size: 18px;
        color: #666;
      }
      .footer-contact p a {
        color: #aaa;
        border-bottom: 1px dashed #666;
      }
      .footer-contact p a:hover,
      .footer-contact p a:focus {
        color: #2c3e50;
        border-color: #aaa;
        text-decoration: none;
      }

      .footer-social a {
        display: inline-block;
        margin-right: 20px;
        margin-bottom: 8px;
        color: #777;
        border: 0;
      }
      .footer-social a:hover,
      .footer-social a:focus {
        color: #aaa;
        border: 0;
      }
      .footer-social i {
        font-size: 24px;
        vertical-align: middle;
      }

      .footer-bottom {
        padding: 15px 0;
        background: #f5f5f5;
        text-align: left;
        color: #757575;
      }

      .footer-copyright p {
        margin: 0;
        padding: 0.5rem 0;
      }
      .footer-copyright a {
        color: #fff;
        border: 0;
      }
      .footer-copyright a:hover,
      .footer-copyright a:focus {
        color: #aaa;
        border: 0;
      }
      /***** Footer *****/

      /***** Navbar ******/
      .va-sub {
        vertical-align: sub;
      }
      /***** Navbar ******/
      .side-nav-link {
        padding-left: 0;
        padding-right: 0;
        color: rgba(0, 0, 0, 0.65);
      }
      .side-nav-link.active {
        color: rgba(0, 0, 0);
        font-weight: 700;
      }


    </style>
  </head>
  <body>
    <div class="app">
      <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}" style="font-family: 'Dela Gothic One', cursive; color:#2c3e50;">
            <img
              src="{{asset('storage/logo.png')}}"
              alt="katalogkost"
              width="220"
              height="35"
              class="d-inline-block align-text-top"
            />
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="{{ __('Toggle navigation') }}"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto"></ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto align-items-center">

              <li class="nav-item {{Request::is('/') ? 'active': ''}}">
                <a class="nav-link" href="{{ url('/') }}">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/#tentangkami') }}">Tentang Kami</a>
              </li>
              <li class="nav-item {{Route::currentRouteName() == 'listkos' ? 'active': ''}}">
                <a class="nav-link" href="{{url('/list-kos')}}">List Kos</a>
              </li>

              <!-- Authentication Links -->
              @guest @if (Route::has('login'))
              <li class="nav-item {{Request::is('login') ? 'active': ''}}">
                <a class="nav-link" href="{{ route('login') }}"
                  >{{ __('Masuk') }}</a
                >
              </li>
              @endif @if (Route::has('register'))
              <li class="nav-item {{Request::is('register') ? 'active': ''}}">
                <a class="nav-link" href="{{ route('register') }}"
                  >{{ __('Daftar') }}</a
                >
              </li>
              @endif @else
              <li class="nav-item dropdown">
                <a
                  id="navbarDropdown"
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                  v-pre
                > 
                  <img 
                    src="{{asset('storage/avatar/'.Auth::user()->avatar)}}" 
                    class="rounded rounded-circle mr-1" 
                    alt="profile"
                    width="30"
                    height="30"
                  >
                  {{ ucfirst(Auth::user()->name) }}
                </a>

                <div
                  class="dropdown-menu dropdown-menu-right"
                  aria-labelledby="navbarDropdown"
                >
                  @if(Auth::user()->role == 'admin')
                  <a
                    class="dropdown-item"
                    href="{{url('/admin/owner-confirmation')}}"
                  >
                    Admin
                  </a>
                  @endif
                  <a
                    class="dropdown-item"
                    href="{{url('/account/profile')}}"
                  >
                    Akun
                  </a>
                  <a
                    class="dropdown-item"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                  >
                    {{ __('Keluar') }}
                  </a>

                  <form
                    id="logout-form"
                    action="{{ route('logout') }}"
                    method="POST"
                    class="d-none"
                  >
                    @csrf
                  </form>
                </div>
              </li>
              @endguest
            </ul>
          </div>
        </div>
      </nav>

      <main class="bg-white">
        @yield('content')
      </main>

      <!-- FOOTER -->
      <footer>
        <div class="footer-top border-top">
          <div class="container">
            <div class="row">
              <div class="col-md-4 col-lg-4 footer-about wow fadeInUp">
                <h1 class="footer-logo-text">Katalog Kos</h1>
                <p>
                Katalog Kos merupakan website sebagai media promosi dan informasi akan tempat kos yang ada di kecamatan kuta selatan.
                </p>
                <p class="mb-0">
                  Copyright © {{date("Y")}} All Rights Reserved by Katalog Kos.
                </p>
              </div>
              <div
                class="col-md-4 col-lg-4 offset-lg-1 footer-contact wow fadeInDown"
              >
                <h3>Contact us</h3>
                <p>
                  <i class="fas fa-map-marker-alt"></i> Kediri, Tabanan, Bali.
                </p>
                <p><i class="fas fa-phone"></i> Phone: 081 238 124 543</p>
                <p>
                  <i class="fas fa-envelope"></i> Email:
                  <a href="mailto:katalogkos@gmail.com">katalogkos@gmail.com</a>
                </p>
              </div>
              <div class="col-md-4 col-lg-3 footer-social wow fadeInUp">
                <h3>Follow us</h3>
                <p>
                  <a target="__blank" href="https://www.facebook.com"><i class="fab fa-facebook"></i></a>
                  <a target="__blank" href="https://www.twitter.com"><i class="fab fa-twitter"></i></a>
                  <a target="__blank" href="https://www.google.com"><i class="fab fa-google-plus-g"></i></a>
                  <a target="__blank" href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- FOOTER -->
    </div>
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>

    @include('sweetalert::alert')
  </body>
</html>
