<?php
require_once '../config.php';
include '../templates/header.php';

$mode = $_GET['mode'] ?? 'login';
?>

<section class="py-5">
  <div class="container">
    <h2 class="text-center highlight mb-4">
      <?= $mode === 'login' ? 'INICIO DE SESIÓN' : 'REGISTRO DE USUARIO' ?>
    </h2>

    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success text-center">¡Registro exitoso! Ya puedes iniciar sesión.</div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger text-center">
        <?php
        switch ($_GET['error']) {
          case '1': echo "Hubo un error procesando la solicitud."; break;
          case 'email_exists': echo "El correo ya está registrado."; break;
          case 'invalid_action': echo "Acción no válida."; break;
          default: echo "Error desconocido.";
        }
        ?>
      </div>
    <?php endif; ?>

    <div class="row justify-content-center">
      <div class="col-md-6">
        <!-- ✅ FORM corregido con ruta real y nombre de carpeta en minúsculas -->
        <form action="<?= BASE_URL ?>/includes/procesar_auth.php" method="POST">
          <input type="hidden" name="action" value="<?= $mode ?>">

          <?php if ($mode === 'register'): ?>
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre y Apellidos</label>
              <input type="text" class="form-control" name="nombre" required>
            </div>
          <?php endif; ?>

          <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" name="correo" required>
          </div>

          <div class="mb-3">
            <label for="clave" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="clave" required>
          </div>

          <?php if ($mode === 'register'): ?>
            <div class="mb-3">
              <label for="numeroTelefono" class="form-label">Teléfono (opcional)</label>
              <input type="text" class="form-control" name="numeroTelefono">
            </div>
          <?php endif; ?>

          <button type="submit" class="btn btn-success w-100">
            <?= $mode === 'login' ? 'Iniciar Sesión' : 'Registrarme' ?>
          </button>
        </form>

        <div class="text-center mt-4">
          <?php if ($mode === 'login'): ?>
            <p>¿No tienes cuenta? <a href="auth.php?mode=register">Regístrate aquí</a></p>
          <?php else: ?>
            <p>¿Ya tienes cuenta? <a href="auth.php?mode=login">Inicia sesión</a></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include '../templates/footer.php'; ?>
