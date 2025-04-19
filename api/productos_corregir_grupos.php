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

// Lista de errores comunes y sus correcciones
$correcciones = [
  // Grupos
  'Planta' => 'Plantas',
  'Suculenta' => 'Suculentas',
  'Medicinales' => 'Plantas Medicinales',
  'Fertilizante' => 'Fertilizantes',

  // Subgrupos
  'Ornamental de Interior' => 'Ornamentales de Interior',
  'Arreglo con Suculentas' => 'Arreglos con Suculentas',
  'Terapueticas' => 'Terapéuticas',
  'Autorriegoo' => 'Autorriego',
  'Macetas' => 'Maceta',
  'Cactus pequeños' => 'Cactus',
];

// Recorremos correcciones
foreach ($correcciones as $incorrecto => $correcto) {
  // Corregimos en "grupo"
  $stmt1 = $conn->prepare("UPDATE producto SET grupo = ? WHERE grupo = ?");
  $stmt1->bind_param('ss', $correcto, $incorrecto);
  $stmt1->execute();
  echo "✅ Corregido grupo '$incorrecto' ➜ '$correcto': {$stmt1->affected_rows} filas<br>";

  // Corregimos en "subGrupo"
  $stmt2 = $conn->prepare("UPDATE producto SET subGrupo = ? WHERE subGrupo = ?");
  $stmt2->bind_param('ss', $correcto, $incorrecto);
  $stmt2->execute();
  echo "✅ Corregido subGrupo '$incorrecto' ➜ '$correcto': {$stmt2->affected_rows} filas<br>";
}
?>
