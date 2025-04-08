<?php require_once(__DIR__ . '/../config.php'); ?>

<!-- Carrusel-banner -->
<div id="carouselBanner" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?= BASE_URL ?>/multimedia/BANNER.jpg" class="d-block w-100" alt="Banner principal">
    </div>
    <!--<div class="carousel-item">
      <img src="<?= BASE_URL ?>/multimedia/BANNER2.jpg" class="d-block w-100" alt="Banner secundario">
    </div>-->
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
