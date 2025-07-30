<?php

use App\Http\Controllers\InspectionReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// PDF Generation Routes
Route::prefix('reports')->group(function () {
    // Inspection reports
    Route::get('/inspections/{inspection}/pdf', [InspectionReportController::class, 'pdf'])
        ->name('inspections.pdf');
        
    Route::get('/inspections/bulk-pdf', [InspectionReportController::class, 'bulkPdf'])
        ->name('inspections.bulk-pdf');
        
    Route::get('/inspections/all-pdf', [InspectionReportController::class, 'allPdf'])
        ->name('inspections.all-pdf');
        
    // Claim attention reports
    Route::get('/claim-attentions', [\App\Http\Controllers\ClaimAttentionReportController::class, 'index'])
        ->name('claim-attentions.pdf');
        
    Route::get('/claim-attentions/export-pdf', [\App\Http\Controllers\ClaimAttentionReportController::class, 'exportPdf'])
        ->name('claim-attentions.export-pdf');
        
    Route::get('/claim-attentions/bulk-pdf', [\App\Http\Controllers\ClaimAttentionReportController::class, 'bulkPdf'])
        ->name('claim-attentions.bulk-pdf');
        
    Route::get('/claim-attentions/{claimAttention}', [\App\Http\Controllers\ClaimAttentionReportController::class, 'show'])
        ->name('claim-attentions.single-pdf');
});
