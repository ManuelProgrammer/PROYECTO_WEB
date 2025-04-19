<?php
session_start();
header('Content-Type: application/json');

require_once '../includes/conexion.php';

// ✅ Verificación de permisos
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
  http_response_code(403);
  echo json_encode(['error' => 'Acceso denegado']);
  exit;
}

// 🔄 Actualizar usuario (PUT)
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  $data = json_decode(file_get_contents("php://input"), true);

  $id       = $data['id'] ?? null;
  $nombre   = $data['nombre'] ?? '';
  $correo   = $data['correo'] ?? '';
  $telefono = $data['numeroTelefono'] ?? null;
  $rol      = $data['rol'] ?? 'cliente';
  $activo   = $data['activo'] ?? 1;

  if ($id && $nombre && $correo && $rol !== '') {
    $stmt = $conn->prepare("UPDATE usuario SET nombre=?, correo=?, numeroTelefono=?, rol=?, activo=? WHERE id=?");
    $stmt->bind_param("ssssii", $nombre, $correo, $telefono, $rol, $activo, $id);
    $success = $stmt->execute();

    echo json_encode(['success' => $success]);
    exit;
  } else {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit;
  }
}

// 📦 Listar usuarios (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $sql = "SELECT id, nombre, correo, rol, numeroTelefono, activo FROM usuario ORDER BY id DESC";
  $result = $conn->query($sql);

  $usuarios = [];
  while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
  }

  echo json_encode($usuarios);
  exit;
}

// ❌ Eliminar usuario (DELETE)
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  // ✅ Leer ID desde la URL
  $id = $_GET['id'] ?? null;

  if ($id) {
    $stmt = $conn->prepare("DELETE FROM usuario WHERE id = ?");
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();

    echo json_encode(['success' => $success]);
    exit;
  } else {
    echo json_encode(['success' => false, 'error' => 'ID no proporcionado']);
    exit;
  }
}
