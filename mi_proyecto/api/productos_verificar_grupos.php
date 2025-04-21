<?php
// Conexión
$host = "localhost";
$usuario = "root";
$clave = "";
$base_datos = "tienda_virtual";
$puerto = 3306;

$conn = new mysqli($host, $usuario, $clave, $base_datos, $puerto);
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// Listas válidas
$gruposValidos = [
  'Plantas',
  'Suculentas',
  'Plantas Medicinales',
  'Fertilizantes',
  'Abonos',
  'Materas',
  'Herramientas de Jardinería'
];

$subgruposValidos = [
  'Ornamentales de Interior', 'Ornamentales de Exterior', 'Trepadoras', 'Arbustos Ornamentales', 'Maceta', 'Colgantes',
  'Suculentas de Sol', 'Suculentas de Sombra', 'Mini Suculentas', 'Cactus', 'Arreglos con Suculentas',
  'Aromáticas', 'Terapéuticas', 'Comestibles',
  'Orgánicos', 'Químicos', 'Líquidos', 'Granulados', 'Para flores', 'Para césped',
  'Humus de lombriz', 'Compost', 'Estiércol', 'Abonos foliares', 'Mezclas para macetas',
  'Plásticas', 'Barro', 'Decorativas', 'Autorriego',
  'Palas y rastrillos', 'Guantes', 'Tijeras de poda', 'Regaderas', 'Kits de jardinería'
];

// Consulta preparada
$placeholdersGrupo = implode(',', array_fill(0, count($gruposValidos), '?'));
$placeholdersSubgrupo = implode(',', array_fill(0, count($subgruposValidos), '?'));

$sql = "SELECT id, nombre, grupo, subGrupo FROM producto 
        WHERE grupo NOT IN ($placeholdersGrupo) 
        OR subGrupo NOT IN ($placeholdersSubgrupo)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("❌ Error en la consulta SQL: " . $conn->error);
}

// Bind dinámico
$tipos = str_repeat('s', count($gruposValidos) + count($subgruposValidos));
$stmt->bind_param($tipos, ...$gruposValidos, ...$subgruposValidos);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Verificación de Grupos y Subgrupos</title>
</head>
<body>
  <h2>🧹 Productos con grupo o subgrupo inválido</h2>
  <?php if ($resultado->num_rows > 0): ?>
    <ul>
    <?php while ($p = $resultado->fetch_assoc()): ?>
      <li>
        ID: <?= $p['id'] ?> |
        Nombre: <?= htmlspecialchars($p['nombre']) ?> |
        Grupo: <b><?= htmlspecialchars($p['grupo']) ?></b> |
        SubGrupo: <b><?= htmlspecialchars($p['subGrupo']) ?></b>
      </li>
    <?php endwhile ?>
    </ul>
  <?php else: ?>
    <p>✅ Todos los productos tienen grupos y subgrupos válidos.</p>
  <?php endif; ?>
</body>
</html>
