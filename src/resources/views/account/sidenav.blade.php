@extends('layouts.app')
@section('content')
<div class="bg-light">
  <div class="container pt-4 pb-4 account">
    <div class="row">
      <div class="flex-column col-md-2 d-none d-lg-block pl-2 fs-14 nav">
        <a href="#"
          class="text-truncate text-dark align-middle text-decoration-none px-0 mb-3 nav-link"
          role="button"
        >
          <img width="40" height="40" src="{{asset('storage/avatar/'.Auth::user()->avatar)}}" class="rounded-circle" />
          <span class="pl-1 align-middle">
            {{ ucfirst(Auth::user()->name) }}
          </span>
        </a>
        <a href="{{url('/account/profile')}}"
          class="side-nav-link nav-link {{Route::currentRouteName() == 'account.profile' ? 'active': ''}}"
          role="button"
        >
          <span>
            <i class="far fa-user-circle mr-2"></i>Akun Saya
          </span>
        </a>

        @if(Auth::user()->role == 'owner')
        <a href="{{url('/kosts/add-kost')}}"
          class="side-nav-link nav-link {{Route::currentRouteName() == 'kost.add_kost' ? 'active': ''}}"
          role="button"
        >
          <span>
            <i class="far fa-house mr-2"></i>Tambah Kos
          </span>
        </a>

        <a href="{{url('/kosts/my-kost')}}"
          class="side-nav-link nav-link {{Route::currentRouteName() == 'kost.my_kost' ? 'active': ''}}"
          role="button"
        >
          <span>
            <i class="far fa-door-open mr-2"></i>Kelola Kos
          </span>
        </a>
        @endif

        <a href="{{url('/account/password')}}"
          class="side-nav-link nav-link {{Route::currentRouteName() == 'account.password' ? 'active': ''}}"
          role="button"
        >
          <span>
            <i class="far fa-lock mr-2"></i>Atur Kata Sandi
          </span>
        </a>

      </div><!--/flex-column-->

      <div class="bg-white px-0 rounded h-100 col-lg-10 col-md-12">
        @yield('sidenav')
      </div>

    </div> <!--/row-->
  </div> <!--/container-->
</div>
<!--/bg-light-->

@endsection
