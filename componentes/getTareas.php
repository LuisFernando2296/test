<?php
require_once 'conex.php';

try {
  $stmt = $pdo->prepare("SELECT id, task_name FROM task WHERE active_flag = 1 ORDER BY created_at DESC");
  $stmt->execute();
  $tareas = $stmt->fetchAll();
  echo json_encode($tareas);
} catch (PDOException $e) {
  echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
