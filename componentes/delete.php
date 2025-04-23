<?php
require_once 'conex.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

  if ($id > 0) {
    try {
      $sql = "UPDATE task SET active_flag = 0 WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([':id' => $id]);

      echo json_encode(['status' => 'success', 'message' => 'Tarea eliminada correctamente.']);
    } catch (PDOException $e) {
      echo json_encode(['status' => 'error', 'message' => 'Error al eliminar: ' . $e->getMessage()]);
    }
  } else {
    echo json_encode(['status' => 'error', 'message' => 'ID inválido.']);
  }
} else {
  echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}
?>
