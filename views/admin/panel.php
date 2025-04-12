<?php
session_start();
require_once '../../config.php';
require_once '../../templates/header.php';
require_once '../../templates/banner.php';

// ✅ Solo admin puede acceder
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
  header("Location: " . BASE_URL . "/index.php");
  exit;
}

// Detectamos archivos del build
$assets_path = __DIR__ . '/../../public/react/assets';
$assets_url = BASE_URL . '/public/react/assets';

$js_file = '';
$css_file = '';
foreach (scandir($assets_path) as $file) {
  if (str_ends_with($file, '.js')) $js_file = $file;
  if (str_ends_with($file, '.css')) $css_file = $file;
}
?>

<div class="container py-5">
  <h2 class="text-center highlight mb-4">Panel de Administración</h2>
  <div id="admin-panel-root"></div> <!-- React se monta aquí -->
</div>

<?php if ($css_file): ?>
  <link rel="stylesheet" href="<?= $assets_url . '/' . $css_file ?>">
<?php endif; ?>

<?php if ($js_file): ?>
  <script type="module" src="<?= $assets_url . '/' . $js_file ?>"></script>
<?php endif; ?>

<?php require_once '../../templates/footer.php'; ?>
