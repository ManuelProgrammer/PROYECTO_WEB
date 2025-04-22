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
$activoPath = $bannerDir . 'banner_activo.txt';

if (!is_dir($bannerDir)) {
  mkdir($bannerDir, 0777, true);
}

$imagenes = glob($bannerDir . '*.{jpg,jpeg,png,webp}', GLOB_BRACE);

// Obtener banner activo si existe
$bannerActivo = file_exists($activoPath) ? trim(file_get_contents($activoPath)) : '';

// Subida desde navegador
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['nueva_imagen'])) {
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
        $error = "❌ Formato no permitido.";
      }
    } else {
      $error = "❌ Error al subir el archivo.";
    }
  }

  // Marcar como banner activo
  if (isset($_POST['set_activo'])) {
    $nuevoActivo = basename($_POST['set_activo']);
    file_put_contents($activoPath, $nuevoActivo);
    $bannerActivo = $nuevoActivo;
    header("Location: gestionar_banners.php");
    exit;
  }
}

// Eliminación
if (isset($_GET['eliminar'])) {
  $fileToDelete = basename($_GET['eliminar']);
  $fullPath = $bannerDir . $fileToDelete;

  if (file_exists($fullPath)) {
    unlink($fullPath);
    if ($bannerActivo === $fileToDelete) {
      unlink($activoPath); // Eliminar referencia si era el activo
    }
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
  <h2>Gestión de Banners</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <!-- Subida -->
  <form action="" method="POST" enctype="multipart/form-data" class="mb-4">
    <div class="mb-3">
      <label for="nueva_imagen" class="form-label">Subir nueva imagen</label>
      <input type="file" class="form-control" name="nueva_imagen" id="nueva_imagen" required>
    </div>
    <button type="submit" class="btn btn-success">Subir</button>
  </form>

  <h4>Imágenes en la carpeta:</h4>
  <div class="row">
    <?php foreach ($imagenes as $img): 
      $nombreArchivo = basename($img);
      $url = str_replace(__DIR__ . '/../../', BASE_URL . '/', $img);
      $esActivo = ($nombreArchivo === $bannerActivo);
    ?>
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="<?= $url ?>" class="card-img-top" alt="banner">
          <div class="card-body text-center">
            <?php if ($esActivo): ?>
              <p class="text-success fw-bold">Activo</p>
            <?php else: ?>
              <form method="POST" class="d-inline">
                <input type="hidden" name="set_activo" value="<?= htmlspecialchars($nombreArchivo) ?>">
                <button type="submit" class="btn btn-sm btn-outline-primary">Usar como banner principal</button>
              </form>
            <?php endif; ?>
            <a href="?eliminar=<?= urlencode($nombreArchivo) ?>" class="btn btn-sm btn-danger ms-2" onclick="return confirm('¿Eliminar esta imagen?')">Eliminar</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
</body>
</html>
