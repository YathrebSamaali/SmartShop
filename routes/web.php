<?php

use App\Http\Controllers\AnalyticsController;

Route::get('/analytics', [AnalyticsController::class, 'predictSales'])->name('analytics.sales');
Route::get('/recommend/{customer_id}', [AnalyticsController::class, 'recommendProducts'])->name('analytics.recommend');
