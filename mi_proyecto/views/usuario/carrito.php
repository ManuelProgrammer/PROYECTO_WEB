<?php
require_once '../../config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito de Compras</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <?php
  $assets_path = __DIR__ . '/../../public/react/assets';
  $assets_url = BASE_URL . '/public/react/assets';

  $js_file = '';
  $css_file = '';

  foreach (scandir($assets_path) as $file) {
    if (str_ends_with($file, '.js')) $js_file = $file;
    if (str_ends_with($file, '.css')) $css_file = $file;
  }

  if ($css_file) {
    echo '<link rel="stylesheet" href="' . $assets_url . '/' . $css_file . '">';
  }
  ?>
  
  <style>
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
    }
  </style>
</head>
<body>

  <?php require_once '../../templates/header.php'; ?>

  <main class="container py-4">
    <div id="carrito-root"></div>
  </main>

  <?php require_once '../../templates/footer.php'; ?>

  <?php if ($js_file): ?>
    <script type="module" src="<?= $assets_url . '/' . $js_file ?>"></script>
  <?php endif; ?>

</body>
</html>
