<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Tareas</title>
  <link rel="stylesheet" href="assets/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div class="container">
  <div class="header">
    <h1>Lista de Tareas</h1>
    <div class="tooltip-wrapper">
        <a href="add.php" class="btn-plus">
        <i class="fas fa-plus"></i>
        </a>
        <span class="tooltip-text">Agregar tarea</span>
    </div>
  </div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Tarea</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="tablaTareas">
        <tr>
          <td>1</td>
          <td>Ejemplo de tarea</td>
          <td>
            <i class="fas fa-pen-to-square accion editar"></i>
            <i class="fas fa-trash accion eliminar"></i>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    $('#filtro').on('input', function () {
      const filtro = $(this).val().toLowerCase();
      $('#tablaTareas tr').each(function () {
        const texto = $(this).text().toLowerCase();
        $(this).toggle(texto.includes(filtro));
      });
    });
  </script>
</body>
</html>
