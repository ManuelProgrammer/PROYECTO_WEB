<?php
$protocol = "https://"; // Siempre HTTPS, Render lo soporta
$host = $_SERVER['HTTP_HOST'];

define('BASE_URL', $protocol . $host); // ❌ sin /mi_proyecto
?>
