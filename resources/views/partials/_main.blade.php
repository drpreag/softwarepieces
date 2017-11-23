<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials._head')
    @include('partials._javascript') 
    @yield('scripts')    
  </head>
  
  <body>

    @include('partials._nav')    

    <div class="container"> <!-- start of body .container --> 
      
      @include('partials._messages')

      @yield('content')

    </div> <!-- end of body .container --> 

      @include('partials._footer')

  </body>
</html>
