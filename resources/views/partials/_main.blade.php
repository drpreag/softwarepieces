<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials._head')
  </head>
  
  <body>

    @include('partials._nav')    

    <div class="container"> <!-- start of body .container --> 
      @include('partials._messages')

      @yield('content')

      @include('partials._footer')

    </div> <!-- end of body .container --> 

  </body>
    @include('partials._javascript')

    @yield('scripts')

</html>
