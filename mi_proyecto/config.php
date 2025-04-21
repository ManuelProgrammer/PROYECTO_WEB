<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$basePath = "/mi_proyecto"; // o ajusta si cambiaste la estructura

define('BASE_URL', $protocol . $host . $basePath);
?>
