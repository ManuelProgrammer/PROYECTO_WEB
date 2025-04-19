<?php
require_once '../../config.php';
require_once '../../templates/header.php';
?>

<!-- Contenedor para React -->
<div id="wishlist-root"></div>

<!-- Detectar assets del build de React -->
<?php
$assets_dir = __DIR__ . '/../../public/react/assets';
$assets_url = BASE_URL . '/public/react/assets';

$js_file = '';
$css_file = '';

foreach (scandir($assets_dir) as $file) {
  if (str_ends_with($file, '.js')) $js_file = $file;
  if (str_ends_with($file, '.css')) $css_file = $file;
}
?>

<?php if ($css_file): ?>
  <link rel="stylesheet" href="<?= $assets_url . '/' . $css_file ?>">
<?php endif; ?>

<?php if ($js_file): ?>
  <script type="module" src="<?= $assets_url . '/' . $js_file ?>"></script>
<?php endif; ?>

<?php require_once '../../templates/footer.php'; ?>
