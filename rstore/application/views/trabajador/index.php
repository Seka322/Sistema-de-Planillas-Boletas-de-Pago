<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Página de Trabajadores</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <!-- breadcrumb content -->
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h3>Listado de Trabajadores</h3>

						<br>
						<div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none">
							Registros guardados exitosamente.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevo_trabajador">
					Crear Nuevo Trabajador
				</button>
				<br><br>
						
            <table id="trabajadores_table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Dirección</th>
                  <th>DNI</th>
                  <th>Teléfono</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <!-- El contenido será cargado desde AJAX -->
              </tbody>
            </table>

						<!-- Modal nuevo_trabajador -->
						<div class="modal fade" id="nuevo_trabajador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="myModalLabel">Crear Nuevo Trabajador</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form id="crear_trabajador_form">
											<div class="form-group">
												<label for="correo">Correo:</label>
												<input type="email" class="form-control" id="correo" name="correo" maxlength="250" required>
											</div>
											<div class="form-group">
												<label for="direccion">Dirección:</label>
												<input type="text" class="form-control" id="direccion" name="direccion" maxlength="250" required>
											</div>
											<div class="form-group">
												<label for="dni">DNI:</label>
												<input type="number" class="form-control" id="dni" name="dni" min="10000000" max="99999999" required>
											</div>
											<div class="form-group">
												<label for="nombre">Nombre:</label>
												<input type="text" class="form-control" id="nombre" name="nombre" maxlength="250" required>
											</div>
											<div class="form-group">
												<label for="telefono">Teléfono:</label>
												<input type="tel" class="form-control" id="telefono" name="telefono" pattern="[0-9]{9}" required>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
										<button type="submit" class="btn btn-primary" form="crear_trabajador_form">Crear</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal editar_trabajador -->
						<div class="modal fade" id="editar_trabajador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="myModalLabel">Editar Trabajador</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form id="editar_trabajador_form">
											<input type="hidden" id="id_editar" name="id_editar">
											<div class="form-group">
												<label for="correo_editar">Correo:</label>
												<input type="email" class="form-control" id="correo_editar" name="correo_editar" maxlength="250" required>
											</div>
											<div class="form-group">
												<label for="direccion_editar">Dirección:</label>
												<input type="text" class="form-control" id="direccion_editar" name="direccion_editar" maxlength="250" required>
											</div>
											<div class="form-group">
												<label for="dni_editar">DNI:</label>
												<input type="number" class="form-control" id="dni_editar" name="dni_editar" min="10000000" max="99999999" required>
											</div>
											<div class="form-group">
												<label for="nombre_editar">Nombre:</label>
												<input type="text" class="form-control" id="nombre_editar" name="nombre_editar" maxlength="250" required>
											</div>
											<div class="form-group">
												<label for="telefono_editar">Teléfono:</label>
												<input type="tel" class="form-control" id="telefono_editar" name="telefono_editar" pattern="[0-9]{9}" required>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
										<button type="submit" class="btn btn-primary" form="editar_trabajador_form">Guardar Cambios</button>
									</div>
								</div>
							</div>
						</div>





          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
	$(document).ready(function() {
		$('#trabajadores_table').DataTable({
			"ajax": {
				"url": "<?php echo base_url();?>index.php/trabajador/ajax_list"
			},
			language: {
				"paginate": {
					"first": "Primero",
					"last": "Último",
					"next": "Siguiente",
					"previous": "Anterior",
				},
				"aria": {
					"sortAscending": ": Activar para ordenar la columna de manera ascendente",
					"sortDescending": ": Activar para ordenar la columna de manera descendente",
				},
				"search": "Buscar",
				"info": "Mostrando página _PAGE_ de _PAGES_",
				"infoEmpty": "No se encuentran registros",
				"lengthMenu": "Mostrando _MENU_ filas por página",
			}
		})
	});
</script>
<script>
	document.getElementById('crear_trabajador_form').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(e.target);

	fetch('<?php echo base_url();?>index.php/trabajador/create_trabajador', {
			method: 'POST',
			body: formData
		})
		.then(response => response.json())
		.then(data => {
			console.log(data);
			$('#nuevo_trabajador').modal('hide');
			// Recarga la tabla de trabajadores
			$('#trabajadores_table').DataTable().ajax.reload();
			// Muestra la alerta
			document.getElementById('success-alert').style.display = 'block';
		})
		.catch(error => console.error('Error:', error));
	});
</script>
<script>
	function edit_worker(id) 
	{
		fetch("<?php echo base_url();?>index.php/trabajador/get_json_trabajador_by_id", {
			method: "POST",
			headers: { "Content-Type": "application/x-www-form-urlencoded" },
			body: new URLSearchParams({ "id": id })
		})
		.then(response => response.json())
		.then(data => {
			document.getElementById('correo_editar').value = data.correo;
			document.getElementById('direccion_editar').value = data.direccion;
			document.getElementById('dni_editar').value = data.dni;
			document.getElementById('nombre_editar').value = data.nombre;
			document.getElementById('telefono_editar').value = data.telefono;
			document.getElementById('id_editar').value = data.id;

			// Abre el modal de edición
			$('#editar_trabajador').modal('show');
		})
		.catch(error => console.error('Error:', error));
	}
</script>
<script>
	document.querySelector('#editar_trabajador_form').addEventListener('submit', function(event) {
    event.preventDefault();  // prevenir el comportamiento de envío normal del formulario

    let trabajadorData = new FormData();
    trabajadorData.append('id', document.querySelector('#id_editar').value);
    trabajadorData.append('correo', document.querySelector('#correo_editar').value);
    trabajadorData.append('direccion', document.querySelector('#direccion_editar').value);
    trabajadorData.append('dni', document.querySelector('#dni_editar').value);
    trabajadorData.append('nombre', document.querySelector('#nombre_editar').value);
    trabajadorData.append('telefono', document.querySelector('#telefono_editar').value);

    fetch('<?php echo base_url();?>index.php/trabajador/update_trabajador', {
        method: 'POST',
        body: trabajadorData
    })
		.then(response => response.json())
		.then(data => {
			if (data.message) {
				$('#editar_trabajador').modal('hide');  // cerrar el modal
				// Recarga la tabla de trabajadores
				$('#trabajadores_table').DataTable().ajax.reload();
				// Muestra la alerta
				document.getElementById('success-alert').style.display = 'block';
			} else if (data.error) {
				alert(data.error);
			}
		})
		.catch(error => console.error('Error:', error));
	});
</script>
<script>
function confirmDeleteWorker(id_trabajador) {
    if (confirm("¿Estás seguro de eliminar a este trabajador?")) {
        deleteWorker(id_trabajador);
    }
}

function deleteWorker(id_trabajador) {
    $.ajax({
        url: "<?php echo base_url('trabajador/delete_trabajador'); ?>",
        type: "POST",
        data: { id_trabajador: id_trabajador },
        success: function(response) {
            if (response === "success") {
                // Actualizar el datatable después de la eliminación
                $("#trabajadores_table").DataTable().ajax.reload();
            } else {
                alert(response); // Mostrar el mensaje de error devuelto por el controlador
            }
        }
    });
}
</script>
