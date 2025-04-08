<?php include 'templates/header.php'; ?>

<!-- Carrusel de bienvenida -->
<?php include 'templates/banner.php'; ?>

<!-- Contenido principal de la página -->

<!-- Featured Products -->
 
<section class="py-5">
    <div class="container">
      <h2 class="highlight">- Productos Destacados -</h2>
      <br>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <img src="Multimedia/Orquidea.jpg" class="card-img-top" alt="Producto 1">
            <div class="card-body">
              <h5 class="card-title">Orquídea Vanda #1</h5>
              <a href="#" class="boton" target="_blank">Mostrar Mas</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="Multimedia/suculenta-rosa.jpg" class="card-img-top" alt="Producto 2">
            <div class="card-body">
              <h5 class="card-title">Suculenta Echeveria Elegans #2</h5>
              <a href="#" class="boton" target="_blank">Mostrar Mas</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <img src="Multimedia/suculenta.jpg" class="card-img-top" alt="Producto 3">
            <div class="card-body">
              <h5 class="card-title">Suculenta Echeveria #3</h5>
              <a href="#" class="boton" target="_blank">Mostrar Mas</a>
            </div>
          </div>
        </div>
      </div>
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
            <img src="Multimedia/evento1.webp" class="d-block w-100" alt="Evento 1">
          </div>
          <div class="carousel-item">
            <img src="Multimedia/evento2.webp" class="d-block w-100" alt="Evento 2">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselEvents" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselEvents" data-bs-slide="next">
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
        <div class="col-md-4 col-sm-6">
          <div class="card">
            <img src="Multimedia/MATERAS.webp" class="card-img-top" alt="Servicio 1">
            <div class="card-body">
              <h5 class="card-title"><strong>Materos</strong></h5>
              <p class="card-text">Encuentra los materos más hermosos y decorativos para realzar la belleza de tus plantas. Contamos con una gran variedad de diseños pintados a mano, ideales para cualquier espacio de tu hogar u oficina. Dale un toque único y artesanal a tu entorno con nuestras exclusivas macetas.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="card">
            <img src="Multimedia/PLANTAS2.webp" class="card-img-top" alt="Servicio 2">
            <div class="card-body">
              <h5 class="card-title"><strong>Plantas</strong></h5>
              <p class="card-text">Embellece tu hogar con nuestra selección de plantas naturales. Disponemos de una amplia variedad de suculentas, cactus y plantas ornamentales que darán vida a cualquier rincón. Visitanos en Valledupar y encuentra la planta perfecta para ti. 🌿</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="card">
            <img src="Multimedia/gardener.webp" class="card-img-top" alt="Servicio 3">
            <div class="card-body">
              <h5 class="card-title"><strong>Jardineria</strong></h5>
              <p class="card-text">Ofrecemos un completo servicio de jardinería para que tu espacio verde luzca siempre impecable. <br>
                <br>
                <strong>Nos encargamos de:</strong> <br>
                ✅ Corte y mantenimiento de césped. <br>
                ✅ Desmalezado y fertilización del jardín. <br>
                ✅Cuidado de árboles, poda de setos y atención a las flores. <br>
                <br>
                Déjanos transformar tu jardín en un verdadero paraíso natural. <br>
                <strong>¡Contáctanos hoy!</strong></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php include 'templates/footer.php'; ?>