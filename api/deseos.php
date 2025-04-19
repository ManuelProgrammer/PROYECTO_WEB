<?php
session_start();
header('Content-Type: application/json');

require_once '../includes/conexion.php';

if (!isset($_SESSION['usuario'])) {
  http_response_code(403);
  echo json_encode(['error' => 'No autenticado']);
  exit;
}

$usuario_id = $_SESSION['usuario']['id'];

// 🔄 Obtener deseos
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $sql = "SELECT producto_id FROM lista_deseos WHERE usuario_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $usuario_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $deseos = [];
  while ($row = $result->fetch_assoc()) {
    $deseos[] = $row;
  }
  echo json_encode($deseos);
  exit;
}

// ❤️ Agregar a deseos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"), true);
  $producto_id = $data['producto_id'] ?? null;

  if ($producto_id) {
    $sql = "INSERT IGNORE INTO lista_deseos (usuario_id, producto_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $usuario_id, $producto_id);
    $success = $stmt->execute();
    echo json_encode(['success' => $success]);
    exit;
  }
}

// 💔 Eliminar de deseos
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  $data = json_decode(file_get_contents("php://input"), true);
  $producto_id = $data['producto_id'] ?? null;

  if ($producto_id) {
    $sql = "DELETE FROM lista_deseos WHERE usuario_id = ? AND producto_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $usuario_id, $producto_id);
    $success = $stmt->execute();
    echo json_encode(['success' => $success]);
    exit;
  }
}
