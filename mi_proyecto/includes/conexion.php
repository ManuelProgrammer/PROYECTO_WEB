<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Configuración para Railway
$host = "interchange.proxy.rlwy.net";
$usuario = "root";
$clave = "aCnVZeLPXFKwiqchWBNVPnlKbyfPKnNk";
$base_datos = "railway";
$puerto = 10100;

$conn = new mysqli($host, $usuario, $clave, $base_datos, $puerto);

if ($conn->connect_error) {
    die("❌ Error al conectar con la base de datos: " . $conn->connect_error);
}
?>
