<?php
session_start();
header('Content-Type: application/json');
require_once '../includes/conexion.php';

// Validación de sesión
if (empty($_SESSION['usuario']['id'])) {
  http_response_code(401);
  echo json_encode([]); // ⚠️ React espera un array vacío
  exit;
}

$usuario_id = $_SESSION['usuario']['id'];

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    // 🛒 Obtener productos completos
    if (isset($_GET['productos']) && $_GET['productos'] == 1) {
      $sql = "SELECT p.* 
              FROM wishlist w 
              JOIN producto p ON w.producto_id = p.id 
              WHERE w.usuario_id = ?";
      $stmt = $conn->prepare($sql);
      if (!$stmt) {
        http_response_code(500);
        echo json_encode(['error' => 'Error interno: ' . $conn->error]);
        exit;
      }
      $stmt->bind_param("i", $usuario_id);
      $stmt->execute();
      $result = $stmt->get_result();

      $productos = [];
      while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
      }

      echo json_encode($productos);
      exit;
    }

    // 🆔 Obtener solo IDs de productos
    $sql = "SELECT producto_id FROM wishlist WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
      http_response_code(500);
      echo json_encode(['error' => 'Error interno: ' . $conn->error]);
      exit;
    }
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

    if (is_numeric($producto_id)) {
      $stmt = $conn->prepare("INSERT IGNORE INTO wishlist (usuario_id, producto_id) VALUES (?, ?)");
      if (!$stmt) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Error interno: ' . $conn->error]);
        exit;
      }
      $stmt->bind_param("ii", $usuario_id, $producto_id);
      $stmt->execute();
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['success' => false, 'error' => 'ID de producto inválido']);
    }
    break;

  case 'DELETE':
    $data = json_decode(file_get_contents('php://input'), true);
    $producto_id = $data['producto_id'] ?? null;

    if (is_numeric($producto_id)) {
      $stmt = $conn->prepare("DELETE FROM wishlist WHERE usuario_id = ? AND producto_id = ?");
      if (!$stmt) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Error interno: ' . $conn->error]);
        exit;
      }
      $stmt->bind_param("ii", $usuario_id, $producto_id);
      $stmt->execute();
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['success' => false, 'error' => 'ID de producto inválido']);
    }
    break;

  default:
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Método no permitido']);
    break;
}
