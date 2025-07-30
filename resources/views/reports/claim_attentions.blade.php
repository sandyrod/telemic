<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte de Atenciones y Reclamos</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 16px; font-weight: bold; margin-bottom: 5px; }
        .subtitle { font-size: 12px; margin-bottom: 20px; }
        .filters { margin-bottom: 20px; }
        .filter-item { margin-bottom: 5px; }
        .filter-label { font-weight: bold; display: inline-block; width: 150px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .page-break { page-break-after: always; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer { font-size: 9px; margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Reporte de Atenciones y Reclamos</div>
        <div class="subtitle">Generado el: {{ now()->format('d/m/Y H:i:s') }}</div>
        
        @if(count(array_filter($filters)) > 0)
        <div class="filters">
            <div style="font-weight: bold; margin-bottom: 5px;">Filtros aplicados:</div>
            @if(!empty($filters['tipo_reclamo']))
                <div class="filter-item"><span class="filter-label">Tipo de Reclamo:</span> {{ $filters['tipo_reclamo'] }}</div>
            @endif
            @if(!empty($filters['abonado']))
                <div class="filter-item"><span class="filter-label">Abonado:</span> {{ $filters['abonado'] }}</div>
            @endif
            @if(!empty($filters['fecha_ingreso_desde']) || !empty($filters['fecha_ingreso_hasta']))
                <div class="filter-item">
                    <span class="filter-label">Rango Fechas Ingreso:</span> 
                    {{ $filters['fecha_ingreso_desde'] ?? 'Inicio' }} 
                    al 
                    {{ $filters['fecha_ingreso_hasta'] ?? 'Fin' }}
                </div>
            @endif
            @if(!empty($filters['fecha_finalizacion_desde']) || !empty($filters['fecha_finalizacion_hasta']))
                <div class="filter-item">
                    <span class="filter-label">Rango Fechas Finalización:</span> 
                    {{ $filters['fecha_finalizacion_desde'] ?? 'Inicio' }} 
                    al 
                    {{ $filters['fecha_finalizacion_hasta'] ?? 'Fin' }}
                </div>
            @endif
            @if(!empty($filters['tecnicos']))
                <div class="filter-item"><span class="filter-label">Técnicos:</span> {{ $filters['tecnicos'] }}</div>
            @endif
        </div>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha Ingreso</th>
                <th>Hora Inicio</th>
                <th>Abonado</th>
                <th>Tipo Reclamo</th>
                <th>Técnicos</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($claimAttentions as $index => $claim)
                <tr>
                    <td>{{ $claim->id }}</td>
                    <td>{{ $claim->fecha_ingreso ? $claim->fecha_ingreso->format('d/m/Y') : 'N/A' }}</td>
                    <td>{{ $claim->hora_inicio ? \Carbon\Carbon::parse($claim->hora_inicio)->format('H:i') : 'N/A' }}</td>
                    <td>{{ $claim->abonado ?? 'N/A' }}</td>
                    <td>{{ $claim->tipo_reclamo ?? 'N/A' }}</td>
                    <td>{{ $claim->tecnicos ?? 'N/A' }}</td>
                    <td>{{ $claim->fecha_finalizacion ? 'Finalizado' : 'Pendiente' }}</td>
                </tr>
                @if(($index + 1) % 15 === 0 && !$loop->last)
                    </tbody>
                    </table>
                    <div class="page-break"></div>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha Ingreso</th>
                                <th>Hora Inicio</th>
                                <th>Abonado</th>
                                <th>Tipo Reclamo</th>
                                <th>Técnicos</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                @endif
            @empty
                <tr>
                    <td colspan="7" class="text-center">No se encontraron registros</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Página {PAGENO} de {nb}
    </div>
</body>
</html>
