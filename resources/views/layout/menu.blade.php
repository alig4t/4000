

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm border-bottom box-shadow py-0" dir="rtl">
  <div class="container-fluid py-2">
      <a class="navbar-brand" href="{{ url('/') }}">
        4000 واژه ضروری انگلیسی
          {{-- {{ config('app.name', '4000 Essential English Words') }} --}}
      </a>
      {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button> --}}

      <div class="d-flex" id="navbarSupportedContent" dir="ltr" style="gap:16px">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav me-auto">
            <li>
              
              <button type="button" class="btn btn-danger">جستجوی واژه</button>
              {{-- <a class="btn btn-outline-danger" href="/search">جستجو واژه</a> --}}
              </li>          
            
                      </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ms-auto items-center">
              <!-- Authentication Links -->
              @guest
                  @if (Route::has('login'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                      </li>
                  @endif

                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      </li>
                  @endif
              @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }}
                      </a>

                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
          </ul>

      
                      
      </div>
  </div>
</nav>
{{-- 
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 font-weight-normal mynav">
      <a href="/" class="brandlink">
      <span>4000</span> 
      واژه ضروری انگلیسی  
    </a>
    </h5>
    <!-- <nav class="my-2 my-md-0 mr-md-3">

       <a class="p-2 text-dark" href="/search">جستجو واژه</a> 

    </nav> -->
    <a class="btn btn-outline-danger" href="/search">جستجو واژه</a>

    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    خروج
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
  </div> --}}


