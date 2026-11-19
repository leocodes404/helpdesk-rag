<?php
// app/models/HistorialModel.php - Consultas preparadas para HistorialEstados

class HistorialModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Registra un cambio o evento de estado en el historial del ticket
     */
    public function registrarCambio(int $idTicket, int $idUsuarioAccion, int $idEstadoAnterior, int $idEstadoNuevo, string $comentario): bool {
        $stmt = $this->pdo->prepare("INSERT INTO HistorialEstados (id_ticket, id_usuario_accion, id_estado_anterior, id_estado_nuevo, comentario_cambio) 
                                     VALUES (:ticket, :usuario, :anterior, :nuevo, :comentario)");
        return $stmt->execute([
            ':ticket'     => $idTicket,
            ':usuario'    => $idUsuarioAccion,
            ':anterior'   => $idEstadoAnterior,
            ':nuevo'      => $idEstadoNuevo,
            ':comentario' => $comentario
        ]);
    }
}
