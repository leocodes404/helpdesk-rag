<?php
// config/conexion.php - Conexión centralizada a base de datos MySQL (PDO)

$host = '127.0.0.1';
$dbname = 'helpdesk_rag';
$usuario = 'root';
$password = '';

$errorConexionBD = null;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $usuario, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    $errorConexionBD = $e->getMessage();
    $pdo = null;
}

if (!class_exists('Conexion')) {
    class Conexion {
        private static ?PDO $instancia = null;

        public static function getConexion(): PDO {
            global $pdo, $errorConexionBD;
            if ($pdo === null) {
                throw new RuntimeException("Error de conexión a la base de datos MySQL: " . ($errorConexionBD ?? 'No se pudo establecer conexión.'));
            }
            if (self::$instancia === null) {
                self::$instancia = $pdo;
            }
            return self::$instancia;
        }
    }
}

return $pdo;
