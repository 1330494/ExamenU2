<?php

if(!$_SESSION["validar"]){
	header("Location: index.php?action=admin");
	exit();
}

?>
<div class="row" style="height: 50px;width: 100%;"></div>

<div class="col-md-2"></div>

<div class="col-md-8">	
<?php

	$vistaAlumnas = new Controlador_MVC();
	$vistaAlumnas -> vistaAlumnasController();
	
?>
</div>

<div class="col-md-2"></div>