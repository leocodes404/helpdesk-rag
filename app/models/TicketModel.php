<?php
// app/models/TicketModel.php - Consultas preparadas para Tickets y Evidencias

class TicketModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Cuenta el total de tickets registrados para cálculo de correlativo
     */
    public function contarTotal(): int {
        $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM Tickets");
        $res = $stmt->fetch();
        return (int)($res['total'] ?? 0);
    }

    /**
     * Inserta un nuevo ticket en la base de datos
     */
    public function crear(array $datos): int {
        $sql = "INSERT INTO Tickets (codigo_ticket, id_Solicitante, id_servicio, id_categoria, id_prioridad, id_estado, titulo, descripcion) 
                VALUES (:codigo, :solicitante, :servicio, :categoria, :prioridad, :estado, :titulo, :descripcion)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':codigo'      => $datos['codigo_ticket'],
            ':solicitante' => $datos['id_Solicitante'],
            ':servicio'    => $datos['id_servicio'],
            ':categoria'   => $datos['id_categoria'],
            ':prioridad'   => $datos['id_prioridad'],
            ':estado'      => $datos['id_estado'],
            ':titulo'      => $datos['titulo'],
            ':descripcion' => $datos['descripcion']
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Inserta un registro de evidencia adjunta
     */
    public function registrarEvidencia(int $idTicket, string $nombreArchivo, string $tipoArchivo, int $pesoKb): bool {
        $stmt = $this->pdo->prepare("INSERT INTO EvidenciasTickets (id_ticket, ruta_archivo, tipo_archivo, peso_kb) 
                                     VALUES (:ticket, :ruta, :tipo, :peso)");
        return $stmt->execute([
            ':ticket' => $idTicket,
            ':ruta'   => $nombreArchivo,
            ':tipo'   => $tipoArchivo,
            ':peso'   => $pesoKb
        ]);
    }

    /**
     * Consulta pública del estado de un ticket por código y correo del solicitante
     */
    public function consultarPublico(string $codigo, string $correo): ?array {
        $sql = "SELECT 
                    t.codigo_ticket,
                    CONCAT(u.nombre, ' ', u.apellido) AS nombre_solicitante,
                    s.nombre AS servicio_afectado,
                    e.nombre AS estado,
                    p.nivel AS prioridad,
                    t.titulo,
                    t.descripcion,
                    t.horaCreacion AS created_at,
                    ds.diagnostico_tecnico,
                    ds.solucionAplicada AS solucion_aplicada
                FROM Tickets t
                INNER JOIN Usuarios u ON t.id_Solicitante = u.id
                INNER JOIN Servicios s ON t.id_servicio = s.id
                INNER JOIN Estados e ON t.id_estado = e.id
                INNER JOIN Prioridades p ON t.id_prioridad = p.id
                LEFT JOIN DiagnosticoSoluciones ds ON ds.id_ticket = t.id
                WHERE t.codigo_ticket = :codigo AND u.email = :correo
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':codigo' => $codigo,
            ':correo' => $correo
        ]);
        $ticket = $stmt->fetch();
        return $ticket ?: null;
    }
}
