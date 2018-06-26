<?php

if(!$_SESSION["validar"]){
	header("Location: index.php?action=admin");
	exit();
}

?>
<div class="row" style="height: 50px;width: 100%;"></div>

<div class="col-md-4"></div>

<div class="col-md-4">
	<div class="card card-info">
	    <div class="card-header">
	        <h3 class="card-title">Registro alumna</h3>
	    </div>
	    <!-- /.card-header -->

	    <!-- form start -->
	    <form role="form" method="POST">
	        <div class="card-body">
	 		
		 		<div class="form-group">          
		            <label for="folio">Nombre(s):</label>
		            <input type="text" required class="form-control" id="nombre_alumna" name="nombre_alumna" placeholder="Nombre(s)">
		        </div>

		        <div class="form-group">          
		            <label for="folio">Apellidos:</label>
		            <input type="text" required class="form-control" id="apellidos_alumna" name="apellidos_alumna" placeholder="Apellidos">
		        </div>

		        <div class="form-group">
	            	<label>Fecha de Nacimiento:</label>
	            	<div class="input-group">
	              		<div class="input-group-prepend">
	                		<span class="input-group-text"><i class="fa fa-calendar"></i></span>
	              		</div>
	                	<input type="date" class="form-control" name="nacimiento" id="nacimiento" required>
	            	</div>
	            	<!-- /.input group -->
	          	</div>

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
          		</div>

	 		</div>
	        <!-- /.card-body -->
	        
	        <div class="card-footer">
	           	<center><button type="submit" name="GuardarAlumna" class="btn btn-success">Guardar</button></center>
	        </div>
	    </form>

	</div>
</div>

<div class="col-md-4"></div>
<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoAlumnoController de la clase MvcController:
$registro -> nuevaAlumnaController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
