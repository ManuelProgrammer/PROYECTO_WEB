<?php
session_start();

// Eliminar todas las variables de sesión
$_SESSION = [];

// Eliminar cookie de sesión (opcional pero recomendable)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
    );
}

// Finalmente destruir la sesión
session_destroy();

// Redirigir al login con modo correcto
header("Location: ../views/auth.php?mode=login");
exit;
