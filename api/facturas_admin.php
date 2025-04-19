<?php
session_start();
header('Content-Type: application/json');

require_once '../includes/conexion.php';

// Verificar sesión y rol
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
  http_response_code(403);
  echo json_encode(['error' => 'Acceso denegado']);
  exit;
}


// Consultar las facturas con nombre del usuario
$sql = "
  SELECT f.numeroFactura, u.nombre AS cliente, f.fecha, 
         f.subTotal, f.igv, f.total
  FROM factura f
  INNER JOIN usuario u ON f.usuario_id = u.id
  ORDER BY f.fecha DESC
";

$resultado = $conn->query($sql);

$facturas = [];

while ($row = $resultado->fetch_assoc()) {
  $facturas[] = $row;
}

echo json_encode($facturas);
