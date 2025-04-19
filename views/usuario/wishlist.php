<?php
// ✅ Cargar config primero para definir BASE_URL
require_once '../../config.php';
require_once '../../templates/header.php';

// ✅ Detectar assets generados por Vite en el build
$assets_dir = __DIR__ . '/../../public/react/assets';
$assets_url = BASE_URL . '/public/react/assets';

$js_file = '';
$css_file = '';

foreach (scandir($assets_dir) as $file) {
  if (str_ends_with($file, '.js')) $js_file = $file;
  if (str_ends_with($file, '.css')) $css_file = $file;
}
?>

<!-- ✅ Contenedor de React para la lista de deseos -->
<div id="wishlist-root" class="py-4"></div>

<!-- ✅ Carga de estilos del bundle generado -->
<?php if ($css_file): ?>
  <link rel="stylesheet" href="<?= $assets_url . '/' . $css_file ?>">
<?php endif; ?>

<!-- ✅ Carga de JS del bundle generado -->
<?php if ($js_file): ?>
  <script type="module" src="<?= $assets_url . '/' . $js_file ?>"></script>
<?php endif; ?>

<?php require_once '../../templates/footer.php'; ?>
