<?php
// app/controllers/TicketController.php - Controlador para recepción y consulta de tickets

require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../services/TicketService.php';
require_once __DIR__ . '/../models/TicketModel.php';

class TicketController {
    /**
     * Procesa la creación de un nuevo ticket y renderiza la vista de confirmación
     */
    public static function guardar(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?ruta=ticket');
            exit;
        }

        try {
            $pdo = Conexion::getConexion();
            $ticketService = new TicketService($pdo);
            $ticket = $ticketService->crearTicket($_POST, $_FILES['archivo'] ?? null);

            $exito = true;
            $codigoTicket = $ticket['codigo_ticket'];
            $nombre = $ticket['nombre'];
            $correo = $ticket['correo'];
            $estadoInicial = $ticket['estado'];

            require __DIR__ . '/../../views/publico/confirmacion.php';
        } catch (Exception $e) {
            $exito = false;
            $errorMensaje = $e->getMessage();
            require __DIR__ . '/../../views/publico/confirmacion.php';
        }
    }

    /**
     * Responde a peticiones AJAX/fetch con el estado de un ticket en formato JSON
     */
    public static function consultarPublico(): void {
        header('Content-Type: application/json; charset=utf-8');

        $codigo = trim($_GET['codigo_ticket'] ?? '');
        $correo = trim($_GET['correo'] ?? '');

        if (empty($codigo) || empty($correo)) {
            echo json_encode([
                'exito'   => false,
                'mensaje' => 'Por favor ingrese el código y el correo institucional.'
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        try {
            $pdo = Conexion::getConexion();
            $ticketModel = new TicketModel($pdo);
            $ticket = $ticketModel->consultarPublico($codigo, $correo);

            if ($ticket) {
                echo json_encode([
                    'exito'  => true,
                    'ticket' => $ticket
                ], JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode([
                    'exito'   => false,
                    'mensaje' => 'No se encontró ningún ticket con esos datos en la base de datos.'
                ], JSON_UNESCAPED_UNICODE);
            }
        } catch (Exception $e) {
            echo json_encode([
                'exito'   => false,
                'mensaje' => 'Error en la consulta a base de datos: ' . $e->getMessage()
            ], JSON_UNESCAPED_UNICODE);
        }
        exit;
    }
}
