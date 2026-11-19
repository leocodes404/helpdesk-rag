<?php
// views/publico/seguimiento.php - Consulta pública y seguimiento de ticket
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Ticket - HelpDesk RAG</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body class="pagina-publica">

    <main class="contenedor-publico">
        <div class="encabezado-publico">
            <a href="index.php?ruta=inicio" class="marca-google" style="text-decoration: none;">HelpDesk RAG</a>
            <h1>Consultar Estado de Ticket</h1>
            <p>Ingresa tu código correlativo y correo para verificar el estado en vivo.</p>
        </div>
        
        <form id="form-consulta-ticket" class="form-consulta">
            <div class="grupo-input">
                <label for="codigo">Número de Ticket</label>
                <input type="text" id="codigo" name="codigo_ticket" placeholder="Ej: TCK-0001" required>
            </div>
            <div class="grupo-input">
                <label for="correo_solicitante">Correo con el que registró la incidencia</label>
                <input type="email" id="correo_solicitante" name="correo" placeholder="Ej: usuario@uns.edu.pe" required>
            </div>
            <button type="submit" class="btn-google">Buscar Ticket</button>
        </form>

        <section id="resultado-seguimiento" class="caja-resultado oculto" style="margin-top: 24px;">
            <h2>Información del Ticket: <span id="seg-codigo" style="color: #1a73e8; font-family: monospace;"></span></h2>
            <p><strong>Fecha de registro:</strong> <span id="seg-fecha"></span></p>
            <p><strong>Solicitante:</strong> <span id="seg-solicitante"></span></p>
            <p><strong>Servicio afectado:</strong> <span id="seg-servicio"></span></p>
            <p><strong>Prioridad:</strong> <span id="seg-prioridad"></span></p>
            <p><strong>Estado actual:</strong> <span id="seg-estado" style="font-weight: bold; color: #185abc;"></span></p>
            
            <div style="margin-top: 14px;">
                <p><strong>Descripción:</strong></p>
                <p id="seg-descripcion" style="background: #f1f3f4; padding: 12px; border-radius: 6px; font-size: 14px; color: #3c4043;"></p>
            </div>

            <div class="bloque-respuesta" style="margin-top: 16px;">
                <h3>Última actualización / Solución:</h3>
                <p id="seg-comentario" style="font-size: 14px; line-height: 1.5;"></p>
            </div>
        </section>

        <div class="enlaces-publicos" style="margin-top: 24px;">
            <a href="index.php?ruta=ticket">Registrar nueva incidencia</a>
            <a href="index.php?ruta=login">Acceso personal TI</a>
            <a href="index.php?ruta=inicio">Volver al inicio</a>
        </div>
    </main>

    <script>
        const formConsulta = document.getElementById('form-consulta-ticket');

        formConsulta.addEventListener('submit', async (e) => {
            e.preventDefault();
            const codigo = document.getElementById('codigo').value.trim();
            const correo = document.getElementById('correo_solicitante').value.trim();

            if (!codigo || !correo) return;

            try {
                const res = await fetch(`index.php?ruta=api-consultar-ticket&codigo_ticket=${encodeURIComponent(codigo)}&correo=${encodeURIComponent(correo)}`);
                const data = await res.json();

                if (data.exito) {
                    const t = data.ticket;
                    document.getElementById('seg-codigo').textContent = t.codigo_ticket;
                    document.getElementById('seg-fecha').textContent = t.created_at;
                    document.getElementById('seg-solicitante').textContent = t.nombre_solicitante;
                    document.getElementById('seg-servicio').textContent = t.servicio_afectado;
                    if (document.getElementById('seg-prioridad')) {
                        document.getElementById('seg-prioridad').textContent = t.prioridad || 'Media';
                    }
                    if (document.getElementById('seg-descripcion')) {
                        document.getElementById('seg-descripcion').textContent = t.descripcion || '';
                    }
                    document.getElementById('seg-estado').textContent = t.estado;
                    document.getElementById('seg-comentario').textContent = t.solucion_aplicada || 'El ticket se encuentra registrado y pendiente de atención técnica.';
                    document.getElementById('resultado-seguimiento').classList.remove('oculto');
                } else {
                    alert(data.mensaje);
                }
            } catch (err) {
                alert('Error al conectar con la base de datos.');
            }
        });

        // Carga automática si vienen parámetros en la URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('codigo') && urlParams.get('correo')) {
            document.getElementById('codigo').value = urlParams.get('codigo');
            document.getElementById('correo_solicitante').value = urlParams.get('correo');
            formConsulta.dispatchEvent(new Event('submit'));
        }
    </script>
</body>
</html>
