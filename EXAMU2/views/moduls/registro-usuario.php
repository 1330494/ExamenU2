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
      <h3 class="card-title">Nuevo usuario</h3>
    </div>
    <!-- /.card-header -->

    <!-- form start -->
    <form role="form" method="POST">
      <div class="card-body">		
        <div class="form-group">          
          <label for="username">Nombre de usuario:</label>
          <input type="text" id="username" name="username" required class="form-control">
				</div>

				<div class="form-group">          
        	<label for="password1">Contraseña:</label>
        	<input type="password" id="PW1" name="password1" required class="form-control">
				</div>

				<div class="form-group">          
          <label for="password2">Confirmar contraseña:</label>
          <input type="password" id="PW2" name=password2" required class="form-control">
				</div>
				<script type="text/javascript">
					document.getElementById("PW2").onchange = function(e){
						var PW1 = document.getElementById("PW1");
						if(this.value != PW1.value ){
							alert("Contraseñas no coinciden.");
							PW1.focus();
							this.value = "";
						}
					};
				</script>

 				</div>
        	<!-- /.card-body -->
        	<div class="card-footer">
           	<center><button type="submit" name="GuardarUsuario" class="btn btn-success">Guardar</button></center>
        	</div>
    		</form>
		</div>
</div>

<div class="col-md-4"></div>
<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoGrupoController de la clase MvcController:
$registro -> nuevoUsuarioController();

if(isset($_GET["action"])){
  if($_GET["action"] == "ok"){
    echo "Registro Exitoso";
  }
}

?>