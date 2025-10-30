<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

// Health check para Render
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now(),
        'service' => 'Laravel API'
    ]);
});

// Tus rutas existentes
Route::post('/contact-form', [EmailController::class, 'contactForm']);
Route::prefix('email')->group(function () {
    Route::post('/send', [EmailController::class, 'sendEmail']);
    Route::post('/send-bulk', [EmailController::class, 'sendBulkEmail']);
});

// Ruta de fallback para SPA
Route::fallback(function () {
    return response()->json([
        'message' => 'API endpoint not found. Check /api/ routes.',
        'available_routes' => [
            'POST /api/contact-form',
            'POST /api/email/send',
            'POST /api/email/send-bulk',
            'GET /api/health'
        ]
    ], 404);
});