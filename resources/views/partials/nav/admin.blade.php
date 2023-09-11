

<ul class="nav nav-pills">

    <li id="topNavAddServiceType"><a href="/service/add_service_type"><i class="glyphicon glyphicon-plus"></i> Add Service Types</a></li>

    <li class="dropdown" id="navSetting">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i>@if (Auth::user()) {{ Auth::user()->name }}@else  @endif <span class="caret"></span></a>
        <ul class="dropdown-menu">
          @guest
          @if (Route::has('login'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}"><i class="glyphicon glyphicon-log-in"></i> {{ __('Login') }}</a>
              </li>
          @endif
          @endguest
          
          <li id="topNavSetting"><a href="/setting"> <i class="glyphicon glyphicon-wrench"></i> Setting</a></li>            
          <li><a class="topNavLogout" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <i class="glyphicon glyphicon-log-out"></i> {{ __('Logout') }}</a></li> 
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>          
        </ul>
    </li>
    
    @auth
        <li id="navmanageUsers"><a href="/users"> <i class="glyphicon glyphicon-folder-close"></i> Users </a></li>       
    @endauth
</ul>
