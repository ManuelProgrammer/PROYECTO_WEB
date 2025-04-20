<?php
session_start();
header('Content-Type: application/json');
require_once '../includes/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
  http_response_code(403);
  echo json_encode(['error' => 'Acceso denegado']);
  exit;
}

$sql = "
  SELECT f.id AS numeroFactura, u.nombre AS cliente, f.fecha, f.total
  FROM facturas f
  INNER JOIN usuario u ON f.usuario_id = u.id
  ORDER BY f.fecha DESC
";

$resultado = $conn->query($sql);
$facturas = [];

while ($row = $resultado->fetch_assoc()) {
  // Simulación de cálculo de Subtotal e IGV (18%)
  $row['subTotal'] = number_format($row['total'] / 1.18, 2);
  $row['igv'] = number_format($row['total'] - $row['subTotal'], 2);
  $row['total'] = number_format($row['total'], 2); // por si viene como float
  $facturas[] = $row;
}

echo json_encode($facturas);
