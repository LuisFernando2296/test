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
  <div class="row align-items-center mb-4">
    <div class="col-8 col-sm-9">
      <h1 class="mb-0">Lista de Tareas</h1>
    </div>
    <div class="col-4 col-sm-3 text-end">
      <button class="btn btn-light btn-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTarea" title="Agregar tarea">
        <i class="fas fa-plus"></i>
      </button>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered align-middle">
      <thead class="table-primary">
        <tr>
          <th>ID</th>
          <th>Tarea</th>
          <th>Descripción</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="tablaTareas">
        <tr>
          <td>1</td>
          <td>Ejemplo de tarea</td>
          <td>Esta es una descripción breve</td>
          <td>
            <i class="fas fa-pen-to-square text-primary me-2 editar-btn"
               data-id="1"
               data-nombre="Ejemplo de tarea"
               data-descripcion="Esta es una descripción breve"
               role="button"></i>
            <i class="fas fa-trash text-danger eliminar-btn" data-id="1" role="button"></i>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
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

  <!-- Modal Confirmar Eliminación -->
<div class="modal fade" id="modalConfirmarEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEliminarLabel">Confirmar eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas eliminar esta tarea?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" id="btnConfirmarEliminar">Sí</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Tarea -->
<div class="modal fade" id="modalEditarTarea" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarLabel">Editar Tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form id="formEditarTarea">
        <div class="modal-body">
          <input type="hidden" id="editarId" name="id">
          <div class="mb-3">
            <label for="editarNombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="editarNombre" name="nombre" required>
          </div>
          <div class="mb-3">
            <label for="editarDescripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="editarDescripcion" name="descripcion" required>
          </div>
        </div>
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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

<script>
  let tareaAEliminar = null;

  // Abrir modal de confirmación
  $(document).on('click', '.eliminar-btn', function () {
    tareaAEliminar = $(this).data('id');
    $('#modalConfirmarEliminar').modal('show');
  });

  // Confirmar eliminación
  $('#btnConfirmarEliminar').on('click', function () {
    console.log('Tarea eliminada: ID', tareaAEliminar);

    // Aquí iría AJAX o redirección para eliminar la tarea con PHP
    // $.post('delete.php', { id: tareaAEliminar }, function() { ... });

    $('#modalConfirmarEliminar').modal('hide');
  });
</script>

<script>
  // Abrir modal con datos de tarea
  $(document).on('click', '.editar-btn', function () {
    const id = $(this).data('id');
    const nombre = $(this).data('nombre');
    const descripcion = $(this).data('descripcion');

    $('#editarId').val(id);
    $('#editarNombre').val(nombre);
    $('#editarDescripcion').val(descripcion);

    $('#modalEditarTarea').modal('show');
  });

  // Guardar cambios (simulado)
  $('#formEditarTarea').on('submit', function (e) {
    e.preventDefault();
    const datosEditados = {
      id: $('#editarId').val(),
      nombre: $('#editarNombre').val(),
      descripcion: $('#editarDescripcion').val()
    };
    console.log('Datos a editar:', datosEditados);

    // Aquí puedes hacer un $.post('update.php', datosEditados, ...) o usar fetch
    $('#modalEditarTarea').modal('hide');
  });
</script>

</body>
</html>
