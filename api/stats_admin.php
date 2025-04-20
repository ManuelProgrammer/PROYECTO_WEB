<?php
session_start();
header('Content-Type: application/json');

require_once '../includes/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
  http_response_code(403);
  echo json_encode(['error' => 'Acceso denegado']);
  exit;
}

try {
  $data = [
    'productos' => 0,
    'usuarios' => 0,
    'facturas' => 0,
    'total_ventas' => 0
  ];

  // Productos
  $res = $conn->query("SELECT COUNT(*) as total FROM producto");
  if ($res) {
    $data['productos'] = $res->fetch_assoc()['total'];
  }

  // Usuarios con rol cliente
  $res = $conn->query("SELECT COUNT(*) as total FROM usuario WHERE rol = 'cliente'");
  if ($res) {
    $data['usuarios'] = $res->fetch_assoc()['total'];
  }

  // Facturas
  $res = $conn->query("SELECT COUNT(*) as total FROM facturas");
  if ($res) {
    $data['facturas'] = $res->fetch_assoc()['total'];
  }

  // Total ventas (suma de facturas)
  $res = $conn->query("SELECT SUM(total) as total FROM facturas");
  if ($res) {
    $total = $res->fetch_assoc()['total'] ?? 0;
    $data['total_ventas'] = number_format($total, 2, '.', '');
  }

  echo json_encode($data);

} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['error' => 'Error en el servidor', 'detalle' => $e->getMessage()]);
}
