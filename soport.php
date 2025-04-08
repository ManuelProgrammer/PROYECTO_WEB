<?php require_once(__DIR__ . '/config.php'); ?>
<?php include(__DIR__ . '/templates/header.php'); ?>
<?php include(__DIR__ . "/templates/banner.php"); ?>

<!-- Carrusel-banner -->
<section>
  <div class="text-center">
    <div class="mb-5" id="banner_infort">
      <h1 class="text-success1 display-4"><br><strong>Soporte El Paraíso</strong></h1>
      <p class="text-center">Para obtener rápidamente apoyo de nuestros asesores para que puedan ayudarte a resolver tu problema</p>
    </div>
  </div>
</section>

<main class="container mt-4">
  <div class="row">
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Preguntas Frecuentes Sobre La Usabilidad De La Página Web</h5>
          <a href="https://drive.google.com/file/d/1n3Di2senDIakdPZpjZ3BOUq763gDqyh2/view?usp=sharing" class="boton" target="_blank">Descargar</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Política De Tratamiento Y Protección Datos Personales</h5>
          <a href="https://drive.google.com/file/d/1KxnlIL6x7AvqjeHQN7krhFO7X90s7AJK/view?usp=sharing" class="boton" target="_blank">Descargar</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Políticas Y Normas De La Comunidad Del Vivero El Paraíso</h5>
          <a href="https://drive.google.com/file/d/1yleGTdS05halZ2u21zGEcKfJ9zEiSP7J/view?usp=sharing" class="boton" target="_blank">Descargar</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Tickets -->
  <section class="body_tikets mt-5">
    <div class="container_00">
      <h2>Registro de Tickets</h2>
      <form action="https://formsubmit.co/manuelfabianf@gmail.com" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="mensaje">Descripción del Problema:</label>
        <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

        <input type="hidden" name="_captcha" value="false">
        <input type="submit" value="Enviar Ticket">
      </form>
    </div>
  </section>

  <div class="text-center mt-5">
    <h2 class="text-success1">¿Necesitas más ayuda? Contáctenos.</h2>
    <p class="text-center">Comunícate con nosotros si tienes una pregunta difícil de responder, estaremos dispuestos para ayudarte en cualquier momento</p>
    <a href="<?= BASE_URL ?>/contac.php" class="btn btn-success1 btn-lg">Registra Tu Tickets</a>
  </div>
  <br><br>
</main>

<?php include(__DIR__ . '/templates/footer.php'); ?>
