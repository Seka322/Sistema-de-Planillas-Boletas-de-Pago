<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Página Principal</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right"></ol>
        </div>
      </div>
    </div>
  </section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h3>Cálculo de sueldo</h3>
            <p class="lead">Módulo de Pago</p>
            <br>
            
            <!-- Inicio del formulario -->
            <form action="<?php echo base_url();?>index.php/hora/crear_registro_boleta_pago" method ="POST">
						  <input type="hidden" id="id_trabajador" name="id_trabajador" value="<?php echo isset($id_trabajador) ? $id_trabajador : ''; ?>">
              <div class="form-group">
                <label for="horas_trabajadas">Horas trabajadas</label>
                <input type="number" class="form-control" id="horas_trabajadas" name="horas_trabajadas" min="1" required>
              </div>
              <div class="form-group">
                <label for="wage">Sueldo</label>
                <input type="number" class="form-control" id="sueldo" name="sueldo" min="1" required>
              </div>
              <button type="submit" class="btn btn-primary">Generar Boleta</button>
            </form>
            <!-- Fin del formulario -->
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
