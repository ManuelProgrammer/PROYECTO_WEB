<?php
// ✅ Cargar configuración y encabezado
require_once '../../config.php';
require_once '../../templates/header.php';

// 📁 Rutas de los archivos compilados por Vite
$assets_dir = __DIR__ . '/../../public/react/assets';
$assets_url = BASE_URL . '/public/react/assets';

$js_file = '';
$css_file = '';

// ✅ Detectar JS y CSS del build (compatibilidad con versiones PHP < 8)
foreach (scandir($assets_dir) as $file) {
  if (preg_match('/\.js$/', $file)) $js_file = $file;
  if (preg_match('/\.css$/', $file)) $css_file = $file;
}
?>

<!-- 🔥 Contenedor donde se renderiza React -->
<div id="wishlist-root" class="py-4"></div>

<!-- 🎨 Cargar CSS del bundle si existe -->
<?php if (!empty($css_file)): ?>
  <link rel="stylesheet" href="<?= $assets_url . '/' . $css_file ?>">
<?php endif; ?>

<!-- 🚀 Cargar el bundle de JS generado por Vite -->
<?php if (!empty($js_file)): ?>
  <script type="module" src="<?= $assets_url . '/' . $js_file ?>"></script>
<?php endif; ?>

<?php require_once '../../templates/footer.php'; ?>

