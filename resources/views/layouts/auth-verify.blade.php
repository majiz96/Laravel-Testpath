<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
            <title>Laravel Test</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-dark auth-wrapper">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">

                @yield('content')

            </div>
        </div>
    </div>

    </body>
</html>


