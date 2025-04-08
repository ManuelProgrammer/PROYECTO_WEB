<?php
$host = "localhost";
$usuario = "root";
$clave = "";
$base_datos = "tienda_virtual";
$puerto = 3307;

$conn = new mysqli($host, $usuario, $clave, $base_datos, $puerto);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
