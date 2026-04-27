<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Tours</title>

    <style>
        /* equivalente a Tailwind base */
        body {
            font-family: ui-sans-serif, system-ui;
            background-color: #f3f4f6;
            color: #111827;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: #3b82f6;
            color: white;
            text-align: left;
            padding: 10px;
            font-size: 14px;
        }

        .table td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            background: #dbeafe;
            font-size: 12px;
        }

        .summary {
            margin-bottom: 15px;
            font-size: 14px;
            color: #374151;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="title">Reporte de Tours</div>

    <div class="summary">
        Total de registros: {{ $tours->count() }}
    </div>

    <div class="card">

        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                    <th>Capacidad</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tours as $t)
                <tr>
                    <td>{{ $t->nombre }}</td>
                    <td><span class="badge">{{ $t->categoria->name }}</span></td>
                    <td>${{ $t->precio }}</td>
                    <td>{{ $t->fecha }}</td>
                    <td>{{ $t->capacidad }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

</body>
</html>