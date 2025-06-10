<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Condiciones del Servicio - CaptaClik</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (app()->environment('production'))
        <link rel="stylesheet" href="https://jet5-ec3cc.web.app/css/app.css">
        <script src="https://jet5-ec3cc.web.app/js/app.js"></script>
    @else
        @vite(['public/css/app.css', 'public/js/app.js'])
    @endif
</head>

<body>
    @include('nav')

    <div class="container mt-4">
        <h2>Condiciones del servicio</h2>
        <p>Al darse de alta como cliente en CaptaClik, usted acepta las siguientes condiciones:</p>

        <ul>
            <li>La plataforma gestiona sus datos con fines de contacto y prestación de servicios inmobiliarios.</li>
            <li>La contratación implica aceptación de contacto comercial relacionado con los inmuebles.</li>
            <li>Los datos facilitados deben ser veraces. Usted es responsable de mantenerlos actualizados.</li>
            <li>Podrá solicitar la modificación o eliminación de sus datos contactando con el soporte.</li>
            <li>El uso indebido del servicio o el incumplimiento de estas condiciones puede conllevar la cancelación del acceso.</li>
        </ul>

        <p>Estas condiciones pueden actualizarse. Le recomendamos revisarlas periódicamente.</p>

        <div class="mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-volver">← Volver atrás</a>
        </div>
    </div>
</body>

</html>
