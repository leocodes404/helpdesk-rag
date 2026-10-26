<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'conexion.php';

$codigo = trim($_GET['codigo_ticket'] ?? '');
$correo = trim($_GET['correo'] ?? '');

if (empty($codigo) || empty($correo)) {
    echo json_encode(['exito' => false, 'mensaje' => 'Por favor ingrese el código y el correo.']);
    exit;
}

try {
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

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':codigo' => $codigo, ':correo' => $correo]);
    $ticket = $stmt->fetch();

    if ($ticket) {
        echo json_encode(['exito' => true, 'ticket' => $ticket]);
    } else {
        echo json_encode(['exito' => false, 'mensaje' => 'No se encontró ningún ticket con esos datos en la base de datos.']);
    }
} catch (PDOException $e) {
    echo json_encode(['exito' => false, 'mensaje' => 'Error en la consulta: ' . $e->getMessage()]);
}