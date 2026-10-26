CREATE DATABASE IF NOT EXISTS helpdesk_rag CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE helpdesk_rag;

-- 1. Tabla Roles
CREATE TABLE IF NOT EXISTS Roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion VARCHAR(255) NULL
) ENGINE=InnoDB;

-- 2. Tabla Usuarios
CREATE TABLE IF NOT EXISTS Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_Rol INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NULL,
    estado ENUM('Activo', 'Inactivo') DEFAULT 'Activo',
    horaCreacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuarios_roles FOREIGN KEY (id_Rol) REFERENCES Roles(id) ON UPDATE CASCADE
) ENGINE=InnoDB;

-- 3. Tabla Servicios
CREATE TABLE IF NOT EXISTS Servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT NULL,
    estado ENUM('Activo', 'Inactivo') DEFAULT 'Activo'
) ENGINE=InnoDB;

-- 4. Tabla Categorias
CREATE TABLE IF NOT EXISTS Categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_servicios INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NULL,
    CONSTRAINT fk_categorias_servicios FOREIGN KEY (id_servicios) REFERENCES Servicios(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

-- 5. Tabla Prioridades
CREATE TABLE IF NOT EXISTS Prioridades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nivel VARCHAR(30) NOT NULL UNIQUE,
    tiempoResolucionHoras INT NOT NULL,
    color VARCHAR(10) NOT NULL
) ENGINE=InnoDB;

-- 6. Tabla Estados
CREATE TABLE IF NOT EXISTS Estados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- 7. Tabla Tickets
CREATE TABLE IF NOT EXISTS Tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_ticket VARCHAR(20) NOT NULL UNIQUE,
    id_Solicitante INT NOT NULL,
    id_tecnico_asignado INT NULL,
    id_servicio INT NOT NULL,
    id_categoria INT NOT NULL,
    id_prioridad INT NOT NULL,
    id_estado INT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    descripcion TEXT NOT NULL,
    posibleCausa TEXT NULL,
    horaCreacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    horaModificar TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    fechaCierre DATETIME NULL,
    CONSTRAINT fk_tickets_solicitante FOREIGN KEY (id_Solicitante) REFERENCES Usuarios(id) ON UPDATE CASCADE,
    CONSTRAINT fk_tickets_tecnico FOREIGN KEY (id_tecnico_asignado) REFERENCES Usuarios(id) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT fk_tickets_servicios FOREIGN KEY (id_servicio) REFERENCES Servicios(id) ON UPDATE CASCADE,
    CONSTRAINT fk_tickets_categorias FOREIGN KEY (id_categoria) REFERENCES Categorias(id) ON UPDATE CASCADE,
    CONSTRAINT fk_tickets_prioridades FOREIGN KEY (id_prioridad) REFERENCES Prioridades(id) ON UPDATE CASCADE,
    CONSTRAINT fk_tickets_estados FOREIGN KEY (id_estado) REFERENCES Estados(id) ON UPDATE CASCADE
) ENGINE=InnoDB;

-- 8. Tabla EvidenciasTickets
CREATE TABLE IF NOT EXISTS EvidenciasTickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_ticket INT NOT NULL,
    ruta_archivo VARCHAR(255) NOT NULL,
    tipo_archivo VARCHAR(50) NOT NULL,
    peso_kb INT NOT NULL,
    horaCreacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_evidencias_tickets FOREIGN KEY (id_ticket) REFERENCES Tickets(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 9. Tabla HistorialEstados
CREATE TABLE IF NOT EXISTS HistorialEstados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_ticket INT NOT NULL,
    id_usuario_accion INT NOT NULL,
    id_estado_anterior INT NOT NULL,
    id_estado_nuevo INT NOT NULL,
    comentario_cambio TEXT NULL,
    hora_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_historial_tickets FOREIGN KEY (id_ticket) REFERENCES Tickets(id) ON DELETE CASCADE,
    CONSTRAINT fk_historial_usuario FOREIGN KEY (id_usuario_accion) REFERENCES Usuarios(id),
    CONSTRAINT fk_historial_est_ant FOREIGN KEY (id_estado_anterior) REFERENCES Estados(id),
    CONSTRAINT fk_historial_est_nue FOREIGN KEY (id_estado_nuevo) REFERENCES Estados(id)
) ENGINE=InnoDB;

-- 10. Tabla DiagnosticoSoluciones
CREATE TABLE IF NOT EXISTS DiagnosticoSoluciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_ticket INT NOT NULL UNIQUE,
    id_tecnico INT NOT NULL,
    diagnostico_tecnico TEXT NOT NULL,
    solucionAplicada TEXT NOT NULL,
    horaCreacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_diagnostico_tickets FOREIGN KEY (id_ticket) REFERENCES Tickets(id) ON DELETE CASCADE,
    CONSTRAINT fk_diagnostico_tecnico FOREIGN KEY (id_tecnico) REFERENCES Usuarios(id)
) ENGINE=InnoDB;