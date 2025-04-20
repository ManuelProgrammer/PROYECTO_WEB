<?php
session_start();
header('Content-Type: application/json');
require_once '../includes/conexion.php';

if (!isset($_SESSION['usuario'])) {
  http_response_code(401);
  echo json_encode(['success' => false, 'error' => 'No autorizado']);
  exit;
}

$usuario_id = $_SESSION['usuario']['id'] ?? null;

switch ($_SERVER['REQUEST_METHOD']) {
  case 'POST':
    $data = json_decode(file_get_contents('php://input'), true);
    $producto_id = $data['producto_id'] ?? null;
    $cantidad = $data['cantidad'] ?? 1;

    if (!$producto_id || !is_numeric($producto_id)) {
      echo json_encode(['success' => false, 'error' => 'Producto inválido']);
      exit;
    }

    // Verifica si ya existe en el carrito
    $check = $conn->prepare("SELECT id FROM carrito WHERE usuario_id = ? AND producto_id = ?");
    $check->bind_param("ii", $usuario_id, $producto_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
      echo json_encode(['success' => true, 'message' => 'Ya estaba en el carrito']);
      exit;
    }

    // Insertar
    $stmt = $conn->prepare("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $usuario_id, $producto_id, $cantidad);
    $stmt->execute();

    echo json_encode(['success' => true]);
    break;

  default:
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
    break;
}
