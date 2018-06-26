<?php

if(!$_SESSION["validar"]){
	header("Location: index.php?action=admin");
	exit();
}

?>
<div class="row" style="height: 50px;width: 100%;"></div>

<div class="col-md-3"></div>

<div class="col-md-6">	
<?php

	$vistaUsuarios = new Controlador_MVC();
	$vistaUsuarios -> vistaUsuariosController();
	
?>
</div>

<div class="col-md-3"></div>