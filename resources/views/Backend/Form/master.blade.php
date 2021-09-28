<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <title>To Honey Admin</title>
    <!-- vendor css -->
    <link href="{{ asset('assets/backend/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/bracket.css') }}">
  </head>

  <body>
    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">
      @yield('content')  
    </div><!-- d-flex -->
    <script src="{{ asset('assets/backend/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/backend/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('assets/backend/lib/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/lib/select2/js/select2.min.js') }}"></script>
    <script>
      $(function(){
        'use strict';
        $('.select2').select2({
          minimumResultsForSearch: Infinity
        });
      });
    </script>
  </body>
</html>
