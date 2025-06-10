


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CaptaClik</title>

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

    </head>

<body>
    <header>
            @include('app')
    </header>


    <div class="container mt-4">
    <h2>Inmuebles Disponibles</h2>
    <div class="row">
        @foreach($inmuebles as $inmueble)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Imagen del inmueble">
                    <div class="card-body">
                        <h5 class="card-title">{{ $inmueble->calle }} {{ $inmueble->numero }}</h5>
                        <p class="card-text">
                            <strong>Precio:</strong> €{{ number_format($inmueble->precio, 2) }}<br>
                            <strong>Descripción:</strong> {{ Str::limit($inmueble->descripcion, 100) }}<br>
                            <strong>Zona:</strong> {{ $inmueble->zona }}
                        </p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
                
            </div>
        @endforeach
    </div>
    
</div>

</body>
</html>


