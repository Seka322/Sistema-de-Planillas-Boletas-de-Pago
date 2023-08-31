<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Página de Cálculo de Pago</h1>
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
            <h3>Seleccione un trabajador</h3>

						<br>
						<div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none">
							Registros guardados exitosamente.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
			<br>
						
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
				"url": "<?php echo base_url();?>index.php/hora/ajax_list"
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
