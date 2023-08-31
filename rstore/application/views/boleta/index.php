<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Página de Boletas de Pago</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <!-- breadcrumb content -->
          </ol>
        </div>
      </div>
    </div><!-- /.container-flui d -->
  </section>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h3>Listado de Boletas de Pago</h3>
						<br>
						<?php if (isset($mensaje)): ?>
								<div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
										<?php echo $mensaje; ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
										</button>
								</div>
						<?php endif; ?>


            <table id="boletas_table" class="table table-bordered table-striped">
              <thead>
                <tr>
								  <th style="text-align:center;">Tipo Documento</th> 
									<th style="text-align:center;">DNI Trabajador</th> 
									<th style="text-align:center;">Fecha</th>
                  <th style="text-align:center;">Horas Trabajadas</th>
                  <th style="text-align:center;">Monto Total</th>
                  <th style="text-align:center;">Acciones</th>
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
    $('#boletas_table').DataTable({
        "ajax": {
            "url": "<?php echo base_url();?>index.php/boleta/ajax_list"
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
function confirmDeleteBoleta(id_boleta) {
    if (confirm("¿Estás seguro de eliminar esta boleta?")) {
        // Hacer la solicitud para eliminar la boleta
        deleteBoleta(id_boleta);
    }
}

function deleteBoleta(id_boleta) {
    // Realizar una solicitud AJAX al controlador para eliminar la boleta
    $.ajax({
        url: "<?php echo base_url('boleta/delete_boleta'); ?>",
        type: "POST",
        data: { id_boleta: id_boleta },
        success: function(response) {
            // Actualizar el datatable después de la eliminación
            $("#boletas_table").DataTable().ajax.reload();
        }
    });
}
</script>
