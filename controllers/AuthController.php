<?php
require_once __DIR__ . '/../includes/conexion.php';
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    public static function login($correo, $clave) {
        $usuario = Usuario::buscarPorCorreo($correo);
        if ($usuario && password_verify($clave, $usuario['clave'])) {
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['rol'] = $usuario['rol'];
            header("Location: ../index.php");
            exit;
        } else {
            header("Location: ../views/auth.php?mode=login&error=1");
            exit;
        }
    }

    public static function register($nombre, $correo, $clave, $telefono = null) {
        // Verificar si ya existe el correo
        if (Usuario::buscarPorCorreo($correo)) {
            header("Location: ../views/auth.php?mode=register&error=email_exists");
            exit;
        }

        $claveHash = password_hash($clave, PASSWORD_DEFAULT);
        if (Usuario::crear($nombre, $correo, $claveHash, $telefono)) {
            header("Location: ../views/auth.php?mode=login&success=1");
        } else {
            header("Location: ../views/auth.php?mode=register&error=1");
        }
        exit;
    }
}
