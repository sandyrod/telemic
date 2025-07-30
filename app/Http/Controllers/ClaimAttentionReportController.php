<?php

namespace App\Http\Controllers;

use App\Models\ClaimAttention;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClaimAttentionReportController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->applyFilters(ClaimAttention::query(), $request);

        $claimAttentions = $query->orderBy('fecha_ingreso', 'desc')
                               ->orderBy('hora_inicio', 'desc')
                               ->get();

        $pdf = PDF::loadView('reports.claim_attentions', [
            'claimAttentions' => $claimAttentions,
            'filters' => $request->all()
        ]);

        return $pdf->download('reporte-atenciones-reclamos-' . now()->format('Y-m-d') . '.pdf');
    }
    
    public function exportPdf(Request $request)
    {
        $query = $this->applyFilters(ClaimAttention::query(), $request);

        $claimAttentions = $query->orderBy('fecha_ingreso', 'desc')
                               ->orderBy('hora_inicio', 'desc')
                               ->get();

        $pdf = PDF::loadView('reports.claim_attentions', [
            'claimAttentions' => $claimAttentions,
            'filters' => $request->all()
        ]);

        return $pdf->download('reporte-atenciones-reclamos-' . now()->format('Y-m-d') . '.pdf');
    }

    public function show(ClaimAttention $claimAttention)
    {
        $pdf = PDF::loadView('reports.claim_attention_single', [
            'claimAttention' => $claimAttention
        ]);

        return $pdf->download('atencion-reclamo-' . $claimAttention->id . '-' . now()->format('Y-m-d') . '.pdf');
    }

    public function bulkPdf(Request $request)
    {
        $ids = explode(',', $request->query('ids'));
        $query = ClaimAttention::whereIn('id', $ids);
        
        // Aplicar filtros adicionales si existen
        $query = $this->applyFilters($query, $request);
        
        $claimAttentions = $query->orderBy('fecha_ingreso', 'desc')
                               ->orderBy('hora_inicio', 'desc')
                               ->get();

        $pdf = PDF::loadView('reports.claim_attentions', [
            'claimAttentions' => $claimAttentions,
            'filters' => $request->all()
        ]);

        return $pdf->download('reporte-atenciones-reclamos-seleccionadas-' . now()->format('Y-m-d') . '.pdf');
    }

    protected function applyFilters($query, $request)
    {
        // Aplicar filtros
        if ($request->filled('tipo_reclamo')) {
            $query->where('tipo_reclamo', $request->tipo_reclamo);
        }

        if ($request->filled('abonado')) {
            $query->where('abonado', 'like', '%' . $request->abonado . '%');
        }
        
        if ($request->filled('servicio')) {
            $query->where('servicio', 'like', '%' . $request->servicio . '%');
        }
        
        if ($request->filled('subnodo')) {
            $query->where('subnodo', 'like', '%' . $request->subnodo . '%');
        }

        if ($request->filled('fecha_ingreso_desde') || $request->filled('fecha_desde')) {
            $fechaDesde = $request->fecha_ingreso_desde ?? $request->fecha_desde;
            $query->whereDate('fecha_ingreso', '>=', $fechaDesde);
        }

        if ($request->filled('fecha_ingreso_hasta') || $request->filled('fecha_hasta')) {
            $fechaHasta = $request->fecha_ingreso_hasta ?? $request->fecha_hasta;
            $query->whereDate('fecha_ingreso', '<=', $fechaHasta);
        }

        if ($request->filled('fecha_finalizacion_desde') || $request->filled('fin_desde')) {
            $finDesde = $request->fecha_finalizacion_desde ?? $request->fin_desde;
            $query->whereDate('fecha_finalizacion', '>=', $finDesde);
        }

        if ($request->filled('fecha_finalizacion_hasta') || $request->filled('fin_hasta')) {
            $finHasta = $request->fecha_finalizacion_hasta ?? $request->fin_hasta;
            $query->whereDate('fecha_finalizacion', '<=', $finHasta);
        }

        if ($request->filled('tecnicos')) {
            $query->where('tecnicos', 'like', '%' . $request->tecnicos . '%');
        }
        
        if ($request->filled('tipo_orden')) {
            $query->where('tipo_orden', $request->tipo_orden);
        }

        return $query;
    }
}
