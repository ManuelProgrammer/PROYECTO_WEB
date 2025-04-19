<?php
session_start();
require_once '../includes/conexion.php';
require_once '../config.php';

if (!isset($_SESSION['usuario'])) {
  header("Location: " . BASE_URL . "/views/auth.php?mode=login");
  exit;
}

$id = $_SESSION['usuario']['id'];
$actual = $_POST['actual'] ?? '';
$nueva = $_POST['nueva'] ?? '';
$confirmar = $_POST['confirmar'] ?? '';

if ($nueva !== $confirmar) {
  header("Location: " . BASE_URL . "/views/usuario/perfil.php?error=confirma");
  exit;
}

// Obtener la contraseña actual
$stmt = $conn->prepare("SELECT clave FROM usuario WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();

if (!$user || !password_verify($actual, $user['clave'])) {
  header("Location: " . BASE_URL . "/views/usuario/perfil.php?error=actual");
  exit;
}

// Actualizar la nueva contraseña
$nuevaHash = password_hash($nueva, PASSWORD_DEFAULT);
$stmt = $conn->prepare("UPDATE usuario SET clave=? WHERE id=?");
$stmt->bind_param("si", $nuevaHash, $id);
$stmt->execute();

header("Location: " . BASE_URL . "/views/usuario/perfil.php?success=clave");
exit;
