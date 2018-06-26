<?php

if(!isset($_SESSION["validar"])){
	header("Location: index.php?action=admin");
	exit();
}

?>
<div class="row" style="height: 50px;width: 100%;"></div>

<div class="col-md-4"></div>

<div class="col-md-4">			
<?php

	$vistaGrupo = new Controlador_MVC();
	$vistaGrupo -> vistaGruposController();
	//$vistaGrupo -> editarGrupoController();
	$vistaGrupo -> deleteGrupoController();

	if(isset($_GET["action"])){

	if($_GET["action"] == "cambio"){
		echo "Cambio Exitoso";
	}
}
?>
</div>

<div class="col-md-4"></div>