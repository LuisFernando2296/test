<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Tareas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
  <div class="container container-box">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Lista de Tareas</h1>
    <button class="btn btn-light btn-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTarea" title="Agregar tarea">
      <i class="fas fa-plus"></i>
    </button>
  </div>



    <table class="table table-bordered">
      <thead class="table-primary">
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
            <i class="fas fa-pen-to-square text-primary me-2" role="button"></i>
            <i class="fas fa-trash text-danger" role="button"></i>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalTarea" tabindex="-1" aria-labelledby="modalTareaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-4 shadow">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTareaLabel">Crear tarea</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <form id="formTarea">
          <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa un nombre" required>
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción</label>
              <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingresa una descripción" required>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger">Borrar</button>
            <div>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    $('#formTarea').on('submit', function (e) {
      e.preventDefault();
      const datos = {
        nombre: $('#nombre').val(),
        descripcion: $('#descripcion').val()
      };
      console.log('Tarea enviada:', datos);
      const modal = bootstrap.Modal.getInstance(document.getElementById('modalTarea'));
      modal.hide();
    });
  </script>
</body>
</html>
