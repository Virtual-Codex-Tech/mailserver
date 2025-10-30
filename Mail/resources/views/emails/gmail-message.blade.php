<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $subject ?? 'Nuevo Mensaje de Contacto' }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.7;
            color: #334155;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .email-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            animation: float 20s linear infinite;
        }
        
        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(-20px, -20px) rotate(360deg); }
        }
        
        .header-content {
            position: relative;
            z-index: 2;
        }
        
        .email-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .email-icon svg {
            width: 40px;
            height: 40px;
            color: white;
        }
        
        .email-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }
        
        .email-header p {
            font-size: 16px;
            font-weight: 400;
            opacity: 0.9;
        }
        
        .email-body {
            padding: 40px 30px;
        }
        
        .message-card {
            background: #f8fafc;
            border-radius: 16px;
            padding: 30px;
            border-left: 5px solid #667eea;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .message-card h3 {
            color: #1e293b;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .message-card h3::before {
            content: '💬';
            font-size: 20px;
        }
        
        .message-content {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            font-size: 16px;
            line-height: 1.8;
            white-space: pre-line;
            color: #475569;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .sender-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .info-item {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #e2e8f0;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .info-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .info-label {
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            display: block;
        }
        
        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
        }
        
        .email-footer {
            background: #f8fafc;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }
        
        .footer-content {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .footer-logo {
            color: #667eea;
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .footer-meta {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #94a3b8;
        }
        
        .badge {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        /* Responsive */
        @media (max-width: 640px) {
            body {
                padding: 20px 10px;
            }
            
            .email-container {
                border-radius: 16px;
            }
            
            .email-header {
                padding: 30px 20px;
            }
            
            .email-body {
                padding: 30px 20px;
            }
            
            .sender-info {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .message-card {
                padding: 20px;
            }
            
            .message-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="header-content">
                <div class="email-icon">
                    <!-- SVG Icon -->
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
                <h1>Nuevo Mensaje de Contacto</h1>
                <p>Has recibido un nuevo mensaje desde tu sitio web</p>
            </div>
        </div>
        
        <!-- Body -->
        <div class="email-body">
            @if(isset($name) || isset($email))
            <div class="sender-info">
                @if(isset($name))
                <div class="info-item">
                    <span class="info-label">Nombre</span>
                    <div class="info-value">{{ $name }}</div>
                </div>
                @endif
                
                @if(isset($email))
                <div class="info-item">
                    <span class="info-label">Email</span>
                    <div class="info-value">{{ $email }}</div>
                </div>
                @endif
            </div>
            @endif
            
            <div class="message-card">
                <h3>Mensaje</h3>
                <div class="message-content">
                    {{ $content }}
                </div>
            </div>
            
            <div class="badge">
                📧 Mensaje automático
            </div>
        </div>
        
        <!-- Footer -->
        <div class="email-footer">
            <div class="footer-content">
                <div class="footer-logo">GRUASTJ SERVICE</div>
                <p>Servicios profesionales de calidad</p>
                
                <div class="footer-meta">
                    <p>Este mensaje fue enviado automáticamente desde el formulario de contacto</p>
                    <p>Fecha: {{ now()->format('d/m/Y \\a \\l\\a\\s H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>