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
      move_uploaded_file($file['tmp_name'], $destino);
      header("Location: gestionar_banners.php");
      exit;
    } else {
      $error = "Formato no permitido. Usa: jpg, jpeg, png, webp.";
    }
  } else {
    $error = "Error al subir el archivo.";
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

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Administrar Banners</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4">Gestión de Banners</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form action="" method="POST" enctype="multipart/form-data" class="mb-4">
    <div class="mb-3">
      <label for="nueva_imagen" class="form-label">Subir nueva imagen</label>
      <input type="file" class="form-control" name="nueva_imagen" id="nueva_imagen" required>
    </div>
    <button type="submit" class="btn btn-success">Subir</button>
  </form>

  <h4>Imágenes Actuales:</h4>
  <div class="row">
    <?php foreach ($imagenes as $img): ?>
      <div class="col-md-3 col-sm-4 mb-4">
        <div class="card">
          <img src="<?= str_replace(__DIR__ . '/../../', BASE_URL . '/', $img) ?>" class="card-img-top" alt="banner">
          <div class="card-body text-center">
            <a href="?eliminar=<?= urlencode(basename($img)) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta imagen?')">Eliminar</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
</body>
</html>
