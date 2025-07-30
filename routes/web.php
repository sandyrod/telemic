<?php

use App\Http\Controllers\InspectionReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// PDF Generation Routes
Route::prefix('reports')->group(function () {
    Route::get('/inspections/{inspection}/pdf', [InspectionReportController::class, 'pdf'])
        ->name('inspections.pdf');
        
    Route::get('/inspections/bulk-pdf', [InspectionReportController::class, 'bulkPdf'])
        ->name('inspections.bulk-pdf');
        
    Route::get('/inspections/all-pdf', [InspectionReportController::class, 'allPdf'])
        ->name('inspections.all-pdf');
});
