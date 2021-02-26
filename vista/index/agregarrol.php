<?php
$titulo = "amarchivo";
//include_once("../../configuracion.php");
include_once("../estructura/cabecera.php");
if(!$sesion->esAdmin()){
	header("Location:paginaprincipal.php");
}

$datos = data_submitted();
//recupero los datos que vienen del boton agregar rol
$idusuario = $datos['idusuario'];
$condicion = "idusuario = ".$idusuario;
//busco al usuario
$objAbmUsuario = new AbmUsuario();
$usuarios = $objAbmUsuario->buscarCondicion($condicion);
if(count($usuarios)!=0){
	//print_r($usuarios);
	$usuario = $usuarios[0];

	//busco los roles del sistema
	$objAbmRol = new AbmRol();
	$roles = $objAbmRol->buscar($datos);
	//print_r($roles);
	//buscar los roles del usuario
	$objAbmUsuarioRol = new AbmUsuarioRol();
	$rolesUsuario = $objAbmUsuarioRol->buscarCondicion($condicion);
	//print_r($rolesUsuario);
	$nuevosRoles= array();
	foreach ($roles as $rol) {
		foreach ($rolesUsuario as $roles) {
			if($rol->getId()!=$roles->getIdRol()->getId()){
				array_push($nuevosRoles, $rol);
			}
		}
	}
}

?>
<div class="d-flex justify-content-center h-100">
	<div class="card m-3">
		<div class="card-header mx-auto">
			<h2>Asignar Rol</h2>
		</div>
		<div class="card-body justify-content-center">
			<form class="needs-validation" novalidate id="asignarrol" name="asignarrol" method="POST" action="accionusuarios.php" data-toggle="validator" enctype="multipart/form-data">


				<div class="input-group form-group">
					<!--NOMBRE DE USUARIO-->
					<label for="nombre" class="col-form-label">Nombre de Usuario: </label>
					<div class="input-group form-group">
						<input type="text" readonly="readonly" name="usuario" id="usuario" placeholder="" class="form-control"  value="<?= $usuario->getNombre()." ".$usuario->getApellido()?>">
						<input type="hidden" id="idusuario" name="idusuario" value="<?= $usuario->getId()?>">
					</div>
					<!--ROLES-->
					<label for="usuario" class="col-form-label">Elija un nuevo rol:</label>
					<div class="input-group form-group">
						<select class="custom-select" id="idrol" name="idrol" required>
							<option selected></option>
							<?php foreach ($nuevosRoles as $roles): ?>
								<option value=" <?= $roles->getId() ?>"> <?= $roles->getDescripcion() ?></option>
							<?php endforeach; ?>
						</select>
						<label id="usuario_mensaje_error" class="sin_error" aria-live="polite" ></label>
					</div>


				</div>


				<!--MANDA LA ACCION-->
				<input type="hidden"  id="accion" name="accion" value="2">

				<!--BOTONES-->
				<div class="row align-items float-right mx-auto">
					<div class="col input-group form-group">
						<button type="reset" class="btn btn-danger" id="boton_borrar" name="boton_borrar" >Borrar</button>
					</div>
					<div class="col input-group form-group">
						<a role="button" class="btn btn-secondary" id="boton" name="boton" href="usuariosregistrados.php">Volver</a>
					</div>
					<div class="col input-group form-group">
						<button type="submit" class="btn btn-primary" id="boton" name="boton" >Enviar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<!--validaciones amarchivo-->
<script defer type="text/javascript" src="../js/validacion-amarchivo.js"></script>

<!--jquery-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!--jquery validation-->
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>

<!--Llamada al editor-->
<script>
	ClassicEditor
	.create( document.querySelector( '#editor' ) )
	.catch( error => {
		console.error( error );
	} );

</script>

<?php

include_once("../estructura/pie.php");
?>