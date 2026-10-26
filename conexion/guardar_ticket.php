<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $servicioInput = trim($_POST['servicio'] ?? '1');
    $descripcion = trim($_POST['descripcion'] ?? '');

    if (empty($nombre) || empty($correo) || empty($descripcion)) {
        die("Error: Todos los campos obligatorios deben completarse.");
    }

    try {
        $pdo->beginTransaction();

        // 1. Buscar si el solicitante ya existe en la tabla Usuarios, sino crearlo
        $stmtUser = $pdo->prepare("SELECT id FROM Usuarios WHERE email = :correo LIMIT 1");
        $stmtUser->execute([':correo' => $correo]);
        $usuario = $stmtUser->fetch();

        if ($usuario) {
            $idSolicitante = $usuario['id'];
        } else {
            // Dividir nombre y apellido básico
            $partesNombre = explode(' ', $nombre, 2);
            $primerNombre = $partesNombre[0];
            $apellido = $partesNombre[1] ?? 'General';

            $stmtCrearUser = $pdo->prepare("INSERT INTO Usuarios (id_Rol, nombre, apellido, email, password_hash, estado) 
                                           VALUES (4, :nombre, :apellido, :email, 'solicitante_sin_clave', 'Activo')");
            $stmtCrearUser->execute([
                ':nombre' => $primerNombre,
                ':apellido' => $apellido,
                ':email' => $correo
            ]);
            $idSolicitante = $pdo->lastInsertId();
        }

        // 2. Determinar el id_servicio
        $idServicio = is_numeric($servicioInput) ? (int)$servicioInput : 1;
        $idCategoria = 1; // Categoría por defecto
        $idPrioridad = 2; // Prioridad Media por defecto
        $idEstado = 1;    // Estado 'Registrado' inicial

        // 3. Generar código correlativo TCK-2026-XXXX
        $stmtCount = $pdo->query("SELECT COUNT(*) AS total FROM Tickets");
        $siguiente = $stmtCount->fetch()['total'] + 1;
        $codigoTicket = sprintf("TCK-%04d", $siguiente);

        // Generar título automático a partir de los primeros 50 caracteres de la descripción
        $titulo = mb_substr($descripcion, 0, 50) . '...';

        // 4. Insertar en la tabla relacional Tickets
        $sqlTicket = "INSERT INTO Tickets (codigo_ticket, id_Solicitante, id_servicio, id_categoria, id_prioridad, id_estado, titulo, descripcion) 
                      VALUES (:codigo, :solicitante, :servicio, :categoria, :prioridad, :estado, :titulo, :descripcion)";
        $stmtTicket = $pdo->prepare($sqlTicket);
        $stmtTicket->execute([
            ':codigo'      => $codigoTicket,
            ':solicitante' => $idSolicitante,
            ':servicio'    => $idServicio,
            ':categoria'   => $idCategoria,
            ':prioridad'   => $idPrioridad,
            ':estado'      => $idEstado,
            ':titulo'      => $titulo,
            ':descripcion' => $descripcion
        ]);
        $idTicket = $pdo->lastInsertId();

        // 5. Si adjuntó archivo, registrarlo en EvidenciasTickets
        if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
            $carpeta = '../uploads/';
            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            $nombreOriginal = basename($_FILES['archivo']['name']);
            $nombreArchivo = time() . '_' . $nombreOriginal;
            $pesoKb = (int)($_FILES['archivo']['size'] / 1024);
            $tipoArchivo = $_FILES['archivo']['type'] ?? 'unknown';

            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $carpeta . $nombreArchivo)) {
                $stmtEvidencia = $pdo->prepare("INSERT INTO EvidenciasTickets (id_ticket, ruta_archivo, tipo_archivo, peso_kb) 
                                                VALUES (:ticket, :ruta, :tipo, :peso)");
                $stmtEvidencia->execute([
                    ':ticket' => $idTicket,
                    ':ruta'   => $nombreArchivo,
                    ':tipo'   => $tipoArchivo,
                    ':peso'   => $pesoKb
                ]);
            }
        }

        // 6. Registrar en HistorialEstados
        $stmtHistorial = $pdo->prepare("INSERT INTO HistorialEstados (id_ticket, id_usuario_accion, id_estado_anterior, id_estado_nuevo, comentario_cambio) 
                                        VALUES (:ticket, :usuario, 1, 1, 'Registro inicial de la incidencia desde el portal web')");
        $stmtHistorial->execute([
            ':ticket'  => $idTicket,
            ':usuario' => $idSolicitante
        ]);

        $pdo->commit();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket Registrado - HelpDesk RAG</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body class="pagina-publica">
    <main class="contenedor-publico">
        <div class="form-publico" style="text-align: center;">
            <h2 style="color: #1a73e8; margin: 0 0 10px;">¡Incidencia Registrada en MySQL!</h2>
            <p style="color: #5f6368; font-size: 15px;">Se han creado las relaciones e historial con integridad referencial.</p>
            
            <div style="background: #e8f0fe; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <span style="font-size: 13px; color: #5f6368; display: block; margin-bottom: 4px;">Código de seguimiento:</span>
                <strong style="font-size: 28px; color: #185abc; letter-spacing: 1px;"><?= htmlspecialchars($codigoTicket) ?></strong>
            </div>

            <p style="text-align: left; font-size: 14px; margin-bottom: 6px;"><strong>Solicitante:</strong> <?= htmlspecialchars($nombre) ?> (<?= htmlspecialchars($correo) ?>)</p>
            <p style="text-align: left; font-size: 14px; margin-bottom: 24px;"><strong>Estado inicial:</strong> Registrado (Pendiente)</p>

            <div style="display: flex; gap: 12px; justify-content: center;">
                <a href="../vistas/seguimiento.html?codigo=<?= urlencode($codigoTicket) ?>&correo=<?= urlencode($correo) ?>" class="btn-google" style="display: inline-flex; align-items: center; text-decoration: none;">Ver estado en vivo</a>
                <a href="../vistas/ticket.html" class="btn-secundario" style="display: inline-flex; align-items: center; border: 1px solid #dadce0; padding: 0 16px; border-radius: 4px; text-decoration: none;">Crear otro ticket</a>
            </div>
        </div>
    </main>
</body>
</html>
<?php
    } catch (Exception $e) {
        $pdo->rollBack();
        die("Error al persistir en la base de datos: " . $e->getMessage());
    }
}
?>