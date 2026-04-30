<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Reservas - Turismo Cartago</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; padding: 20px; }
        h1 { font-size: 20px; color: #1a1a1a; margin-bottom: 5px; }
        .subtitle { color: #666; margin-bottom: 20px; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background-color: #f3f4f6; padding: 8px; border: 1px solid #e5e7eb; font-weight: bold; text-align: left; font-size: 11px; }
        td { padding: 8px; border: 1px solid #e5e7eb; font-size: 11px; }
        tr:nth-child(even) { background-color: #fafafa; }
        .badge { padding: 2px 8px; border-radius: 12px; font-size: 10px; font-weight: bold; }
        .pendiente { background-color: #fef3c7; color: #a16207; }
        .aprobada { background-color: #dcfce7; color: #15803d; }
        .cancelada { background-color: #fee2e2; color: #b91c1c; }
        .finalizada { background-color: #dbeafe; color: #1d4ed8; }
        .empty { text-align: center; padding: 40px; color: #999; }
    </style>
</head>
<body>
    <h1>Turismo Cartago</h1>
    <p class="subtitle">Reporte de Reservas generado el {{ now()->format('d/m/Y H:i') }}</p>

    @if(isset($reservas) && $reservas->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Tour</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Personas</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservas as $reserva)
                    <tr>
                        <td>{{ $reserva->tour->nombre ?? 'N/A' }}</td>
                        <td>{{ $reserva->user->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($reserva->fecha ?? $reserva->created_at)->format('d/m/Y') }}</td>
                        <td>{{ $reserva->numero_personas ?? 1 }}</td>
                        <td><span class="badge {{ $reserva->status }}">{{ ucfirst($reserva->status) }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="empty">No hay datos disponibles para el reporte.</p>
    @endif
</body>
</html>
