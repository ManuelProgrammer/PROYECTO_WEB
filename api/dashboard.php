<?php
// Mostrar errores (solo para desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
header('Content-Type: application/json');

// Incluir conexión
require_once '../includes/conexion.php';

// Validar sesión como admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
  http_response_code(403);
  echo json_encode(['error' => 'Acceso denegado']);
  exit;
}

try {
  // Total de usuarios con rol 'cliente'
  $sqlClientes = $conn->query("SELECT COUNT(*) AS total FROM usuario WHERE rol = 'cliente'");
  $totalUsuarios = $sqlClientes->fetch_assoc()['total'];

  // Total de productos con stock
  $sqlProductos = $conn->query("SELECT COUNT(*) AS total FROM producto WHERE stock > 0");
  $totalProductos = $sqlProductos->fetch_assoc()['total'];

  // Total de facturas
  $sqlFacturas = $conn->query("SELECT COUNT(*) AS total FROM facturas");
  $totalFacturas = $sqlFacturas->fetch_assoc()['total'];

  // Respuesta JSON con claves correctas para React
  echo json_encode([
    'totalUsuarios' => $totalUsuarios,
    'totalProductos' => $totalProductos,
    'totalFacturas' => $totalFacturas
  ]);
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode([
    'error' => 'Error en el servidor',
    'detalle' => $e->getMessage()
  ]);
}
