<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . '/../config.php');

$isLoggedIn = isset($_SESSION['usuario']);
$isAdmin = $isLoggedIn && $_SESSION['usuario']['rol'] === 'admin';

$bannerDir = __DIR__ . '/../multimedia/banners/';
$bannerUrlBase = BASE_URL . '/multimedia/banners/';
$bannerActivoPath = $bannerDir . 'banner_activo.txt';

// Obtener imágenes del directorio
$imagenes = glob($bannerDir . '*.{jpg,jpeg,png,webp}', GLOB_BRACE);

// Si hay un banner activo específico, mostrar solo ese
if (file_exists($bannerActivoPath)) {
    $activo = trim(file_get_contents($bannerActivoPath));
    $ruta = $bannerDir . $activo;
    if (file_exists($ruta)) {
        $imagenes = [$ruta];
    }
}

// Fallback si no hay imágenes
if (empty($imagenes)) {
    $imagenes[] = __DIR__ . '/../multimedia/no-image.png';
}
?>

<!-- Banner limpio y sin márgenes -->
<div class="container-fluid p-0 m-0"> <!-- Usa container-fluid para que sea ancho completo -->
  <div id="carouselBanner" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php foreach ($imagenes as $index => $rutaImagen): ?>
        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
          <img src="<?= str_replace(__DIR__ . '/../', BASE_URL . '/', $rutaImagen) ?>" 
               class="d-block w-100" 
               alt="Banner <?= $index + 1 ?>">
        </div>
      <?php endforeach; ?>
    </div>

    <?php if (count($imagenes) > 1): ?>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    <?php endif; ?>
  </div>

  <?php if ($isAdmin): ?>
    <div class="text-end mt-2 me-3">
      <a href="<?= BASE_URL ?>/views/admin/gestionar_banners.php" class="btn btn-sm btn-primary">
        Administrar Carrusel
      </a>
    </div>
  <?php endif; ?>
</div>
