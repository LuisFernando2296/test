<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'conex.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $taskName = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';

  if ($taskName !== '') {
    try {
      $sql = "INSERT INTO task (task_name, created_at, active_flag) VALUES (:task_name, NOW(), 1)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([':task_name' => $taskName]);
      echo json_encode(['status' => 'success', 'message' => 'Tarea agregada']);
    } catch (PDOException $e) {
      echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Nombre requerido.']);
  }
} else {
  echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}
