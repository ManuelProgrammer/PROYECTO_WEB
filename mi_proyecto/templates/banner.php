<?php
require_once(__DIR__ . '/../config.php');

$bannerDir = __DIR__ . '/../multimedia/banners/';
$bannerUrlBase = BASE_URL . '/multimedia/banners/';
$imagenes = glob($bannerDir . '*.{jpg,jpeg,png,webp}', GLOB_BRACE);

// Fallback si no hay imágenes
if (empty($imagenes)) {
  $imagenes[] = __DIR__ . '/../multimedia/no-image.png';
}
?>
<div class="container my-4">
  <div id="carouselBanner" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php foreach ($imagenes as $index => $rutaImagen): ?>
        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
          <img src="<?= str_replace(__DIR__ . '/../', BASE_URL . '/', $rutaImagen) ?>" class="d-block w-100" alt="Banner <?= $index + 1 ?>">
        </div>
      <?php endforeach; ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente</span>
    </button>
  </div>

  <!-- Solo visible para administradores -->
  <?php if ($isAdmin): ?>
    <div class="text-end mt-2">
      <a href="<?= BASE_URL ?>/views/admin/gestionar_banners.php" class="btn btn-sm btn-primary">
        Administrar Carrusel
      </a>
    </div>
  <?php endif; ?>
</div>
