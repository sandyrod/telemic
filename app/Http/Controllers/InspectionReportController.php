<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InspectionReportController extends Controller
{
    public function pdf(Inspection $inspection)
    {
        $inspection->load(['vehicle.brand', 'vehicle.model']);
        $pdf = PDF::loadView('reports.inspection', compact('inspection'));
        return $pdf->download("inspeccion-{$inspection->id}.pdf");
    }

    public function bulkPdf(Request $request)
    {
        $ids = $request->input('ids', []);
        $inspections = Inspection::with(['vehicle.brand', 'vehicle.model'])
            ->whereIn('id', $ids)
            ->get();
            
        $pdf = PDF::loadView('reports.inspections', compact('inspections'));
        return $pdf->download("inspecciones-{$inspections->count()}.pdf");
    }

    public function allPdf(Request $request)
    {
        $inspections = Inspection::with(['vehicle.brand', 'vehicle.model'])
            ->when($request->filled('from'), function($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->input('from'));
            })
            ->when($request->filled('until'), function($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->input('until'));
            })
            ->when($request->filled('vehicle_id'), function($query) use ($request) {
                $query->where('vehicle_id', $request->input('vehicle_id'));
            })
            ->get();
            
        $pdf = PDF::loadView('reports.inspections', compact('inspections'));
        return $pdf->download("todas-las-inspecciones-{$inspections->count()}.pdf");
    }
}
