<?php
require_once '../templates/header.php';
require_once '../templates/banner.php';

// Detectamos los archivos del build de React
$assets_path = __DIR__ . '/../public/react/assets';
$assets_url = '/mi_proyecto/public/react/assets'; // Ruta pública

$js_file = '';
foreach (scandir($assets_path) as $file) {
    if (str_ends_with($file, '.js')) {
        $js_file = $file;
        break;
    }
}

?>

  <!-- React se monta aquí -->
  <div id="root"></div>

<!-- Cargar JS de React compilado -->
<?php if ($js_file): ?>
  <script type="module" src="<?= $assets_url . '/' . $js_file ?>"></script>
<?php endif; ?>


<?php require_once '../templates/footer.php'; ?>
