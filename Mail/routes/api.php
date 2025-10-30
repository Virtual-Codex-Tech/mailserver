<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

// Ruta para el formulario de contacto
Route::post('/contact-form', [EmailController::class, 'contactForm']);

// Tus rutas existentes
Route::prefix('email')->group(function () {
    Route::post('/send', [EmailController::class, 'sendEmail']);
    Route::post('/send-bulk', [EmailController::class, 'sendBulkEmail']);
});