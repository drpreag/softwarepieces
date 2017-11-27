    <!-- Default Bootstrap Navbar -->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @if (Auth::check()) 
                    @if (Auth::user()->role >= 6)
                        <li class="dropdown"> 
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Editor<span class="caret"></span></a>  
                            <ul class="dropdown-menu">                        
                                <li><a href="{{ route('news.index') }}">News</a></li>
                                <li><a href="{{ route('blog.index') }}">Blog</a></li>                            
                            </ul>
                        </li>  
                    @endif 
                    @if (Auth::user()->role >= 8)
                        <li class="dropdown"> 
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>  
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('users.index') }}">Users</a></li>
                                <li><a href="{{ route('roles.index') }}">User roles</a></li>
                                <li><a href="{{ route('categories.index') }}">Categories</a></li>
                            </ul>
                        </li>  
                    @endif 
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                <li class="dropdown">
                    <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello {{ Auth::user()->name }}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('password.change') }}">Change password</a></li>
                        <li><a href="{{ route('profiles.show', Auth::user()->id) }}">View profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <form action="{{ url('logout') }}" method="POST">
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-link btn-sm">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                    <a href="{{ route('login') }}" class="btn btn-default btn-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-default btn-sm">Register</a>                
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>