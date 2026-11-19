<?php
// views/publico/confirmacion.php - Pantalla de confirmación de registro de ticket
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Registrado - HelpDesk RAG</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body class="pagina-publica">
    <main class="contenedor-publico">
        <div class="form-publico" style="text-align: center;">
            <?php if (!empty($exito)): ?>
                <div style="width: 56px; height: 56px; margin: 0 auto 16px; background: #e6f4ea; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #137333;">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>

                <h2 style="color: #1a73e8; margin: 0 0 10px;">¡Incidencia Registrada en MySQL!</h2>
                <p style="color: #5f6368; font-size: 15px;">Se han creado las relaciones e historial con integridad referencial.</p>
                
                <div style="background: #e8f0fe; padding: 20px; border-radius: 8px; margin: 20px 0; border: 1px solid #d2e3fc;">
                    <span style="font-size: 13px; color: #5f6368; display: block; margin-bottom: 4px;">Código de seguimiento:</span>
                    <strong style="font-size: 28px; color: #185abc; letter-spacing: 1px; font-family: monospace;"><?= htmlspecialchars($codigoTicket ?? '') ?></strong>
                </div>

                <p style="text-align: left; font-size: 14px; margin-bottom: 6px;">
                    <strong>Solicitante:</strong> <?= htmlspecialchars($nombre ?? '') ?> (<?= htmlspecialchars($correo ?? '') ?>)
                </p>
                <p style="text-align: left; font-size: 14px; margin-bottom: 24px;">
                    <strong>Estado inicial:</strong> <?= htmlspecialchars($estadoInicial ?? 'Registrado (Pendiente)') ?>
                </p>

                <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                    <a href="index.php?ruta=seguimiento&codigo=<?= urlencode($codigoTicket ?? '') ?>&correo=<?= urlencode($correo ?? '') ?>" class="btn-google" style="display: inline-flex; align-items: center; text-decoration: none;">Ver estado en vivo</a>
                    <a href="index.php?ruta=ticket" class="btn-secundario" style="display: inline-flex; align-items: center; border: 1px solid #dadce0; padding: 0 16px; border-radius: 4px; text-decoration: none;">Crear otro ticket</a>
                    <a href="index.php?ruta=inicio" class="btn-secundario" style="display: inline-flex; align-items: center; border: 1px solid #dadce0; padding: 0 16px; border-radius: 4px; text-decoration: none;">Inicio</a>
                </div>
            <?php else: ?>
                <div style="width: 56px; height: 56px; margin: 0 auto 16px; background: #fce8e6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #c5221f;">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </div>

                <h2 style="color: #d93025; margin: 0 0 10px;">Error al Registrar Ticket</h2>
                <p style="color: #5f6368; font-size: 15px; margin-bottom: 20px;">
                    <?= htmlspecialchars($errorMensaje ?? 'Ocurrió un error inesperado al procesar la solicitud.') ?>
                </p>

                <div style="display: flex; gap: 12px; justify-content: center;">
                    <a href="index.php?ruta=ticket" class="btn-google" style="display: inline-flex; align-items: center; text-decoration: none;">Reintentar registro</a>
                    <a href="index.php?ruta=inicio" class="btn-secundario" style="display: inline-flex; align-items: center; border: 1px solid #dadce0; padding: 0 16px; border-radius: 4px; text-decoration: none;">Ir al inicio</a>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
