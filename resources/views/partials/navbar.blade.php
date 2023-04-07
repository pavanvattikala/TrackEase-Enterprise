<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </button>
  <!-- <a class="navbar-brand" href="#">Brand</a> -->
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      

  <ul class="nav navbar-nav navbar-right">        

      <li id="navDashboard"><a href="/"><i class="glyphicon glyphicon-list-alt"></i>  Dashboard</a></li>        
    
    <li id="navBrand"><a href="/brand"><i class="glyphicon glyphicon-btc"></i>  Brand</a></li>        

    <li id="navCategories"><a href="/category"> <i class="glyphicon glyphicon-th-list"></i> Category</a></li>        

    <li id="navProduct"><a href="/product"> <i class="glyphicon glyphicon-ruble"></i> Product </a></li>     

    <li class="dropdown" id="navOrder">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Orders <span class="caret"></span></a>
      <ul class="dropdown-menu">            
        <li id="topNavAddOrder"><a href="/orders/add_order"> <i class="glyphicon glyphicon-plus"></i> Add Orders</a></li>   
        <li id="topNavManageOrder"><a href="/orders/manage"> <i class="glyphicon glyphicon-edit"></i> Manage Orders</a></li>
      </ul>
    </li>
    <li class="dropdown" id="navService">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Services/Repairs <span class="caret"></span></a>
      <ul class="dropdown-menu">            
        <li id="topNavAddOrder"><a href="/service/add_service"> <i class="glyphicon glyphicon-plus"></i> Add Service/Repair</a></li>          
        <li id="topNavManageOrder"><a href="/service/manage"> <i class="glyphicon glyphicon-edit"></i> Manage Services</a></li>
        <li id="topNavAddOrder"><a href="/service/add_service_type"> <i class="glyphicon glyphicon-plus"></i> Add Service Types</a></li>            
      </ul>
    </li> 
    <li id="navDaySheet"><a href="/daysheet"> <i class="glyphicon glyphicon-th-list"></i> Day Sheet </a></li>
    <li id="navExpense"><a href="/expense"> <i class="glyphicon glyphicon-scissors"></i> Expenses </a></li>   
    <li id="navStock"><a href="/stock"> <i class="glyphicon glyphicon-folder-close"></i> Stock </a></li>       


    {{-- <li id="navReport"><a href="report.php"> <i class="glyphicon glyphicon-check"></i> Report </a></li> --}}

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
           
  </ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>