<div class="row" style="height: 100px;width: 100%;"></div>

<div class="col-md-4"></div>

<div class="col-md-4">
  <div class="card card-success">
    <div class="card-header">
      <center><h3 class="card-title">Login</h3></center>
    </div>
    <!-- /.card-header -->
      
    <!-- form start -->
    <form role="form" method="POST">
    <div class="card-body">
    
      <div class="form-group">          
        <label for="username">Nombre de usuario:</label>
        <input type="text" required class="form-control" id="username" name="usuarioIngreso" placeholder="Username">
      </div>

      <div class="form-group">          
        <label for="password">Contraseña:</label>
        <input type="password" required class="form-control" id="password" name="passwordIngreso" placeholder="Contraseña">
      </div>

  	</div>
  	<!-- /.card-body -->
  	
    <div class="card-footer">
      <center><button type="submit" name="SubmitUsuario" class="btn btn-success">Ingresar</button></center>
    </div>
    <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->
</div>

<div class="col-md-4"></div>
	
<?php

$ingreso = new Controlador_MVC();
$ingreso -> ingresoUsuarioController();

if(isset($_GET["action"])){
	if($_GET["action"] == "fallo"){
		echo "Fallo al ingresar";
	}
}

?>