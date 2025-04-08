<?php
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../config.php';

// Capturamos el tipo de acción
$action = $_POST['action'] ?? '';
$correo = $_POST['correo'] ?? '';
$clave = $_POST['clave'] ?? '';

if ($action === 'register') {
    $nombre = $_POST['nombre'] ?? '';
    $telefono = $_POST['numeroTelefono'] ?? null;

    // Llama al controlador para registrar
    AuthController::register($nombre, $correo, $clave, $telefono);

} elseif ($action === 'login') {
    // Llama al controlador para iniciar sesión
    AuthController::login($correo, $clave);
} else {
    // Acción inválida
    header("Location: ../views/auth.php?mode=login&error=invalid_action");
    exit;
}