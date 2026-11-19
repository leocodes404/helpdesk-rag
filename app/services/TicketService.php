<?php
// app/services/TicketService.php - Lógica de negocio y transacciones ACID para tickets

require_once __DIR__ . '/../models/TicketModel.php';
require_once __DIR__ . '/../models/UsuarioModel.php';
require_once __DIR__ . '/../models/HistorialModel.php';

class TicketService {
    private PDO $pdo;
    private TicketModel $ticketModel;
    private UsuarioModel $usuarioModel;
    private HistorialModel $historialModel;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->ticketModel = new TicketModel($pdo);
        $this->usuarioModel = new UsuarioModel($pdo);
        $this->historialModel = new HistorialModel($pdo);
    }

    /**
     * Registra un ticket de soporte dentro de una transacción ACID
     */
    public function crearTicket(array $postData, ?array $fileData = null): array {
        $nombre = trim($postData['nombre'] ?? '');
        $correo = trim($postData['correo'] ?? '');
        $servicioInput = trim($postData['servicio'] ?? '1');
        $descripcion = trim($postData['descripcion'] ?? '');

        if (empty($nombre) || empty($correo) || empty($descripcion)) {
            throw new InvalidArgumentException("Todos los campos obligatorios (nombre, correo y descripción) deben completarse.");
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("El formato del correo electrónico institucional no es válido.");
        }

        try {
            $this->pdo->beginTransaction();

            // 1. Buscar o registrar al usuario solicitante
            $usuario = $this->usuarioModel->buscarPorEmail($correo);
            if ($usuario) {
                $idSolicitante = (int)$usuario['id'];
            } else {
                $partesNombre = explode(' ', $nombre, 2);
                $primerNombre = $partesNombre[0];
                $apellido = $partesNombre[1] ?? 'General';
                $idSolicitante = $this->usuarioModel->crearSolicitante($primerNombre, $apellido, $correo);
            }

            // 2. Parámetros del catálogo y correlativo
            $idServicio = is_numeric($servicioInput) ? (int)$servicioInput : 1;
            $idCategoria = 1; // Categoría por defecto (Cuentas y Accesos)
            $idPrioridad = 2; // Prioridad Media por defecto
            $idEstado = 1;    // Estado inicial: Registrado (Pendiente)

            $total = $this->ticketModel->contarTotal();
            $codigoTicket = sprintf("TCK-%04d", $total + 1);

            $titulo = mb_substr($descripcion, 0, 50) . (mb_strlen($descripcion) > 50 ? '...' : '');

            // 3. Insertar ticket principal
            $idTicket = $this->ticketModel->crear([
                'codigo_ticket'  => $codigoTicket,
                'id_Solicitante' => $idSolicitante,
                'id_servicio'    => $idServicio,
                'id_categoria'   => $idCategoria,
                'id_prioridad'   => $idPrioridad,
                'id_estado'      => $idEstado,
                'titulo'         => $titulo,
                'descripcion'    => $descripcion
            ]);

            // 4. Manejo de archivo adjunto si se proporcionó evidencia
            if ($fileData && isset($fileData['error']) && $fileData['error'] === UPLOAD_ERR_OK) {
                $carpetaUploads = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
                if (!is_dir($carpetaUploads)) {
                    mkdir($carpetaUploads, 0777, true);
                }

                $nombreOriginal = basename($fileData['name']);
                $nombreArchivo = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $nombreOriginal);
                $rutaDestino = $carpetaUploads . $nombreArchivo;
                $pesoKb = (int)($fileData['size'] / 1024);
                $tipoArchivo = $fileData['type'] ?? 'unknown';

                if (move_uploaded_file($fileData['tmp_name'], $rutaDestino)) {
                    $this->ticketModel->registrarEvidencia($idTicket, $nombreArchivo, $tipoArchivo, $pesoKb);
                }
            }

            // 5. Registrar en HistorialEstados (auditoría inicial inmutable)
            $this->historialModel->registrarCambio(
                $idTicket,
                $idSolicitante,
                1,
                1,
                'Registro inicial de la incidencia desde el portal web'
            );

            $this->pdo->commit();

            return [
                'id'            => $idTicket,
                'codigo_ticket' => $codigoTicket,
                'nombre'        => $nombre,
                'correo'        => $correo,
                'titulo'        => $titulo,
                'descripcion'   => $descripcion,
                'servicio'      => $idServicio,
                'estado'        => 'Registrado (Pendiente)'
            ];

        } catch (Exception $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw new RuntimeException("Error al procesar la persistencia del ticket: " . $e->getMessage(), 0, $e);
        }
    }
}
