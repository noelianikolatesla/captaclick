<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Acuerdo de Alquiler</title>
</head>
<body>
    <h1>Acuerdo de Alquiler</h1>
    <p><strong>Cliente:</strong> {{ $visita->cliente->nombre }}</p>
    <p><strong>Inmueble:</strong> {{ $visita->inmueble->titulo }}</p>
    <p><strong>Dirección:</strong> {{ $visita->inmueble->direccion }}</p>
    <p><strong>Renta Mensual:</strong> {{ $visita->inmueble->precio }} €</p>
    <p><strong>Fecha de la Visita:</strong> {{ $visita->fechaVisita }}</p>
    <p><strong>Hora:</strong> {{ $visita->horaVisita }}</p>
</body>
</html>
