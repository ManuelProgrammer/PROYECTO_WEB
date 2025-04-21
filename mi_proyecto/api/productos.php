<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once '../includes/conexion.php';

$sql = "SELECT id, nombre, precio, grupo, subGrupo, imagen FROM producto";
$resultado = $conn->query($sql);

$productos = [];

if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $productos[] = $fila;
    }
}

echo json_encode($productos);
