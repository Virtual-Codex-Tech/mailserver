<?php

namespace App\Http\Controllers;

use App\Mail\GmailMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    /**
     * Enviar mensaje a Gmail
     */
    public function sendEmail(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'from_email' => 'sometimes|email',
            'from_name' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Preparar datos
            $to = $request->input('to');
            $subject = $request->input('subject');
            $message = $request->input('message');
            $fromEmail = $request->input('from_email');
            $fromName = $request->input('from_name');

            // Enviar email
            Mail::to($to)->send(new GmailMessage($subject, $message, $fromEmail, $fromName));

            return response()->json([
                'success' => true,
                'message' => 'Email enviado correctamente',
                'data' => [
                    'to' => $to,
                    'subject' => $subject,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar el email',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Enviar mensaje a múltiples destinatarios
     */
    public function sendBulkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to' => 'required|array',
            'to.*' => 'email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $recipients = $request->input('to');
            $subject = $request->input('subject');
            $message = $request->input('message');

            foreach ($recipients as $recipient) {
                Mail::to($recipient)->send(new GmailMessage($subject, $message));
            }

            return response()->json([
                'success' => true,
                'message' => 'Emails enviados correctamente',
                'data' => [
                    'recipients_count' => count($recipients),
                    'subject' => $subject,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar los emails',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
 * Procesar formulario de contacto
 */
public function contactForm(Request $request)
{
    // Validar los datos de entrada
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'message' => 'required|string|min:10',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Error de validación',
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        // Preparar datos
        $name = $request->input('name');
        $email = $request->input('email');
        $userMessage = $request->input('message');

        // Crear el contenido del mensaje
        $emailContent = "
Nuevo mensaje de contacto desde el formulario web:

Nombre: {$name}
Email: {$email}

Mensaje:
{$userMessage}

---
Este mensaje fue enviado desde el formulario de contacto de tu sitio web.
        ";

        // Enviar email a tu dirección de Gmail
        $toEmail = 'jhonier321becerra@gmail.com'; // O especifica un email fijo
        $subject = "Nuevo mensaje de contacto de: {$name}";

        Mail::to($toEmail)->send(new GmailMessage($subject, $emailContent, $email, $name));

        return response()->json([
            'success' => true,
            'message' => 'Mensaje enviado correctamente. Nos pondremos en contacto pronto.'
        ], 200);

    } catch (\Exception $e) {
        \Log::error('Error enviando formulario de contacto: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Error al enviar el mensaje. Por favor, intenta nuevamente.',
            'error' => env('APP_DEBUG') ? $e->getMessage() : null
        ], 500);
    }
}
}