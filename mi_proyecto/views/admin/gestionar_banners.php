<?php
require_once(__DIR__ . '/../../config.php');

session_start();
$isLoggedIn = isset($_SESSION['usuario']);
$isAdmin = $isLoggedIn && $_SESSION['usuario']['rol'] === 'admin';

if (!$isAdmin) {
  header('Location: ' . BASE_URL . '/index.php');
  exit;
}

$bannerDir = __DIR__ . '/../../multimedia/banners/';

// ✅ Asegurar que el directorio exista
if (!is_dir($bannerDir)) {
  mkdir($bannerDir, 0777, true); // Crear con permisos
}

$imagenes = glob($bannerDir . '*.{jpg,jpeg,png,webp}', GLOB_BRACE);

// Subida de imagen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['nueva_imagen'])) {
  $file = $_FILES['nueva_imagen'];

  if ($file['error'] === UPLOAD_ERR_OK) {
    $nombre = basename($file['name']);
    $destino = $bannerDir . $nombre;
    $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

    $ext = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));
    if (in_array($ext, $extensionesPermitidas)) {
      if (move_uploaded_file($file['tmp_name'], $destino)) {
        header("Location: gestionar_banners.php");
        exit;
      } else {
        $error = "❌ No se pudo mover el archivo al destino final.";
      }
    } else {
      $error = "❌ Formato no permitido. Usa: jpg, jpeg, png, webp.";
    }
  } else {
    $error = "❌ Error al subir el archivo. Código: " . $file['error'];
  }
}

// Eliminación
if (isset($_GET['eliminar'])) {
  $fileToDelete = basename($_GET['eliminar']);
  $fullPath = $bannerDir . $fileToDelete;

  if (file_exists($fullPath)) {
    unlink($fullPath);
  }
  header("Location: gestionar_banners.php");
  exit;
}
?>
