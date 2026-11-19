<?php
// views/publico/ticket.php - Formulario público para registro de ticket
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Ticket - HelpDesk RAG</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body class="pagina-publica">
    <main class="contenedor-publico">
        <div class="encabezado-publico">
            <a href="index.php?ruta=inicio" class="marca-google" style="text-decoration: none;">HelpDesk RAG</a>
            <h1>Registro de Ticket</h1>
            <p>Describe tu incidencia y nuestro equipo te ayudará.</p>
        </div>

        <form action="index.php?ruta=guardar-ticket" method="POST" enctype="multipart/form-data" class="form-publico formulario-ticket">
            
            <div class="grupo-input">
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ej: Anthony Carranza" required>
            </div>

            <div class="grupo-input">
                <label for="correo">Correo Electrónico Institucional</label>
                <input type="email" id="correo" name="correo" placeholder="Ej: usuario@uns.edu.pe" required>
            </div>

            <div class="grupo-input">
                <label for="servicio">Servicio afectado</label>
                <select id="servicio" name="servicio" required>
                    <option value="" disabled selected>Seleccione un servicio</option>
                    <option value="1">Cuentas y Accesos (Correo / Portal Académico)</option>
                    <option value="2">Redes y Conectividad (Wi-Fi / Red Cableada)</option>
                    <option value="3">Equipos y Hardware (Computadoras / Impresoras)</option>
                </select>
            </div>

            <div class="grupo-input">
                <label for="descripcion">Descripción del problema</label>
                <textarea id="descripcion" name="descripcion" maxlength="500" placeholder="Detalla qué problema ocurre con la mayor precisión posible..." required></textarea>
            </div>

            <div class="grupo-input">
                <label for="archivo">Adjuntar evidencia o captura <span>(opcional)</span></label>
                <input type="file" id="archivo" name="archivo" accept=".jpg,.jpeg,.png,.pdf,.docx,.xlsx">
            </div>

            <button type="submit" class="btn-google">Enviar ticket</button>
        </form>

        <nav class="enlaces-publicos">
            <a href="index.php?ruta=seguimiento">Consultar estado de mi ticket</a>
            <a href="index.php?ruta=login">Acceso personal TI</a>
            <a href="index.php?ruta=inicio">Volver al inicio</a>
        </nav>
    </main>
</body>
</html>
