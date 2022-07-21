<!doctype html>
    <html lang="{{ app()->getLocale() }}">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>Page</title>
            <link href="{{ asset('css/app.css') }}" rel="stylesheet"></link>
        </head>
        <body >
            <div id="app">
                <views :user-data="'{{$userData}}'" ></views>
            </div>
            <script type="text/javascript" src="js/app.js"></script>
        </body>

    </html>

<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Main</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet"></link>


    </head>
    <body >
            <div id="app">
                <views :user-data="'{{$userData}}'" ></views>
            </div>
            <script type="text/javascript" src="js/app.js"></script>
    </body>
    <style>
html,
body {
    height: 100%;
  width: 100%;
}

.container{
    height: 100%;
}
        </style>
</html> -->
