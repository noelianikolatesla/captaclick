<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

 <title>CaptaClik</title>
        <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">-->


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Estilos --> 

        @if (app()->environment('production')) 
        <!-- En producción, carga los estilos desde Firebase --> 
        <link rel="stylesheet" href="https://jet5-ec3cc.web.app/css/app.css"> 
        <script src="https://jet5-ec3cc.web.app/js/app.js"></script>
        @else 
        <!-- En desarrollo, usa los archivos generados por Vite --> 
        @vite(['public/css/app.css', 'public/js/app.js']) 
        @endif 


        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
            {{ $slot }}

        @livewireScripts
    </body>
</html>
