<?php
$protocol = "https://"; // Siempre HTTPS, Render lo soporta
$host = $_SERVER['HTTP_HOST'];
$basePath = "/mi_proyecto"; // Asegúrate que coincide con tu estructura real

define('BASE_URL', $protocol . $host . $basePath);
?>