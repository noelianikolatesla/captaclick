<!DOCTYPE html>
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
            <link rel="stylesheet" href="https://jet5-ec3cc.web.app/css/app.css"> 
            <script src="https://jet5-ec3cc.web.app/js/app.js"></script>
        @else 
            @vite(['public/css/app.css', 'public/js/app.js']) 
        @endif

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        @include('nav')

        <div class="container mt-4">
            @include('appUser')

            <h2 class="mb-4">Mi Perfil</h2>


            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- Tabla de clientes -->
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>NIF/CIF</th>
                            <th class="d-none d-sm-table-cell">Teléfono</th>
                            <th class="d-none d-md-table-cell">Email</th>
                            <th class="d-none d-md-table-cell">Localidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nombre }} {{ $cliente->apellidos }}</td>
                            <td>{{ ucfirst($cliente->tipo_cliente) }}</td>
                            <td>{{ $cliente->nif_cif }}</td>
                            <td class="d-none d-sm-table-cell text-truncate" style="max-width: 120px;">{{ $cliente->telefono }}</td>
                            <td class="d-none d-md-table-cell text-truncate" style="max-width: 150px;">{{ $cliente->email }}</td>
                            <td class="d-none d-md-table-cell">{{ $cliente->localidad }}, {{ $cliente->provincia }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="{{ route('clientes.showUser', $cliente->id) }}" class="btn btn-outline-primary btn-sm">Ver</a>
                                    <a href="{{ route('clientes.editUser', $cliente->id) }}" class="btn btn-outline-warning btn-sm">Editar</a>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <nav aria-label="Paginación de clientes" class="mt-4">
                <ul class="pagination justify-content-center flex-wrap">
                    @if ($clientes->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">Anterior</span></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $clientes->previousPageUrl() }}">Anterior</a></li>
                    @endif

                    @foreach ($clientes->getUrlRange(1, $clientes->lastPage()) as $page => $url)
                    <li class="page-item {{ $clientes->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                    @endforeach

                    @if ($clientes->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $clientes->nextPageUrl() }}">Siguiente</a></li>
                    @else
                    <li class="page-item disabled"><span class="page-link">Siguiente</span></li>
                    @endif
                </ul>
            </nav>
        </div>

        <!-- JS Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
