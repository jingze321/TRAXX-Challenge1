<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Main</title>

        <!-- Fonts -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"></link>


    </head>
    <body >
            <div id="app">
                <input-user-page :user-data="'{{$userData}}'"></input-user-page>
            </div>
            <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>
