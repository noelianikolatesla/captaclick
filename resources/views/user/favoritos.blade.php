<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CaptaClik - Favoritos</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @if (app()->environment('production'))
        <link rel="stylesheet" href="https://jet5-ec3cc.web.app/css/app.css">
        <script src="https://jet5-ec3cc.web.app/js/app.js"></script>
        @else
        @vite(['public/css/app.css', 'public/js/app.js'])
        @endif

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        @include('nav')

        <div class="container mt-4">
            @include('appUser')

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <h2 class="mb-4"> Mis Inmuebles Favoritos</h2>

            @if ($inmuebles->count())
            <div class="row justify-content-center">
                @foreach($inmuebles as $inmueble)
                <div class="col-12 col-md-10 col-lg-4 mb-4">
                    <div class="card h-100 position-relative">

                        @if ($inmueble->imagenPropiedad->isNotEmpty())
                        <div class="position-relative">
                            <div class="carousel slide" id="carousel-{{ $inmueble->id }}" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($inmueble->imagenPropiedad as $index => $imagen)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" class="card-img-top" alt="Imagen del inmueble">
                                    </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $inmueble->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $inmueble->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            </div>

                            <!-- Botón para quitar de favoritos -->
                            <form action="{{ route('inmueble.favorito', $inmueble->id) }}" method="POST" class="position-absolute top-0 end-0 m-2 z-3">
                                @csrf
                                <button type="submit" class="border-0 bg-transparent p-0" style="font-size: 1.8rem; color: red;">
                                    ❤️
                                </button>
                            </form>

                        </div>
                        @else
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Imagen no disponible">
                        @endif

                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $inmueble->titulo }}</h5>
                            <span class="badge {{ $inmueble->disponible ? 'bg-success' : 'bg-secondary' }}">
                                {{ $inmueble->disponible ? 'Disponible' : 'No disponible' }}
                            </span>

                            <p class="card-text mt-2">
                                <strong>Precio:</strong> €{{ number_format($inmueble->precio, 2) }}<br>
                                <strong>Zona:</strong> {{ $inmueble->zona }}<br>
                                <strong>Tipo operación:</strong> {{ ucfirst($inmueble->tipo_operacion) }}
                            </p>

                            <div class="d-flex justify-content-center mt-3">
                                <a href="{{ route('inmuebles.showUser', $inmueble->id) }}" class="btn btn-outline-primary w-100 mx-5">
                                    👁️ Ver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <nav aria-label="Paginación de inmuebles">
                <ul class="pagination justify-content-center">
                    @if ($inmuebles->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">Anterior</span></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $inmuebles->previousPageUrl() }}">Anterior</a></li>
                    @endif

                    @foreach ($inmuebles->getUrlRange(1, $inmuebles->lastPage()) as $page => $url)
                    <li class="page-item {{ $inmuebles->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                    @endforeach

                    @if ($inmuebles->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $inmuebles->nextPageUrl() }}">Siguiente</a></li>
                    @else
                    <li class="page-item disabled"><span class="page-link">Siguiente</span></li>
                    @endif
                </ul>
            </nav>
            @else
            <div class="alert alert-info text-center">
                No tienes inmuebles en favoritos todavía.
            </div>
            @endif
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
