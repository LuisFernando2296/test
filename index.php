<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Tareas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & FontAwesome: Frameworks para diseño y uso de íconos -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Archivo de estilos personalizados -->
  <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

  <!-- Contenedor principal del contenido -->
  <div class="container container-box">

    <!-- Título y botón para abrir el modal de nueva tarea -->
    <div class="row align-items-center mb-4">
      <div class="col-8 col-sm-9">
        <h1 class="mb-0">Lista de Tareas</h1>
      </div>
      <div class="col-4 col-sm-3 text-end">
        <!-- Botón circular para abrir modal de agregar tarea -->
        <button class="btn btn-light btn-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTarea" title="Agregar tarea">
          <i class="fas fa-plus"></i>
        </button>
      </div>
    </div>

    <!-- Tabla de tareas (se llena dinámicamente con JS) -->
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-primary">
          <tr>
            <th>ID</th>
            <th>Tarea</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="tablaTareas"></tbody>
      </table>
    </div>
  </div>

  <!-- Modal: Agregar nueva tarea -->
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
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la tarea" required>
            </div>
          </div>
          <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal: Editar tarea -->
  <div class="modal fade" id="modalEditarTarea" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-4 shadow">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditarLabel">Editar Tarea</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <form id="formEditarTarea">
          <div class="modal-body">
            <!-- Campo oculto con el ID de la tarea -->
            <input type="hidden" id="editarId" name="id">
            <div class="mb-3">
              <label for="editarNombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="editarNombre" name="nombre" required>
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

  <!-- JS: Librerías y lógica -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    /**
     * Carga las tareas desde getTareas.php
     * y las inserta dinámicamente en la tabla HTML
     */
    function cargarTareas() {
      $.get('componentes/getTareas.php', function (res) {
        try {
          const tareas = JSON.parse(res);
          let html = '';
          tareas.forEach(t => {
            html += `
              <tr>
                <td>${t.id}</td>
                <td>${t.task_name}</td>
                <td>
                  <i class="fas fa-pen-to-square text-primary me-2 editar-btn"
                     data-id="${t.id}"
                     data-nombre="${t.task_name}"
                     role="button"></i>
                  <i class="fas fa-trash text-danger eliminar-btn"
                     data-id="${t.id}"
                     role="button"></i>
                </td>
              </tr>
            `;
          });
          $('#tablaTareas').html(html);
        } catch (err) {
          console.error('Error al procesar las tareas:', err);
        }
      });
    }

    /**
     * Maneja el envío del formulario para agregar una nueva tarea
     */
    $('#formTarea').on('submit', function (e) {
      e.preventDefault();
      const datos = {
        nombre: $('#nombre').val()
      };

      $.post('componentes/add.php', datos, function (res) {
        const respuesta = JSON.parse(res);
        if (respuesta.status === 'success') {
          $('#modalTarea').modal('hide');
          $('#formTarea')[0].reset();
          cargarTareas(); // Refresca la tabla sin recargar la página
        } else {
          alert(respuesta.message);
        }
      });
    });

    /**
     * Llama a cargarTareas() cuando el documento está listo
     */
    $(document).ready(function () {
      cargarTareas();
    });

    /**
     * Evento para eliminar una tarea
     * Muestra confirmación y luego envía el ID al backend
     */
    let tareaAEliminar = null;
    $(document).on('click', '.eliminar-btn', function () {
      tareaAEliminar = $(this).data('id');

      if (confirm("¿Estás seguro de que deseas eliminar esta tarea?")) {
        $.post('componentes/delete.php', { id: tareaAEliminar }, function (res) {
          const respuesta = JSON.parse(res);
          if (respuesta.status === 'success') {
            cargarTareas();
          } else {
            alert(respuesta.message);
          }
        });
      }
    });

    /**
     * Evento para cargar datos en el modal de edición
     * y guardar los cambios en la base de datos
     */
    $(document).on('click', '.editar-btn', function () {
      const id = $(this).data('id');
      const nombre = $(this).data('nombre');

      $('#editarId').val(id);
      $('#editarNombre').val(nombre);
      $('#modalEditarTarea').modal('show');
    });

    $('#formEditarTarea').on('submit', function (e) {
      e.preventDefault();
      const datosEditados = {
        id: $('#editarId').val(),
        nombre: $('#editarNombre').val()
      };

      $.post('componentes/edit.php', datosEditados, function (res) {
        const respuesta = JSON.parse(res);
        if (respuesta.status === 'success') {
          $('#modalEditarTarea').modal('hide');
          cargarTareas();
        } else {
          alert(respuesta.message);
        }
      });
    });
  </script>

</body>
</html>
