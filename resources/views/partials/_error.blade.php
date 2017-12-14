<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials._head')
    @include('partials._javascript') 
    @yield('scripts')    
  </head>
  
  <body>

    <div class="container"> <!-- start of body .container --> 
      
      @yield('content')

    </div> <!-- end of body .container --> 

      @include('partials._footer')

  </body>
</html>
