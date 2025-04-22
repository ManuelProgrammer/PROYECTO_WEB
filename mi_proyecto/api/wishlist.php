<?php
session_start();
header('Content-Type: application/json');
require_once '../includes/conexion.php';

// ✅ Ver si hay usuario logueado
$usuario_id = $_SESSION['usuario']['id'] ?? null;

// ✅ Rutas protegidas
$requiereLogin = in_array($_SERVER['REQUEST_METHOD'], ['POST', 'DELETE']) || isset($_GET['soloFavoritos']);

if ($requiereLogin && !$usuario_id) {
  http_response_code(401);
  echo json_encode(['error' => 'No autenticado']);
  exit;
}

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    if (isset($_GET['productos']) && $_GET['productos'] == 1 && $usuario_id) {
      // ✅ Productos favoritos con detalles
      $sql = "SELECT p.* 
              FROM wishlist w 
              JOIN producto p ON w.producto_id = p.id 
              WHERE w.usuario_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $usuario_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $productos = [];

      while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
      }

      echo json_encode($productos);
      exit;
    }

    if (isset($_GET['soloFavoritos']) && $usuario_id) {
      // ✅ Solo IDs de wishlist
      $sql = "SELECT producto_id FROM wishlist WHERE usuario_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $usuario_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $favoritos = [];

      while ($row = $result->fetch_assoc()) {
        $favoritos[] = $row['producto_id'];
      }

      echo json_encode($favoritos);
      exit;
    }

    // ✅ Listar todos los productos disponibles (sin login)
    $result = $conn->query("SELECT * FROM producto ORDER BY destacado DESC");
    $todos = [];
    while ($row = $result->fetch_assoc()) {
      $todos[] = $row;
    }

    echo json_encode($todos);
    break;

  case 'POST':
    $data = json_decode(file_get_contents('php://input'), true);
    $producto_id = $data['producto_id'] ?? null;

    if (is_numeric($producto_id)) {
      $stmt = $conn->prepare("INSERT IGNORE INTO wishlist (usuario_id, producto_id) VALUES (?, ?)");
      $stmt->bind_param("ii", $usuario_id, $producto_id);
      $stmt->execute();
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['success' => false, 'error' => 'ID inválido']);
    }
    break;

  case 'DELETE':
    $data = json_decode(file_get_contents('php://input'), true);
    $producto_id = $data['producto_id'] ?? null;

    if (is_numeric($producto_id)) {
      $stmt = $conn->prepare("DELETE FROM wishlist WHERE usuario_id = ? AND producto_id = ?");
      $stmt->bind_param("ii", $usuario_id, $producto_id);
      $stmt->execute();
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['success' => false, 'error' => 'ID inválido']);
    }
    break;

  default:
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    break;
}
