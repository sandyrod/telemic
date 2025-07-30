<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte de Inspección de Vehículo</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 10px; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 18px; color: #333; }
        .header p { margin: 5px 0; color: #555; }
        .info { margin-bottom: 15px; background-color: #f9f9f9; padding: 10px; border-radius: 5px; }
        .info p { margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; page-break-inside: avoid; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; color: #333; }
        .section { 
            margin: 15px 0 10px 0; 
            font-weight: bold; 
            font-size: 12px;
            color: #2c3e50;
            border-bottom: 1px solid #eee;
            padding-bottom: 3px;
        }
        .footer { 
            margin-top: 30px; 
            font-size: 9px; 
            text-align: center; 
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .inspection { 
            page-break-after: always; 
            margin-bottom: 30px; 
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 5px;
        }
        .inspection:last-child { page-break-after: avoid; }
        .status-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-bueno { background-color: #d4edda; color: #155724; }
        .status-regular { background-color: #fff3cd; color: #856404; }
        .status-malo { background-color: #f8d7da; color: #721c24; }
        .two-column {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        .section-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>INSPECCIÓN DE VEHÍCULO</h1>
        <p>Fecha del reporte: {{ now()->format('d/m/Y H:i') }}</p>
        @if(isset($filters) && count($filters) > 0)
        <p>Filtros aplicados: 
            @foreach($filters as $key => $value)
                @if($value && !in_array($key, ['_token', 'page']))
                    {{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $value }}
                    @if(!$loop->last) | @endif
                @endif
            @endforeach
        </p>
        @endif
    </div>

    @foreach($inspections as $inspection)
    <div class="inspection">
        <div class="info">
            <p><strong>Vehículo:</strong> {{ $inspection->vehicle->brand->description ?? 'N/A' }} {{ $inspection->vehicle->model->modelo ?? 'N/A' }} ({{ $inspection->vehicle->placa ?? 'N/A' }})</p>
            <p><strong>Fecha de inspección:</strong> {{ $inspection->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Inspector:</strong> {{ $inspection->user->name ?? 'No especificado' }}</p>
        </div>

        <div class="section-container">
            <div class="section">Kilometraje y Combustible</div>
            <div class="two-column">
                <div>
                    <table>
                        <tr>
                            <th colspan="2" style="text-align: center;">Kilometraje</th>
                        </tr>
                        <tr>
                            <td><strong>De salida:</strong></td>
                            <td>{{ number_format($inspection->km_departure, 0, ',', '.') }} km</td>
                        </tr>
                        <tr>
                            <td><strong>Recorrido:</strong></td>
                            <td>{{ number_format($inspection->km_traveled, 0, ',', '.') }} km</td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table>
                        <tr>
                            <th colspan="2" style="text-align: center;">Combustible (L)</th>
                        </tr>
                        <tr>
                            <td><strong>Actual:</strong></td>
                            <td>{{ $inspection->fuel_current_liters ?? '0.00' }} L</td>
                        </tr>
                        <tr>
                            <td><strong>Consumido:</strong></td>
                            <td>{{ $inspection->fuel_consumed ?? '0.00' }} L</td>
                        </tr>
                        <tr>
                            <td><strong>Surtido:</strong></td>
                            <td>{{ $inspection->fuel_supplied ?? '0.00' }} L</td>
                        </tr>
                        <tr>
                            <td><strong>Total:</strong></td>
                            <td>{{ $inspection->fuel_total ?? '0.00' }} L</td>
                        </tr>
                        @if($inspection->provider)
                        <tr>
                            <td><strong>Proveedor:</strong></td>
                            <td>{{ $inspection->provider->name }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <div class="section-container">
            <div class="section">Estado de Cauchos</div>
            <table>
                <tr>
                    <th>Posición</th>
                    <th>Estado</th>
                    <th>Observaciones</th>
                </tr>
                @php
                    $tires = [
                        'Delantero Derecho' => $inspection->tire_front_right,
                        'Delantero Izquierdo' => $inspection->tire_front_left,
                        'Trasero Derecho' => $inspection->tire_rear_right,
                        'Trasero Izquierdo' => $inspection->tire_rear_left
                    ];
                @endphp
                @foreach($tires as $position => $status)
                <tr>
                    <td>{{ $position }}</td>
                    <td>
                        <span class="status-badge status-{{ $status }}">
                            {{ ucfirst($status) }}
                        </span>
                    </td>
                    <td>{{ $inspection->observations_tires ?? 'Ninguna' }}</td>
                </tr>
                @endforeach
            </table>
        </div>

        <div class="section-container">
            <div class="section">Niveles de Fluidos</div>
            <div class="two-column">
                <div>
                    <table>
                        <tr>
                            <th>Fluido</th>
                            <th>Estado</th>
                        </tr>
                        <tr>
                            <td><strong>Motor</strong></td>
                            <td>
                                <span class="status-badge status-{{ $inspection->fluid_motor }}">
                                    {{ ucfirst($inspection->fluid_motor) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Dirección</strong></td>
                            <td>
                                <span class="status-badge status-{{ $inspection->fluid_steering }}">
                                    {{ ucfirst($inspection->fluid_steering) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Refrigerante</strong></td>
                            <td>
                                <span class="status-badge status-{{ $inspection->fluid_coolant }}">
                                    {{ ucfirst($inspection->fluid_coolant) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Líquido de Frenos</strong></td>
                            <td>
                                <span class="status-badge status-{{ $inspection->fluid_brake }}">
                                    {{ ucfirst($inspection->fluid_brake) }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table>
                        <tr>
                            <th colspan="2">Observaciones Generales</th>
                        </tr>
                        <tr>
                            <td colspan="2" style="min-height: 100px; vertical-align: top;">
                                {{ $inspection->observations ?? 'Ninguna' }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Inspector:</strong></td>
                            <td>{{ $inspection->user->name ?? 'No especificado' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Fecha:</strong></td>
                            <td>{{ $inspection->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Sistema de Gestión de Flota - {{ config('app.name') }} | Página {PAGE_NUM} de {PAGE_COUNT}</p>
        </div>
    </div>
    @endforeach

    <div class="footer">
        <p>Generado el {{ now()->format('d/m/Y H:i:s') }} | Total de inspecciones: {{ $inspections->count() }}</p>
    </div>
</body>
</html>
