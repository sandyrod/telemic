<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte de Inspecciones</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 10px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 16px; }
        .info { margin-bottom: 15px; }
        .info p { margin: 3px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; page-break-inside: avoid; }
        th, td { border: 1px solid #ddd; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .section { margin-top: 15px; margin-bottom: 8px; font-weight: bold; font-size: 12px; }
        .footer { margin-top: 20px; font-size: 9px; text-align: center; }
        .inspection { page-break-after: always; margin-bottom: 30px; }
        .inspection:last-child { page-break-after: avoid; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Inspecciones de Vehículos</h1>
        <p>Fecha del reporte: {{ now()->format('d/m/Y H:i') }}</p>
        <p>Total de inspecciones: {{ $inspections->count() }}</p>
    </div>

    @foreach($inspections as $inspection)
    <div class="inspection">
        <div class="info">
            <p><strong>Vehículo:</strong> {{ $inspection->vehicle->brand->description }} {{ $inspection->vehicle->model->modelo }} ({{ $inspection->vehicle->placa }})</p>
            <p><strong>Fecha de inspección:</strong> {{ $inspection->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="section">Kilometraje</div>
        <table>
            <tr>
                <th>Kilometraje de salida</th>
                <th>Kilometraje recorrido</th>
            </tr>
            <tr>
                <td>{{ number_format($inspection->km_departure, 0, ',', '.') }} km</td>
                <td>{{ number_format($inspection->km_traveled, 0, ',', '.') }} km</td>
            </tr>
        </table>

        <div class="section">Estado de Cauchos</div>
        <table>
            <tr>
                <th>Delantero Derecho</th>
                <th>Delantero Izquierdo</th>
                <th>Trasero Derecho</th>
                <th>Trasero Izquierdo</th>
            </tr>
            <tr>
                <td>{{ ucfirst($inspection->tire_front_right) }}</td>
                <td>{{ ucfirst($inspection->tire_front_left) }}</td>
                <td>{{ ucfirst($inspection->tire_rear_right) }}</td>
                <td>{{ ucfirst($inspection->tire_rear_left) }}</td>
            </tr>
        </table>

        <div class="section">Niveles de Fluidos</div>
        <table>
            <tr>
                <th>Motor</th>
                <th>Dirección</th>
                <th>Refrigerante</th>
                <th>Líquido de Frenos</th>
            </tr>
            <tr>
                <td>{{ ucfirst($inspection->fluid_motor) }}</td>
                <td>{{ ucfirst($inspection->fluid_steering) }}</td>
                <td>{{ ucfirst($inspection->fluid_coolant) }}</td>
                <td>{{ ucfirst($inspection->fluid_brake) }}</td>
            </tr>
        </table>

        @if($inspection->fuel_current_liters || $inspection->fuel_consumed || $inspection->fuel_supplied || $inspection->fuel_total)
        <div class="section">Combustible</div>
        <table>
            <tr>
                <th>Litros actuales</th>
                <th>Consumido</th>
                <th>Surtido</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>{{ $inspection->fuel_current_liters }} L</td>
                <td>{{ $inspection->fuel_consumed }} L</td>
                <td>{{ $inspection->fuel_supplied }} L</td>
                <td>{{ $inspection->fuel_total }} L</td>
            </tr>
            @if($inspection->provider)
            <tr>
                <td colspan="4"><strong>Proveedor:</strong> {{ $inspection->provider->name }}</td>
            </tr>
            @endif
        </table>
        @endif
    </div>
    @endforeach

    <div class="footer">
        <p>Generado el {{ now()->format('d/m/Y H:i:s') }} | Total de inspecciones: {{ $inspections->count() }}</p>
    </div>
</body>
</html>
