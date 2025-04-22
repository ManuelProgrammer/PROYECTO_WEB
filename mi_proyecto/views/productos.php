<?php
require_once '../templates/header.php';
require_once '../templates/banner.php';

// Detectamos los archivos del build de React
$assets_path = __DIR__ . '/../public/react/assets';
$assets_url = '/public/react/assets'; // Ruta pública

$js_file = '';
$css_file = '';

foreach (scandir($assets_path) as $file) {
    if (str_ends_with($file, '.js')) {
        $js_file = $file;
    }
    if (str_ends_with($file, '.css')) {
        $css_file = $file;
    }
}
?>

<!-- React se monta aquí -->
<div id="root" class="py-4"></div>

<!-- Cargar CSS del build de Vite -->
<?php if ($css_file): ?>
  <link rel="stylesheet" href="<?= $assets_url . '/' . $css_file ?>">
<?php endif; ?>

<!-- Cargar JS del build de Vite -->
<?php if ($js_file): ?>
  <script type="module" src="<?= $assets_url . '/' . $js_file ?>"></script>
<?php endif; ?>

<?php require_once '../templates/footer.php'; ?>

