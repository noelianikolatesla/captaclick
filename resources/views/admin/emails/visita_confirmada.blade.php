<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Visita</title>
</head>
<body>
    <h1>¡Hola {{ $visita->cliente->nombre }}!</h1>
    <p>Tu visita para el inmueble {{ $visita->inmueble->titulo }} ha sido confirmada.</p>
    <p>Fecha: {{ $visita->fechaVisita }}</p>
    <p>Hora: {{ $visita->horaVisita }}</p>
    <p>Observaciones: {{ $visita->observaciones }}</p>
    <p>Gracias por confiar en CaptaClik.</p>
</body>
</html>
