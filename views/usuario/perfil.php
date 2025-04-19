<?php
session_start();
require_once '../../config.php';
require_once '../../includes/conexion.php';

// Validar si hay sesión iniciada
if (!isset($_SESSION['usuario'])) {
  header("Location: " . BASE_URL . "/views/auth.php?mode=login");
  exit;
}

$usuarioId = $_SESSION['usuario']['id'];

// Obtener datos actualizados del usuario desde la base de datos
$stmt = $conn->prepare("SELECT nombre, correo, numeroTelefono FROM usuario WHERE id = ?");
$stmt->bind_param("i", $usuarioId);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

include '../../templates/header.php';
?>

<section class="py-5">
  <div class="container">
    <h2 class="text-center mb-4 highlight">👤 Mi Perfil</h2>

    <?php if (isset($_GET['success']) && $_GET['success'] === 'clave'): ?>
  <div class="alert alert-success text-center">✅ Contraseña actualizada correctamente.</div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
  <div class="alert alert-danger text-center">
    <?php
      if ($_GET['error'] === 'actual') echo "❌ La contraseña actual es incorrecta.";
      elseif ($_GET['error'] === 'confirma') echo "❌ Las nuevas contraseñas no coinciden.";
      else echo "❌ Error al actualizar la contraseña.";
    ?>
  </div>
<?php endif; ?>


    <form action="<?= BASE_URL ?>/includes/actualizar_perfil.php" method="POST" class="mx-auto" style="max-width: 500px;">
      <div class="mb-3">
        <label class="form-label">Nombre completo</label>
        <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Número de Teléfono</label>
        <input type="text" class="form-control" name="telefono" value="<?= htmlspecialchars($usuario['numeroTelefono']) ?>">
      </div>

      <button type="submit" class="btn btn-success w-100">Actualizar Perfil</button>
    </form>
  </div>

  <hr class="my-5">
<h4 class="text-center mb-4">🔑 Cambiar Contraseña</h4>

<form action="<?= BASE_URL ?>/includes/cambiar_contrasena.php" method="POST" class="mx-auto" style="max-width: 500px;">
  <div class="mb-3">
    <label class="form-label">Contraseña Actual</label>
    <input type="password" name="actual" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Nueva Contraseña</label>
    <input type="password" name="nueva" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Confirmar Nueva Contraseña</label>
    <input type="password" name="confirmar" class="form-control" required>
  </div>

  <button type="submit" class="btn btn-warning w-100">Actualizar Contraseña</button>
</form>

</section>

<?php include '../../templates/footer.php'; ?>
