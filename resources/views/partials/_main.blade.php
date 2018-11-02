<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials._head')
    @include('partials._javascript') 
    @yield('scripts')    
  </head>
  
  <body>

    <div class="container-fluid"> <!-- start of body .container -->   

      @include('partials._nav')   

      @include('partials._messages')

      @yield('content')

    </div> <!-- end of body .container --> 

    @include('partials._footer')

  </body>
</html>
