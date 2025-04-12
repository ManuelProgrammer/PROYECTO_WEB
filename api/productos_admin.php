<?php
session_start();
header('Content-Type: application/json');

require_once '../includes/conexion.php';

// Verificación de sesión y rol
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
  http_response_code(403);
  echo json_encode(['error' => 'Acceso denegado']);
  exit;
}

// Obtener productos (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $query = "SELECT id, nombre, grupo, precio, stock, imagen FROM producto ORDER BY id DESC";
  $result = $conn->query($query);

  $productos = [];
  while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
  }

  echo json_encode($productos);
  exit;
}

// Eliminar producto (DELETE)
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  parse_str(file_get_contents("php://input"), $_DELETE);
  $id = $_DELETE['id'] ?? null;

  if ($id) {
    $stmt = $conn->prepare("DELETE FROM producto WHERE id = ?");
    $stmt->bind_param("i", $id);
    $ok = $stmt->execute();
    echo json_encode(['success' => $ok]);
  } else {
    echo json_encode(['success' => false, 'error' => 'ID no proporcionado']);
  }
  exit;
}

// Actualizar producto (PUT)
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  $data = json_decode(file_get_contents("php://input"), true);

  if (isset($data['id'], $data['nombre'], $data['grupo'], $data['precio'], $data['stock'])) {
    $stmt = $conn->prepare("UPDATE producto SET nombre = ?, grupo = ?, precio = ?, stock = ? WHERE id = ?");
    $stmt->bind_param("ssdii", $data['nombre'], $data['grupo'], $data['precio'], $data['stock'], $data['id']);
    $ok = $stmt->execute();
    echo json_encode(['success' => $ok]);
  } else {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
  }
  exit;
}

// Crear producto (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"), true);

  if (isset($data['nombre'], $data['grupo'], $data['precio'], $data['stock'])) {
    $stmt = $conn->prepare("INSERT INTO producto (nombre, grupo, precio, stock, fechaAlta) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssdi", $data['nombre'], $data['grupo'], $data['precio'], $data['stock']);
    $ok = $stmt->execute();
    echo json_encode(['success' => $ok]);
  } else {
    echo json_encode(['success' => false, 'error' => 'Faltan datos']);
  }
  exit;
}
