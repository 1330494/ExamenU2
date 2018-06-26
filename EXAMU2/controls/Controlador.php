<?php 

/**
* Clase controlador que permite la funcionabilidad del sistema 
* por medio de MVC.
*/
class Controlador_MVC
{
	// Metodo que permite mostrar la plantilla de la pagina
	public function showPage()
	{
		include "views/template.php";
	}

	// Metodo que permite el control de los enlaces y las vistas finales.
	public function linksController()
	{
		if(isset( $_GET['action'])){ // Se obtiene el valor de la variable action
			$enlaces = $_GET['action'];		
		}else{ // De lo contrario se le asigna el valor index
			$enlaces = "index";
		}

		// Obtenemos la respuesta del modelo
		$respuesta = Pages::linksModel($enlaces); 

		include $respuesta;
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para USUARIOS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR USUARIO
	#------------------------------------
	public function deleteUsuarioController(){
		// Obtenemos el ID del usuario a borrar
		if(isset($_GET["idBorrar"])){
			$datosController = $_GET["idBorrar"];
			// Mandamos los datos al modelo del usuario a eliminar
			$respuesta = UsuarioData::deleteUsuarioModel($datosController, "usuarios");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de usuarios
				header("location:index.php?action=usuarios");
			}
		}
	}

	# REGISTRO DE USUARIOS
	#------------------------------------
	public function nuevoUsuarioController(){

		if(isset($_POST["GuardarUsuario"])){
			//Recibe a traves del método POST el name (html) de username y password, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (username, password):
			$datosController = array( 
				"username"=>$_POST['username'],
				"password"=>$_POST['password1']
			);

			//Se le dice al modelo models/UsuarioCrud.php (UsuarioData::registroUsuarioModel),que en la clase "UsuarioData", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = UsuarioData::newUsuarioModel($datosController, "usuarios");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				header("Location: index.php?action=ok");
			}
			else{
				header("location:index.php");
			}
		}
	}

	# VISTA DE USUARIOS
	#------------------------------------

	public function vistaUsuariosController(){

		$respuesta = UsuarioData::viewUsuariosModel("usuarios");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card card-warning">

        <div class="card-header">
            <h3 class="card-title">Usuarios</h3>
        </div>

		<div class="card-body p-0">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Id</th>
						<th>Username</th>
						<th>Password</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $usuario){
				echo'<tr>
					<td><span class="badge bg-warning">'.$usuario["id"].'</span></td>
					<td>'.$usuario["username"].'</td>
					<td>'.crypt($usuario["password"],'YYL').'</td>
					<td><a href="index.php?action=editar&idUsuario='.$usuario["id"].'"><i class="fa fa-edit text-secondary"></i></a></td>
					<td><a href="index.php?action=usuarios&idBorrar='.$usuario["id"].'"><i class="fa fa-trash-o text-danger"></i></a></td>
					</tr>
				';
				}
				echo '</tbody>
			</table>
		</div>

		<div class="card-footer">
			<a class="btn btn-warning" href="index.php?action=registro-usuario">
	        	<i class="fa fa-plus"></i> Nuevo Usuario
	    	</a>
		</div>

		</div>';
	}

	#INGRESO DE USUARIOS
	#------------------------------------
	public function ingresoUsuarioController()
	{
		// Si se envia formulario de nuevo usuario
		if(isset($_POST["SubmitUsuario"])){
			// Guardamos los datos en un arreglo
			$datosController = array( "username"=>$_POST["usuarioIngreso"], 
								      "password"=>$_POST["passwordIngreso"]);

			$respuesta = UsuarioData::ingresoUsuarioModel($datosController, "usuarios");
			//Valiación de la respuesta del modelo para ver si es un Usuario correcto.
			if($respuesta["username"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){
				
				// Se crea la sesion
				$_SESSION["validar"] = true;
				
				header("Location: index.php?action=grupos");
			}else{
				header("Location: index.php?action=fallo");
			}
		}	
	}

	#EDITAR USUARIOS
	#------------------------------------

	public function editarUsuarioController(){

		$datosController = $_GET["idUsuario"];
		$respuesta = UsuarioData::editarUsuarioModel($datosController, "usuarios");

		echo'

		<div class="card card-primary">
    		<div class="card-header">
        		<h3 class="card-title">Editar Usuario</h3>
    		</div>
    		<!-- /.card-header -->

    		<!-- form start -->
    		<form role="form" method="POST">
        		<div class="card-body">
        			
        			<div class="form-group">          
              			<label for="nombreGrupo">Username:</label>
              			<input type="text" value="'.$respuesta["username"].'" name="usernameEditar" required class="form-control">
					</div>

					<div class="form-group">          
              			<label for="PW1">Nueva contraseña:</label>
              			<input type="password" id="PW1" name="password1Editar" required class="form-control">
					</div>

					<div class="form-group">          
              			<label for="PW2">Confirmar contraseña:</label>
              			<input type="password" id="PW2" name=password2Editar" required class="form-control">
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

					<div class="form-group">          
              			<label for="newPassword">Contraseña anterior:</label>
              			<input type="password" id="newPassword" name="newPassword" required class="form-control">
					</div>

 				</div>
        		<!-- /.card-body -->
        		<div class="card-footer">
           			<center><button type="submit" name="UsuarioEditar" class="btn btn-primary">Actualizar</button></center>
        		</div>
    		</form>
		</div>';

	}

	#ACTUALIZAR USUARIOS
	#------------------------------------
	public function actualizarUsuarioController(){

		if(isset($_POST["UsuarioEditar"])){

			$datosController = array( "username"=>$_POST["usernameEditar"],
							        "password"=>$_POST["password1Editar"]);
			
			$respuesta = UsuarioData::actualizarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){
				header("location:index.php?action=cambio");
			}else{
				echo "error";
			}
		}
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para PAGOS    +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR PAGO
	#------------------------------------
	public function deletePagoController(){
		// Obtenemos el ID del pago a borrar
		if(isset($_GET["idPagoBorrar"])){
			$datosController = $_GET["idPagoBorrar"];
			// Mandamos los datos al modelo del pago a eliminar
			$respuesta = PagoData::deletePagoModel($datosController, "pagos");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de pagos
				header("location:index.php?action=pagos-admin");
			}
		}
	}

	# REGISTRO DE PAGOS
	#------------------------------------
	public function nuevoPagoController(){

		if(isset($_POST["GuardarPago"])){
			//Recibe a traves del método POST el name (html) de no. de empleado, nombre, carrera password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (Usuario, password y email):
			$datosController = array( "id_grupo"=>$_POST["grupo"], 
								      "id_alumna"=>$_POST["alumna"],
								      "nombre_mama"=>$_POST["nombre_mama"], 
								      "apellidos_mama"=>$_POST["apellidos_mama"],
								      "fecha_pago"=>$_POST["pago"],
								      "comprobante"=>$_POST["comprobante"], 
								      "folio"=>$_POST["folio"], );

			//Se le dice al modelo models/crud.php (PagoData::registroUsuarioModel),que en la clase "PagoData", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "grupos":
			$respuesta = PagoData::newPagoModel($datosController, "pagos");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){

				header("location:index.php?action=ok");

			}

			else{

				header("location:index.php");
			}

		}

	}

	# VISTA DE PAGOS PARA USUARIO NORMAL
	#------------------------------------

	public function vistaPagosController(){

		$respuesta = PagoData::viewPagosModel("pagos");
		$grupos = GrupoData::viewGruposModel("grupos");
		$alumnas = AlumnaData::viewAlumnasModel("alumnas");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card card-info">

        <div class="card-header">
            <h3 class="card-title">Orden de envios de comprobantes</h3>
        </div>

		<div class="card-body p-0">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Num</th>
						<th>Alumna</th>
						<th>Grupo</th>
						<th>Nombre Mamá</th>
						<th>Fecha Pago</th>
						<th>Fecha Envio</th>
						<th>Folio</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $pago){
				echo'<tr>
					<td><span class="badge bg-info">'.$pago["id"].'</span></td>
					<td>'.$alumnas[($pago["id_alumna"])-1]["nombre"].' '.$alumnas[($pago["id_alumna"])-1]["apellidos"].'</td>
					<td>'.$grupos[($pago["id_grupo"])-1]["nombre"].'</td>
					<td>'.$pago["nombre_mama"].' '.$pago["apellidos_mama"].'</td>
					<td>'.$pago["fecha_pago"].'</td>
					<td>'.$pago["fecha_envio"].'</td>
					<td>'.$pago["folio"].'</td>				
				</tr>';
				}
				echo '</tbody>
			</table>
		</div>

		</div>';
	}

	# VISTA DE PAGOS PARA ADMIN
	#------------------------------------

	public function vistaPagosAdminController(){

		$respuesta = PagoData::viewPagosModel("pagos");
		$grupos = GrupoData::viewGruposModel("grupos");
		$alumnas = AlumnaData::viewAlumnasModel("alumnas");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card card-info">

        <div class="card-header">
            <h3 class="card-title">Orden de envios de comprobantes</h3>
        </div>

		<div class="card-body p-0">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Num</th>
						<th>Alumna</th>
						<th>Grupo</th>
						<th>Nombre Mamá</th>
						<th>Fecha Pago</th>
						<th>Fecha Envio</th>
						<th>Folio</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $pago){
				echo'<tr>
					<td><span class="badge bg-info">'.$pago["id"].'</span></td>
					<td>'.$alumnas[($pago["id_alumna"])-1]["nombre"].' '.$alumnas[($pago["id_alumna"])-1]["apellidos"].'</td>
					<td>'.$grupos[($pago["id_grupo"])-1]["nombre"].'</td>
					<td>'.$pago["nombre_mama"].' '.$pago["apellidos_mama"].'</td>
					<td>'.$pago["fecha_pago"].'</td>
					<td>'.$pago["fecha_envio"].'</td>
					<td><a href="index.php?action=pago&foto='.$pago["comprobante"].'"><i class="fa fa-trash-o text-danger"></i></a></td>
					<td>'.$pago["folio"].'</td>				
				</tr>';
				}
				echo '</tbody>
			</table>
		</div>

		</div>';
	}

	#EDITAR PAGOS
	#------------------------------------

	public function editarPagoController(){

		$datosController = $_GET["idPago"];
		$respuesta = PagoData::editarPagoModel($datosController, "pagos");

		echo'

		<div class="card card-primary">
    		<div class="card-header">
        		<h3 class="card-title">Editar Pago</h3>
    		</div>
    		<!-- /.card-header -->

    		<!-- form start -->
    		<form role="form" method="POST">
        		<div class="card-body">
        			
        			<div class="form-group">          
              			<label for="idPagoEditar">ID:</label>
              			<input type="text" value="'.$respuesta["id"].'" name="idPagoEditar" readonly required class="form-control">
					</div>

					<div class="form-group">          
              			<label for="idGrupoPagoEditar">Contraseña anterior:</label>
              			<input type="password" id="newPassword" name="newPassword" required class="form-control">
					</div>

 				</div>
        		<!-- /.card-body -->
        		<div class="card-footer">
           			<center><button type="submit" name="PagoEditar" class="btn btn-primary">Actualizar</button></center>
        		</div>
    		</form>
		</div>';

	}

	#ACTUALIZAR PAGOS
	#------------------------------------
	public function actualizarPagoController(){

		if(isset($_POST["PagoEditar"])){

			$datosController = array( "username"=>$_POST["usernameEditar"],
							        "password"=>$_POST["password1Editar"]);
			
			$respuesta = UsuarioData::actualizarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){
				header("location:index.php?action=cambio");
			}else{
				echo "error";
			}
		}
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para Grupos   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR GRUPO
	#------------------------------------
	public function deleteGrupoController(){
		// Obtenemos el ID del grupo a borrar
		if(isset($_GET["idGrupoBorrar"])){
			$datosController = $_GET["idGrupoBorrar"];
			// Mandamos los datos al modelo del grupo a eliminar
			$respuesta = GrupoData::deleteGrupoModel($datosController, "grupos");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de grupos
				header("location:index.php?action=grupos");
			}
		}
	}

	# VISTA DE GRUPOS
	#------------------------------------

	public function vistaGruposController(){

		$respuesta = GrupoData::viewGruposModel("grupos");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card card-success">

        <div class="card-header">
            <h3 class="card-title">Grupos</h3>
        </div>

		<div class="card-body p-0">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nombre</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $grupo){
				echo'<tr>
					<td> <span class="badge bg-success">'.$grupo["id"].'</span></td>
					<td>'.$grupo["nombre"].'</td>
					<td><a href="index.php?action=editar&idGrupo='.$grupo["id"].'"><i class="fa fa-edit text-secondary"></i></a></td>
					<td><a href="index.php?action=eliminar$idGrupo='.$grupo["id"].'"><i class="fa fa-trash-o text-danger"></i></a></td>
				</tr>';
				}
				echo '</tbody>
			</table>
		</div>
		<div class="card-footer">
			<a class="btn btn-success" href="index.php?action=registro-grupo">
	        	<i class="fa fa-plus"></i> Nuevo Grupo
	    	</a>
	    </div>
		</div>';
	}

	# REGISTRO DE GRUPOS
	#------------------------------------
	public function nuevoGrupoController(){

		if(isset($_POST["GuardarGrupo"])){
			//Recibe a traves del método POST el name (html) el nombre y se almacenan los datos en una variable de tipo array con sus respectivas propiedades (nombre):
			$datosController = array("nombre"=>$_POST['nombreGrupo']);

			//Se le dice al modelo models/crud.php (GrupoData::newGrupoModel),que en la clase "GrupoData", la funcion "newGrupoModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = GrupoData::newGrupoModel($datosController, "grupos");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				header("Location: index.php?action=grupos");
			}
			else{
				header("Location: index.php");
			}
		}

	}

	#EDITAR GRUPO
	#------------------------------------

	public function editarGrupoController(){

		$datosController = $_GET["idGrupo"];
		$respuesta = GrupoData::editarGrupoModel($datosController, "grupos");

		echo'

		<div class="card card-primary">
    		<div class="card-header">
        		<h3 class="card-title">Editar Grupo</h3>
    		</div>
    		<!-- /.card-header -->

    		<!-- form start -->
    		<form role="form" method="POST">
        		<div class="card-body">
        			
        			<div class="form-group">          
              			<label for="idGrupoEditar">ID:</label>
              			<input type="text" value="'.$respuesta["id"].'" name="idGrupoEditar" readonly required class="form-control">
					</div>

					<div class="form-group">          
              			<label for="nombreGrupoEditar">Nombre:</label>
              			<input type="text" id="nombreGrupoEditar" name="nombreGrupoEditar" required class="form-control" value="'.$respuesta['nombre'].'">
					</div>

 				</div>
        		<!-- /.card-body -->
        		<div class="card-footer">
           			<center><button type="submit" name="GrupoEditar" class="btn btn-primary">Actualizar</button></center>
        		</div>
    		</form>
		</div>';

	}

	#ACTUALIZAR GRUPO
	#------------------------------------
	public function actualizarGrupoController(){

		if(isset($_POST["GrupoEditar"])){

			$datosController = array( "id"=>$_POST["idGrupoEditar"],
							        "nombre"=>$_POST["nombreGrupoEditar"]);
			
			$respuesta = GrupoData::actualizarGrupoModel($datosController, "grupos");

			if($respuesta == "success"){
				header("Location:index.php?action=cambio");
			}else{
				echo "error";
			}
		}
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para ALUMNAS  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR ALUMNA
	#------------------------------------
	public function deleteAlumnaController(){
		// Obtenemos el ID de la alumna a borrar
		if(isset($_GET["idAlumnaBorrar"])){
			$datosController = $_GET["idAlumnaBorrar"];
			// Mandamos los datos al modelo de la alumna a eliminar
			$respuesta = AlumnaData::deleteAlumnaModel($datosController, "alumnas");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de alumnas
				header("location:index.php?action=alumnas");
			}
		}
	}

	# VISTA DE ALUMNAS
	#------------------------------------

	public function vistaAlumnasController(){

		$respuesta = AlumnaData::viewAlumnasModel("alumnas");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card card-danger">

        <div class="card-header">
            <h3 class="card-title">Alumnas</h3>
        </div>

		<div class="card-body p-0">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nombre</th>
						<th>Fecha Nacimiento</th>
						<th>Grupo</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $alumna){
				$grupo = GrupoData::editarGrupoModel($alumna["id_grupo"],"grupos");
				echo'
				<tr>
					<td> <span class="badge bg-danger">'.$alumna["id"].'</span></td>
					<td>'.$alumna["nombre"].' '.$alumna["apellidos"].'</td>
					<td>'.$alumna["fecha_nac"].'</td>
					<td>'.$grupo['nombre'].'</td>
					<td><a href="index.php?action=editarAlumna&idAlumna='.$alumna["id"].'"><i class="fa fa-edit text-secondary"></i></a></td>
					<td><a href="index.php?action=eliminarAlumna&idAlumna='.$alumna["id"].'"><i class="fa fa-trash-o text-danger"></i></a></td>				
				</tr>';

				}
				echo '</tbody>
			</table>
		</div>

		<div class="card-footer">
			<a class="btn btn-danger" href="index.php?action=registro-alumna">
        		<i class="fa fa-plus"></i> Nueva Alumna
    		</a>
		</div>

		</div>';
	}

	# REGISTRO DE ALUMNAS
	#------------------------------------
	public function nuevaAlumnaController(){

		if(isset($_POST["GuardarAlumna"])){
			//Recibe a traves del método POST el name (html) el nombre y se almacenan los datos en una variable de tipo array con sus respectivas propiedades (nombre):
			$datosController = array("nombre"=>$_POST['nombre_alumna'],
									"apellidos"=>$_POST['apellidos_alumna'],
									"fecha_nac"=>$_POST['nacimiento'],
									"id_grupo"=>$_POST['grupo']);

			//Se le dice al modelo models/crud.php (GrupoData::newGrupoModel),que en la clase "GrupoData", la funcion "newGrupoModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = AlumnaData::newAlumnaModel($datosController, "alumnas");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				header("Location: index.php?action=alumnas");
			}
			else{
				header("Location: index.php");
			}
		}

	}
}
?>
