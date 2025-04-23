<?php
require_once 'conex.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
  $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';

  if ($id > 0 && $nombre !== '') {
    try {
      $sql = "UPDATE task SET task_name = :task_name WHERE id = :id AND active_flag = 1";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        ':task_name' => $nombre,
        ':id' => $id
      ]);

      echo json_encode(['status' => 'success', 'message' => 'Tarea actualizada correctamente.']);
    } catch (PDOException $e) {
      echo json_encode(['status' => 'error', 'message' => 'Error al actualizar: ' . $e->getMessage()]);
    }
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos o inválidos.']);
  }
} else {
  echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}
?>
