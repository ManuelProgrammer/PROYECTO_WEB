<?php
session_start();
header('Content-Type: application/json');
require_once '../includes/conexion.php';

if (!isset($_SESSION['usuario'])) {
  http_response_code(401);
  echo json_encode(['error' => 'No autorizado']);
  exit;
}

$usuario_id = $_SESSION['usuario']['id'];

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    $sql = "SELECT producto_id FROM wishlist WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $favoritos = [];

    while ($row = $result->fetch_assoc()) {
      $favoritos[] = $row['producto_id'];
    }

    echo json_encode($favoritos);
    break;

  case 'POST':
    $data = json_decode(file_get_contents('php://input'), true);
    $producto_id = $data['producto_id'] ?? null;

    if ($producto_id) {
      $stmt = $conn->prepare("INSERT IGNORE INTO wishlist (usuario_id, producto_id) VALUES (?, ?)");
      $stmt->bind_param("ii", $usuario_id, $producto_id);
      $stmt->execute();
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['success' => false, 'error' => 'ID producto no válido']);
    }
    break;

  case 'DELETE':
    $data = json_decode(file_get_contents('php://input'), true);
    $producto_id = $data['producto_id'] ?? null;

    if ($producto_id) {
      $stmt = $conn->prepare("DELETE FROM wishlist WHERE usuario_id = ? AND producto_id = ?");
      $stmt->bind_param("ii", $usuario_id, $producto_id);
      $stmt->execute();
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['success' => false, 'error' => 'ID producto no válido']);
    }
    break;
}
