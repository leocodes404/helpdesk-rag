<?php
// index.php - Front Controller principal de HelpDesk RAG

// 1. Iniciar sesión de forma segura
if (session_status() === PHP_SESSION_NONE) {
    @session_start();
}

// 2. Cargar conexión base y controladores
require_once __DIR__ . '/config/conexion.php';
require_once __DIR__ . '/app/controllers/TicketController.php';
require_once __DIR__ . '/app/controllers/AuthController.php';

// 3. Capturar la ruta solicitada (por defecto 'inicio')
$ruta = trim($_GET['ruta'] ?? 'inicio');

// 4. Enrutamiento centralizado
switch ($ruta) {
    case 'inicio':
        require __DIR__ . '/views/publico/index.php';
        break;

    case 'ticket':
        require __DIR__ . '/views/publico/ticket.php';
        break;

    case 'seguimiento':
        require __DIR__ . '/views/publico/seguimiento.php';
        break;

    case 'login':
        AuthController::mostrarLogin();
        break;

    case 'autenticar':
        AuthController::autenticar();
        break;

    case 'registrar-usuario':
        AuthController::registrar();
        break;

    case 'logout':
        AuthController::logout();
        break;

    case 'panel':
        // Protección de ruta: requiere sesión activa
        if (empty($_SESSION['usuario_id'])) {
            $_SESSION['auth_error'] = "Debe iniciar sesión para acceder al panel de control.";
            header('Location: index.php?ruta=login');
            exit;
        }
        require __DIR__ . '/views/erp/panel.php';
        break;

    case 'guardar-ticket':
        TicketController::guardar();
        break;

    case 'api-consultar-ticket':
        TicketController::consultarPublico();
        break;

    default:
        http_response_code(404);
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Página no encontrada - 404</title>
            <link rel="stylesheet" href="assets/css/estilos.css">
        </head>
        <body class="pagina-publica">
            <main class="contenedor-publico" style="text-align: center;">
                <div class="form-publico">
                    <h1 style="font-size: 64px; color: #1a73e8; margin: 0 0 10px;">404</h1>
                    <h2 style="margin: 0 0 12px; color: #202124;">Página no encontrada</h2>
                    <p style="color: #5f6368; margin-bottom: 24px;">La ruta solicitada (<code><?= htmlspecialchars($ruta) ?></code>) no existe en la plataforma.</p>
                    <a href="index.php?ruta=inicio" class="btn-google" style="display: inline-block; text-decoration: none;">Volver al Inicio</a>
                </div>
            </main>
        </body>
        </html>
        <?php
        break;
}
