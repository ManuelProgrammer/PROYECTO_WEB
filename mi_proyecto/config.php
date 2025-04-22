<?php
$protocol = "https://"; // Siempre HTTPS en Render
$host = $_SERVER['HTTP_HOST'];

define('BASE_URL', rtrim($protocol . $host, '/'));
?>
