<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
            <title>Laravel Test</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>

        <header>
            Header
        </header>

    {{ $slot }}

        <footer>
            Footer
        </footer>

    </body>
</html>
