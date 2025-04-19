<?php
session_start();
header('Content-Type: application/json');

require_once '../includes/conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
  http_response_code(403);
  echo json_encode(['error' => 'Acceso denegado']);
  exit;
}


$data = [
  'productos' => 0,
  'usuarios' => 0,
  'facturas' => 0,
  'total_ventas' => 0
];

// Total productos
$res = $conn->query("SELECT COUNT(*) as total FROM producto");
$data['productos'] = $res->fetch_assoc()['total'];

// Total usuarios
$res = $conn->query("SELECT COUNT(*) as total FROM usuario WHERE rol = 'cliente'");
$data['usuarios'] = $res->fetch_assoc()['total'];

// Total facturas
$res = $conn->query("SELECT COUNT(*) as total FROM factura");
$data['facturas'] = $res->fetch_assoc()['total'];

// Total ventas
$res = $conn->query("SELECT SUM(total) as total FROM factura");
$data['total_ventas'] = number_format($res->fetch_assoc()['total'] ?? 0, 2);

echo json_encode($data);
