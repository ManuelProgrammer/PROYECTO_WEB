<?php
session_start();
header('Content-Type: application/json');

require_once '../includes/conexion.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
  http_response_code(403);
  echo json_encode(['error' => 'Acceso denegado']);
  exit;
}

// Total de usuarios
$sqlUsuarios = $conn->query("SELECT COUNT(*) AS total FROM usuario");
$totalUsuarios = $sqlUsuarios->fetch_assoc()['total'];

// Total de productos
$sqlProductos = $conn->query("SELECT COUNT(*) AS total FROM producto WHERE stock > 0");
$totalProductos = $sqlProductos->fetch_assoc()['total'];

// Total de facturas
$sqlFacturas = $conn->query("SELECT COUNT(*) AS total FROM factura");
$totalFacturas = $sqlFacturas->fetch_assoc()['total'];

echo json_encode([
  'totalUsuarios' => $totalUsuarios,
  'totalProductos' => $totalProductos,
  'totalFacturas' => $totalFacturas
]);
