<?php
session_start();
header('Content-Type: application/json');
require_once '../includes/conexion.php';

// 🔐 Verificar permisos de admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
  http_response_code(403);
  echo json_encode(['error' => 'Acceso denegado']);
  exit;
}

// 📁 Ruta de almacenamiento de imágenes
$upload_dir = realpath(__DIR__ . '/../multimedia');
if (!file_exists($upload_dir)) {
  mkdir($upload_dir, 0775, true);
}

// 🛠️ Crear o editar producto (POST / PUT)
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT') {
  $id           = $_POST['id'] ?? null;
  $nombre       = $_POST['nombre'] ?? '';
  $grupo        = $_POST['grupo'] ?? '';
  $subGrupo     = $_POST['subGrupo'] ?? '';
  $descripcion  = $_POST['descripcion'] ?? '';
  $precio       = floatval($_POST['precio'] ?? 0);
  $stock        = intval($_POST['stock'] ?? 0);
  $nombreImagen = null;

  // Manejo de imagen
  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $nombreOriginal = basename($_FILES['imagen']['name']);
    $ext = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
    $nombreImagen = uniqid('img_', true) . '.' . strtolower($ext);
    $rutaDestino = $upload_dir . '/' . $nombreImagen;

    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
      echo json_encode(['success' => false, 'error' => 'Error al guardar la imagen.']);
      exit;
    }
  }

  if ($id) {
    // UPDATE
    if ($nombreImagen) {
      $sql = "UPDATE producto SET nombre=?, grupo=?, subGrupo=?, descripcion=?, precio=?, stock=?, imagen=? WHERE id=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssssdisi", $nombre, $grupo, $subGrupo, $descripcion, $precio, $stock, $nombreImagen, $id);
    } else {
      $sql = "UPDATE producto SET nombre=?, grupo=?, subGrupo=?, descripcion=?, precio=?, stock=? WHERE id=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssssdis", $nombre, $grupo, $subGrupo, $descripcion, $precio, $stock, $id);
    }
  } else {
    // INSERT
    $sql = "INSERT INTO producto (nombre, grupo, subGrupo, descripcion, precio, stock, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdis", $nombre, $grupo, $subGrupo, $descripcion, $precio, $stock, $nombreImagen);
  }

  $success = $stmt->execute();
  echo json_encode(['success' => $success]);
  exit;
}

// 🗑 Eliminar producto (DELETE)
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  $input = json_decode(file_get_contents("php://input"), true);
  $id = $input['id'] ?? null;

  if (!$id) {
    echo json_encode(['success' => false, 'error' => 'ID no proporcionado']);
    exit;
  }

  // Eliminar imagen asociada
  $imgResult = $conn->query("SELECT imagen FROM producto WHERE id = " . intval($id));
  if ($imgResult && $imgRow = $imgResult->fetch_assoc()) {
    $imgPath = $upload_dir . '/' . $imgRow['imagen'];
    if (file_exists($imgPath)) {
      unlink($imgPath);
    }
  }

  $stmt = $conn->prepare("DELETE FROM producto WHERE id = ?");
  $stmt->bind_param("i", $id);
  $success = $stmt->execute();

  echo json_encode(['success' => $success]);
  exit;
}

// 📋 Obtener lista de productos (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $resultado = $conn->query("SELECT * FROM producto");
  $productos = [];

  while ($fila = $resultado->fetch_assoc()) {
    $productos[] = $fila;
  }

  echo json_encode($productos);
  exit;
}
