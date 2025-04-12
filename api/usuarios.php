<?php
session_start();
header('Content-Type: application/json');

require_once '../includes/conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
  http_response_code(403);
  echo json_encode(['error' => 'Acceso denegado']);
  exit;
}

$sql = "SELECT id, nombre, correo, rol, numeroTelefono FROM usuario ORDER BY id DESC";
$result = $conn->query($sql);

$usuarios = [];
while ($row = $result->fetch_assoc()) {
  $usuarios[] = $row;
}

echo json_encode($usuarios);
