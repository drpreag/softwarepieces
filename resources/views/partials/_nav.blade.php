  <nav class="navbar navbar-expand-md navbar-light container-fluid fixed-top">
  
    <a class="navbar-brand" href="/dashboard">
      <img src="/img/logo.png" width="111" height="40" alt="SoftwarePieces">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    
    <ul class="navbar-nav">

      <li class="nav-link"><a href="{{ route('news.all') }}">News</a></li>

      <li class="nav-link"><a href="{{ route('blog.all') }}">Blog</a></li>

      @if (Auth::check()) 
          @if (Auth::user()->role >= 6)
              <li class="dropdown nav-link"> 
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Editor</a>                  
                  <ul class="dropdown-menu">                        
                      <li class="nav-item"><a href="{{ route('news.index') }}">News</a></li>
                      <li class="nav-item"><a href="{{ route('blog.index') }}">Blog</a></li>
                  </ul>
              </li>  
          @endif 
          @if (Auth::user()->role >= 8)
              <li class="dropdown nav-link"> 
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin</a>  
                  <ul class="dropdown-menu">
                      <li class="nav-item"><a href="{{ route('users.index') }}">Users</a></li>
                      <li class="nav-item"onauxclick=""><a href="{{ route('roles.index') }}">User roles</a></li>
                      <li class="nav-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                  </ul>
              </li>  
          @endif 
      @endif
    </ul>

    <ul class="navbar-nav ml-auto">
      @if (Auth::check())
      <li class="dropdown nav-link">
          <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello {{ Auth::user()->name }}</a>
          <ul class="dropdown-menu">
              <li class="nav-item"><a href="{{ route('password.change') }}">Change password</a></li>
              <li class="nav-item"><a href="{{ route('users.show_profile', Auth::user()->id) }}">View profile</a></li>
              
              <li class="nav-item">
                  <form action="{{ url('logout') }}" method="POST">
                      {!! csrf_field() !!}
                      <button type="submit" class="btn btn-link btn-md">Logout</button>
                  </form>
              </li>
          </ul>
      </li>
      @else
        <li class="nav-link"><a href="{{ route('login') }}">Login</a></li>
        <li class="nav-link"><a href="{{ route('register') }}">Register</a></li>
      @endif
    </ul>    
  </div>

</nav>