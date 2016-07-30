<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('style/app.css') }}">
    </head>
    <body>
    @include('includes.header')
        <div class="container">
        	@yield('content')
        </div>
        <script src="{{ URL::asset('js/all.js') }}"></script>
    </body>
</html>
