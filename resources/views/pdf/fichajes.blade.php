<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Historial general de fichajes</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 30px;
        }
        h1 {
            text-align: center;
        }
        h2 {
            margin-top: 40px;
            border-bottom: 1px solid #ccc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h1>Historial de fichajes - Todos los empleados</h1>

    @foreach ($usuarios as $usuario)
        <h2>{{ $usuario->nombre ?? 'Sin nombre' }} (Nº {{ $usuario->numero_empleado ?? '---' }})</h2>

        @if ($usuario->fichajes->isEmpty())
            <p>No tiene fichajes registrados.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Descanso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuario->fichajes as $f)
                        <tr>
                            <td>{{ $f->fecha }}</td>
                            <td>{{ $f->hora_entrada ?? '-' }}</td>
                            <td>{{ $f->hora_salida ?? '-' }}</td>
                            <td>{{ $f->hora_descanso ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
</body>
</html>

