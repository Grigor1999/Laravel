<!DOCTYPE>
<html lang="en">
  <head>
    @include('layouts.head')
  </head>

  <body>
    {{-- <div class="logo d-flex justify-content-between container"> --}}
      <div class="menu">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a href="#" class="pt-5 logo mr-4">GoodLiving Schweiz<br>Happy Call<br>&nbsp;</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          @if(Auth::check())
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                @if(Auth::user()->isSuperAdmin || Auth::user()->isCC)
                <li class="nav-item active">
                <a class="nav-link" href="{{url('home')}}">{{__("Call")}}</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{url('history')}}">{{__("History")}}</a>
                </li>
                @endif
                <li class="nav-item">
                  <a class="nav-link" href="{{url('checkPhonePage')}}">{{__("Eingabe")}}</a>
                </li>
                
                @if(Auth::user()->isAdmin || Auth::user()->isSuperAdmin || Auth::user()->isExternalCC)
                <li>
                  <a class="nav-link" href="{{url('region')}}">{{__("Region")}}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('export')}}">{{__("Export")}}</a>
                </li>
                @endif
                @if(Auth::user()->isAdmin || Auth::user()->isSuperAdmin || Auth::user()->isAgent)
                <li class="nav-item">
                  <a class="nav-link" href="{{url('manage')}}">{{__("Cockpit")}}</a>
                </li>
                @endif
                @if(Auth::user()->isAdmin || Auth::user()->isSuperAdmin)
                <li class="nav-item">
                  <a class="nav-link" href="{{url('admin')}}">{{__("Admin")}}</a>
                </li>
                @endif
                @if(Auth::user()->isSuperAdmin)
                <li class="nav-item">
                  <a class="nav-link" href="{{url('plzgroup')}}">{{__("PLZ")}}</a>
                </li>
                @endif
                <li class="nav-item">
                  <a class="nav-link" href="{{url('logout')}}">{{__("Logout")}}</a>
                </li>
                
              </ul>
              @if(Auth::user()->isSuperAdmin || Auth::user()->isCC)
              <form class="form-inline my-2 my-lg-0" method="POST" action="{{url('searchCall')}}">
                 @csrf
                <input name="search" class="form-control mr-sm-2" type="search" placeholder="{{__("Name")}},{{__("Tel")}},{{__("Email")}}" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">{{__("Search")}}</button>
              </form>
              @endif
            </div>
            @endif
        </nav>
        <img src="{{asset('images/white_bubbles.jpg')}}" class="purple_img">
      </div>

      @yield('content')
      <div id="green_bubble" class="container mt-5 mb-5">
			<p><a href="https://goodliving.ch">goodliving.ch</a></p>
		</div>
   
      
      @include('sweetalert::alert')
</body>
@include('layouts.scripts')

<script>


  </script>
</html>