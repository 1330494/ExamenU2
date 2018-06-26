<div class="row" style="height: 100px;width: 100%;"></div>

<div class="col-md-3"></div>

<div class="col-md-6">
  <div class="card card-info">
      <div class="card-header">
          <h3 class="card-title">Formulario de envío de comprobantes</h3>
      </div>
      <!-- /.card-header -->
      
      <!-- form start -->
      <form role="form" method="POST">
          <div class="card-body">

          	<div class="form-group">
            		<label for="grupo">Grupo</label>
                <select id="grupo" name="grupo" class="form-control" required>
                  <?php 
                    $grupos = GrupoData::viewGruposModel("grupos");;
                    echo '<option value="" disabled selected >Selecciona grupo</option>';
                    foreach ($grupos as $grupo) {
                      echo '<option value="'.$grupo['id'].'" >'.$grupo['nombre'].'</option>';
                    }
                   ?>
                </select>

                <script type="text/javascript">
                  document.getElementById('grupo').onchange = function(e) {
                    alert('Selecciono'+this.value);
                  };
                </script>
          	</div>

          	<div class="form-group">
            		<label for="alumna">Alumna:</label>          	
                <select id="alumna" name="alumna" class="form-control" required>
                  <?php 
                    $alumnas = AlumnaData::viewAlumnasModel("alumnas");
                    echo '<option value="" disabled selected >Selecciona alumna</option>';
                    foreach ($alumnas as $alumna) {
                      echo '<option value="'.$alumna['id'].'" >'.$alumna['nombre'].' '.$alumna['apellidos'].'</option>';
                    }
                   ?>
                </select>
          	</div>

            <div class="form-group">          
                <label for="folio">Nombre de la madre:</label>
                <input type="text" required class="form-control" id="nombre_mama"
                 name="nombre_mama" placeholder="Nombre(s)">
            </div>

            <div class="form-group">          
                <label for="folio">Apellidos de la madre:</label>
                <input type="text" required class="form-control" id="apellidos_mama" name="apellidos_mama" placeholder="Apellidos">
            </div>
            
            <div class="form-group">
              <label>Fecha de pago:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                  <input type="date" class="form-control" name="pago" id="pago" required>
              </div>
              <!-- /.input group -->
            </div>

            <div class="form-group">
              <label for="exampleInputFile">Comprobante:</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" required class="custom-file-input" accept="image/*" value="Buscar" name="comprobante" id="comprobante">
                    <label class="custom-file-label" for="comprobante">Selecciona imagen</label>
                </div>
                <div class="input-group-append">
                  <span class="input-group-text" id="">Subir</span>
                </div>
              </div>
            </div>

            <div class="form-group">          
                <label for="folio">Folio:</label>
                <input type="number" required min="1" max="1000" class="form-control" id="folio" name="folio" placeholder="Folio">
            </div>

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
             	<center><button type="submit" name="GuardarPago" class="btn btn-info">Guardar</button></center>
          </div>
      </form>
  </div>	
</div>

<div class="col-md-3"></div>
<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoAlumnoController de la clase Controlador_MVC:
$registro -> nuevoPagoController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>

