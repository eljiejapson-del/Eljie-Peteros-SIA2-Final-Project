<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// This creates an endpoint accessible at: http://127.0.0.1:8000/api/dashboard/stats
Route::get('/dashboard/stats', [DashboardController::class, 'getStats']);