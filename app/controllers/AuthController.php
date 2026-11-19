<?php
// app/controllers/AuthController.php - Controlador de autenticación y registro de usuarios

require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../models/UsuarioModel.php';

class AuthController {
    /**
     * Muestra la pantalla de acceso / registro al sistema ERP
     */
    public static function mostrarLogin(): void {
        if (!empty($_SESSION['usuario_id'])) {
            header('Location: index.php?ruta=panel');
            exit;
        }

        try {
            $pdo = Conexion::getConexion();
            $usuarioModel = new UsuarioModel($pdo);
            $roles = $usuarioModel->obtenerRoles();
        } catch (Exception $e) {
            $roles = [
                ['id' => 2, 'nombre' => 'Supervisor de Soporte'],
                ['id' => 3, 'nombre' => 'Técnico TI']
            ];
        }

        // Mensajes flash
        $authError = $_SESSION['auth_error'] ?? null;
        $authExito = $_SESSION['auth_exito'] ?? null;
        $authTab   = $_SESSION['auth_tab'] ?? 'login';
        $authEmail = $_SESSION['auth_email'] ?? '';

        unset($_SESSION['auth_error'], $_SESSION['auth_exito'], $_SESSION['auth_tab'], $_SESSION['auth_email']);

        require __DIR__ . '/../../views/erp/login.php';
    }

    /**
     * Procesa la autenticación de usuarios (POST)
     */
    public static function autenticar(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?ruta=login');
            exit;
        }

        $correo = trim($_POST['correo'] ?? '');
        $clave  = trim($_POST['clave'] ?? '');

        if (empty($correo) || empty($clave)) {
            $_SESSION['auth_error'] = "Por favor ingrese su correo institucional y su contraseña.";
            $_SESSION['auth_tab']   = 'login';
            $_SESSION['auth_email'] = $correo;
            header('Location: index.php?ruta=login');
            exit;
        }

        try {
            $pdo = Conexion::getConexion();
            $usuarioModel = new UsuarioModel($pdo);
            $usuario = $usuarioModel->buscarPorCorreo($correo);

            if (!$usuario) {
                $_SESSION['auth_error'] = "No existe ninguna cuenta registrada con el correo proporcionado.";
                $_SESSION['auth_tab']   = 'login';
                $_SESSION['auth_email'] = $correo;
                header('Location: index.php?ruta=login');
                exit;
            }

            if (($usuario['estado'] ?? 'Activo') !== 'Activo') {
                $_SESSION['auth_error'] = "Su cuenta de usuario se encuentra inactiva. Contacte al administrador.";
                $_SESSION['auth_tab']   = 'login';
                $_SESSION['auth_email'] = $correo;
                header('Location: index.php?ruta=login');
                exit;
            }

            // Comprobación de contraseña con password_verify
            $hashAlmacenado = $usuario['password_hash'];
            $claveValida = password_verify($clave, $hashAlmacenado);

            // Respaldo de compatibilidad en caso de datos de prueba en texto plano en la BD
            if (!$claveValida && $hashAlmacenado === $clave) {
                $claveValida = true;
            }

            if (!$claveValida) {
                $_SESSION['auth_error'] = "Credenciales incorrectas. Verifique su contraseña.";
                $_SESSION['auth_tab']   = 'login';
                $_SESSION['auth_email'] = $correo;
                header('Location: index.php?ruta=login');
                exit;
            }

            // Inicio de sesión exitoso
            session_regenerate_id(true);
            $_SESSION['usuario_id']         = (int)$usuario['id'];
            $_SESSION['usuario_nombre']     = trim($usuario['nombre'] . ' ' . $usuario['apellido']);
            $_SESSION['usuario_correo']     = $usuario['email'];
            $_SESSION['usuario_rol_id']     = (int)$usuario['id_Rol'];
            $_SESSION['usuario_rol_nombre'] = $usuario['rol_nombre'] ?? 'Personal TI';

            header('Location: index.php?ruta=panel');
            exit;

        } catch (Exception $e) {
            $_SESSION['auth_error'] = "Error al autenticar: " . $e->getMessage();
            $_SESSION['auth_tab']   = 'login';
            $_SESSION['auth_email'] = $correo;
            header('Location: index.php?ruta=login');
            exit;
        }
    }

    /**
     * Procesa el registro de nuevos usuarios en MySQL (POST)
     */
    public static function registrar(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?ruta=login');
            exit;
        }

        $nombre          = trim($_POST['nombre'] ?? '');
        $apellido        = trim($_POST['apellido'] ?? '');
        $email           = trim($_POST['email'] ?? '');
        $telefono        = trim($_POST['telefono'] ?? '');
        $idRol           = (int)($_POST['id_rol'] ?? 3);
        $password        = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        if (empty($nombre) || empty($apellido) || empty($email) || empty($password)) {
            $_SESSION['auth_error'] = "Todos los campos marcados como obligatorios deben completarse.";
            $_SESSION['auth_tab']   = 'registro';
            $_SESSION['auth_email'] = $email;
            header('Location: index.php?ruta=login');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['auth_error'] = "El formato del correo electrónico institucional no es válido.";
            $_SESSION['auth_tab']   = 'registro';
            $_SESSION['auth_email'] = $email;
            header('Location: index.php?ruta=login');
            exit;
        }

        if (strlen($password) < 8) {
            $_SESSION['auth_error'] = "La contraseña debe tener una longitud mínima de 8 caracteres.";
            $_SESSION['auth_tab']   = 'registro';
            $_SESSION['auth_email'] = $email;
            header('Location: index.php?ruta=login');
            exit;
        }

        if ($password !== $passwordConfirm) {
            $_SESSION['auth_error'] = "Las contraseñas ingresadas no coinciden. Verifíquelas e intente nuevamente.";
            $_SESSION['auth_tab']   = 'registro';
            $_SESSION['auth_email'] = $email;
            header('Location: index.php?ruta=login');
            exit;
        }

        try {
            $pdo = Conexion::getConexion();
            $usuarioModel = new UsuarioModel($pdo);

            if ($usuarioModel->existeCorreo($email)) {
                $_SESSION['auth_error'] = "El correo ya está registrado en el sistema. Puedes iniciar sesión directamente.";
                $_SESSION['auth_tab']   = 'login';
                $_SESSION['auth_email'] = $email;
                header('Location: index.php?ruta=login');
                exit;
            }

            // Hashing obligatorio de contraseña con algoritmo seguro
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $usuarioModel->crearUsuario([
                'id_rol'        => $idRol > 0 ? $idRol : 3,
                'nombre'        => $nombre,
                'apellido'      => $apellido,
                'email'         => $email,
                'password_hash' => $passwordHash,
                'telefono'      => !empty($telefono) ? $telefono : null,
                'estado'        => 'Activo'
            ]);

            $_SESSION['auth_exito'] = "¡Cuenta creada exitosamente! Ahora puedes iniciar sesión con tus credenciales.";
            $_SESSION['auth_tab']   = 'login';
            $_SESSION['auth_email'] = $email;
            header('Location: index.php?ruta=login');
            exit;

        } catch (Exception $e) {
            $_SESSION['auth_error'] = "Error al crear la cuenta de usuario: " . $e->getMessage();
            $_SESSION['auth_tab']   = 'registro';
            $_SESSION['auth_email'] = $email;
            header('Location: index.php?ruta=login');
            exit;
        }
    }

    /**
     * Cierra la sesión activa del usuario
     */
    public static function logout(): void {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        header('Location: index.php?ruta=login');
        exit;
    }
}
