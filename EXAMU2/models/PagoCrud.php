<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Connector.php";

//heredar la clase DBConnector de Connector.php para poder utilizar "DBConnector" del archivo Connector.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del modelos/Connector.php:
class PagoData extends DBConnector
{

	# METODO PARA REGISTRAR NUEVO PAGO	
	#-------------------------------------
	public static function newPagoModel($PagoModel, $tabla_db){

		/*Fecha del server*/
		$fecha_envio = date("Y").'-'.date("m").'-'.(date("d"));
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = DBConnector::connect()->prepare("INSERT INTO $tabla_db (id_alumna,id_grupo,nombre_mama,apellidos_mama, fecha_pago, fecha_envio, comprobante, folio) VALUES (:id_alumna,:id_grupo,:nombre_mama,:apellidos_mama, :fecha_pago, :fecha_envio, :comprobante, :folio)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":id_grupo", $PagoModel["id_grupo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_alumna", $PagoModel["id_alumna"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_mama", $PagoModel["nombre_mama"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos_mama", $PagoModel["apellidos_mama"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_pago", $PagoModel["fecha_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_envio", $fecha_envio, PDO::PARAM_STR);
		$stmt->bindParam(":comprobante", $PagoModel["comprobante"], PDO::PARAM_STR);
		$stmt->bindParam(":folio", $PagoModel["folio"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}


	# VISTA DE VentaS
	#-------------------------------------

	public static function viewPagosModel($tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}


	# METODO PARA BORRAR UN Venta
	#------------------------------------
	public static function deletePagoModel($PagoModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("DELETE FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $PagoModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA DEVOLVER Y EDITAR UN Venta
	#------------------------------------
	public static function editarPagoModel($PagoModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $PagoModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetch();
		}else{
			return "error";
		}
		$stmt->close();
	}

	

}
?>