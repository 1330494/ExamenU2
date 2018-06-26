<?php 

class Pages{
	
	public static function linksModel($links){

		if($links == "alumnas" || $links == "salir" || $links == "usuarios" 
			|| $links == "registro-alumna" || $links == "pagos" || $links == "registro-pago"
			|| $links == "grupos" || $links == "registro-grupo" || $links == "registro-usuario" || $links == "editar-grupo")
		{
			$module =  "views/moduls/".$links.".php";
		}else if($links == "admin"){
			$module =  "views/moduls/ingresar.php";
		}else if($links == "ok"){
			$module =  "views/moduls/pagos.php?";
		}else if($links == "fallo"){
			$module =  "views/moduls/ingresar.php";
		}else if($links == "cambio"){
			$module =  "views/moduls/pagos.php";
		}else{
			$module =  "views/moduls/registro-pago.php";
		}
		return $module; 
	}
}

?>