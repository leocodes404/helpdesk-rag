<?php
// app/models/UsuarioModel.php - Consultas preparadas para la tabla Usuarios y Roles

class UsuarioModel {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Busca un usuario por su correo electrónico incluyendo el nombre del rol asignado
     */
    public function buscarPorCorreo(string $email): ?array {
        $sql = "SELECT 
                    u.id, 
                    u.id_Rol, 
                    u.nombre, 
                    u.apellido, 
                    u.email, 
                    u.password_hash, 
                    u.telefono, 
                    u.estado, 
                    COALESCE(r.nombre, 'Personal TI') AS rol_nombre
                FROM Usuarios u
                LEFT JOIN Roles r ON u.id_Rol = r.id
                WHERE u.email = :correo
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':correo' => $email]);
        $usuario = $stmt->fetch();
        return $usuario ?: null;
    }

    /**
     * Alias de compatibilidad para buscarPorCorreo
     */
    public function buscarPorEmail(string $email): ?array {
        return $this->buscarPorCorreo($email);
    }

    /**
     * Verifica si un correo electrónico ya está registrado en el sistema
     */
    public function existeCorreo(string $email): bool {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM Usuarios WHERE email = :correo");
        $stmt->execute([':correo' => $email]);
        $res = $stmt->fetch();
        return ((int)($res['total'] ?? 0)) > 0;
    }

    /**
     * Obtiene el catálogo de roles registrados en la base de datos
     */
    public function obtenerRoles(): array {
        try {
            $stmt = $this->pdo->query("SELECT id, nombre, descripcion FROM Roles ORDER BY id ASC");
            $roles = $stmt->fetchAll();
            if (!empty($roles)) {
                return $roles;
            }
        } catch (PDOException $e) {
            // Fallback en caso de que la tabla aún no contenga registros
        }

        // Catálogo representativo basado en el diseño relacional del sistema
        return [
            ['id' => 2, 'nombre' => 'Supervisor de Soporte', 'descripcion' => 'Gobierno global y triaje de tickets'],
            ['id' => 3, 'nombre' => 'Técnico TI', 'descripcion' => 'Atención asistida de incidencias con RAG']
        ];
    }

    /**
     * Inserta un nuevo usuario completo en la tabla Usuarios
     */
    public function crearUsuario(array $datos): int {
        $sql = "INSERT INTO Usuarios (id_Rol, nombre, apellido, email, password_hash, telefono, estado) 
                VALUES (:id_rol, :nombre, :apellido, :email, :password_hash, :telefono, :estado)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_rol'        => $datos['id_rol'],
            ':nombre'        => $datos['nombre'],
            ':apellido'      => $datos['apellido'],
            ':email'         => $datos['email'],
            ':password_hash' => $datos['password_hash'],
            ':telefono'      => $datos['telefono'] ?? null,
            ':estado'        => $datos['estado'] ?? 'Activo'
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Registra un nuevo solicitante sin contraseña (creado desde el portal de tickets)
     */
    public function crearSolicitante(string $nombre, string $apellido, string $email): int {
        $stmt = $this->pdo->prepare("INSERT INTO Usuarios (id_Rol, nombre, apellido, email, password_hash, estado) 
                                     VALUES (4, :nombre, :apellido, :email, 'solicitante_sin_clave', 'Activo')");
        $stmt->execute([
            ':nombre'   => $nombre,
            ':apellido' => $apellido,
            ':email'    => $email
        ]);
        return (int)$this->pdo->lastInsertId();
    }
}
