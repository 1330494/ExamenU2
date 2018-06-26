<?php

if(!$_SESSION["validar"]){
	header("Location: index.php?action=admin");
	exit();
}

?>
<div class="row" style="height: 100px;width: 100%;"></div>

<div class="col-md-4"></div>

<div class="col-md-4">	
	<div class="card card-info">
	    <div class="card-header">
	        <h3 class="card-title">Nuevo Grupo</h3>
	    </div>
	    <!-- /.card-header -->

	    <!-- form start -->
	    <form role="form" method="POST">
	        <div class="card-body">
	        	
	        	<div class="form-group">          
	              	<label for="nombreGrupo">Nombre del Grupo:</label>
	              	<input type="text" required class="form-control" id="nombreGrupo"
	               name="nombreGrupo" placeholder="Nombre">
	          	</div>

	 		</div>
	        <!-- /.card-body -->
	        <div class="card-footer">
	           	<center><button type="submit" name="GuardarGrupo" class="btn btn-success">Guardar</button></center>
	        </div>
	    </form>

	</div>
</div>

<div class="col-md-4"></div>

<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoGrupoController de la clase MvcController:
$registro -> nuevoGrupoController();

if(isset($_GET["action"])){
	if($_GET["action"] == "ok"){
		echo "Registro Exitoso";
	}
}

?>