<?php
require_once 'config.php';
require_once 'templates/header.php'; // Asegúrate de que header.php tenga session_start()
?>

<!-- Carrusel de bienvenida -->
<?php include 'templates/banner.php'; ?>

<!-- Contenido principal de la página -->

<!-- Productos Destacados React -->
<section class="py-5">
  <div class="container">
    <div id="destacados-root"></div>
  </div>
</section>

<!-- Events -->
<section class="py-5">
  <div class="container">
    <h2 class="highlight">- Eventos -</h2>
    <br>
    <div id="carouselEvents" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?= BASE_URL ?>/multimedia/evento1.webp" class="d-block w-100" alt="Evento 1">
        </div>
        <div class="carousel-item animate-hover">
          <img src="<?= BASE_URL ?>/multimedia/evento2.webp" class="d-block w-100" alt="Evento 2">
        </div>
      </div>
      <button class="carousel-control-prev animate-hover" type="button" data-bs-target="#carouselEvents" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next animate-hover" type="button" data-bs-target="#carouselEvents" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    </div>
  </div>
</section>

<!-- Services -->
<section class="py-5">
  <div class="container">
    <h2 class="highlight">- Nuestros Servicios -</h2>
    <br>
    <div class="row">
      <div class="col-md-4 col-sm-6 animate-hover">
        <div class="card">
          <img src="<?= BASE_URL ?>/multimedia/MATERAS.webp" class="card-img-top" alt="Servicio 1">
          <div class="card-body">
            <h5 class="card-title"><strong>Materos</strong></h5>
            <p class="card-text">Encuentra los materos más hermosos y decorativos para realzar la belleza de tus plantas. Contamos con una gran variedad de diseños pintados a mano, ideales para cualquier espacio de tu hogar u oficina.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 animate-hover">
        <div class="card">
          <img src="<?= BASE_URL ?>/multimedia/PLANTAS2.webp" class="card-img-top" alt="Servicio 2">
          <div class="card-body">
            <h5 class="card-title"><strong>Plantas</strong></h5>
            <p class="card-text">Embellece tu hogar con nuestra selección de plantas naturales. Disponemos de suculentas, cactus y plantas ornamentales que darán vida a cualquier rincón.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 animate-hover">
        <div class="card">
          <img src="<?= BASE_URL ?>/multimedia/gardener.webp" class="card-img-top" alt="Servicio 3">
          <div class="card-body">
            <h5 class="card-title"><strong>Jardinería</strong></h5>
            <p class="card-text">Ofrecemos corte y mantenimiento de césped, desmalezado, poda y atención a flores y árboles. Déjanos transformar tu jardín en un verdadero paraíso natural.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'templates/footer.php'; ?>

<?php
// Scripts React para destacar productos
$reactAssetsPath = __DIR__ . '/public/react/assets';
$reactAssetsUrl = BASE_URL . '/public/react/assets';
$jsFile = '';
$cssFile = '';

foreach (scandir($reactAssetsPath) as $file) {
  if (str_ends_with($file, '.js')) $jsFile = $file;
  if (str_ends_with($file, '.css')) $cssFile = $file;
}

if ($cssFile) {
  echo '<link rel="stylesheet" href="' . $reactAssetsUrl . '/' . $cssFile . '">';
}
if ($jsFile) {
  echo '<script type="module" src="' . $reactAssetsUrl . '/' . $jsFile . '"></script>';
}
?>

