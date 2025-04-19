<?php
session_start();
require_once '../includes/conexion.php';
require_once '../config.php';

if (!isset($_SESSION['usuario'])) {
  header("Location: " . BASE_URL . "/views/auth.php?mode=login");
  exit;
}

$id = $_SESSION['usuario']['id'];
$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$telefono = $_POST['telefono'] ?? '';

if ($nombre && $correo) {
  $stmt = $conn->prepare("UPDATE usuario SET nombre=?, correo=?, numeroTelefono=? WHERE id=?");
  $stmt->bind_param("sssi", $nombre, $correo, $telefono, $id);
  $stmt->execute();

  // Actualizar datos en sesión también
  $_SESSION['usuario']['nombre'] = $nombre;

  header("Location: " . BASE_URL . "/views/usuario/perfil.php?success=1");
  exit;
} else {
  header("Location: " . BASE_URL . "/views/usuario/perfil.php?error=1");
  exit;
}
