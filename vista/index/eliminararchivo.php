<?php
//include_once("../../configuracion.php");
$titulo = "eliminararchivo";
include_once("../estructura/cabecera.php");
//busco los usuarios de la base de datos
//$objUsuario = new AbmUsuario();
//$listaUsuarios = $objUsuario -> buscar(null);
//compartir archivo
$datos = data_submitted();
$id = $datos['idusuario'];
$objUsuario = new AbmUsuario();
$condicion = "idusuario = '".$id."'";
$usuarios = $objUsuario->buscarCondicion($condicion);
if(count($usuarios)!=0){
	$usuario = $usuarios[0];
	if(!empty($datos)){
		if(isset($datos['idarchivocargado'])){
	//busco el archivo y recupero el nombre, el id
	//para mostrarlo en formulario y mandar al accion
			$id = $datos['idarchivocargado'];
			$condicion = "idarchivocargado = ".$id;
			$objAbmArchivoCargado = new AbmArchivoCargado();
			$archivoLista=$objAbmArchivoCargado->buscarCondicion($condicion);
			if(count($archivoLista)!=0){
				$archivoModificar = $archivoLista[0];
				$nombreArchivo = $archivoModificar->getNombre();
				$idArchivo = $archivoModificar->getId();
			}

		}
	}
}
?>
<div class="d-flex justify-content-center h-100">
	<div class="card m-3">
		<div class="card-header mx-auto">
			<h2>Eliminar Archivo</h2>
		</div>
		<div class="card-body justify-content-center">
			<form class="need-validation" novalidate id="eliminararchivo" name="eliminararchivo" method="POST" action="accion.php" data-toggle="validator">

				<div class="input-group form-group">
					<!--NOMBRE DE ARCHIVO-->
					<label for="nombre" class="col-form-label">Nombre de archivo: </label>
					<div class="input-group form-group">
						<input type="text" readonly="readonly" name="acnombre" id="acnombre" placeholder="" class="form-control"  value="<?= $nombreArchivo?>">
					</div>
				</div>

				<!--USUARIOS ACE-->
				<div class="form-group ">
					<label for="usuario" class="col-form-label">Usuario:</label>
					<div class="input-group form-group form-inline">
						<input type="text" readonly name="usuario" id="usuario" value="<?= $usuario->getNombre()." ".$usuario->getApellido()?>" style="width: 100%">
						<input type="hidden" name="usuario_ACE" id="usuario_ACE" value="<?=$usuario->getId()?>">
					</div>
				</div>

				<!--DESCRIPCION ACE-->
				<div class="form-group">
					<label for="descripcion" class="col-form-label">Describa el motivo de eliminación: </label>
					<textarea id="editor" id="acedescripcion" name="acedescripcion" class="form-control" placeholder="Esta es una descripción genérica, si lo necesita la puede cambiar." required>
					</textarea>
					<label id="descripcion_mensaje_error" class="sin_error" aria-live="polite" ></label>
					<!--<div id="editor" name="descripcion" class="form-control"><p></p></div>-->
				</div>

				<!--MANDA EL ID DEL ARCHIVO A MODIFICAR-->
				<input type="hidden" id="idarchivocargado" name="idarchivocargado" class="form-control" value="<?= $idArchivo ?>">

				<!--MANDA LA ACCION A REALIZAR-->
				<input type="hidden" name="clave" id="clave" class="form-control" value="4">

				<!--BOTONES-->
				<div class="row align-items float-right mx-auto">
					<div class="col input-group form-group">
						<button type="reset" class="btn btn-danger" id="boton_borrar" name="boton_borrar" >Borrar</button>
					</div>
					<div class="col input-group form-group">
						<a role="button" class="btn btn-secondary" id="boton_volver" name="boton_volver" href="contenido.php">Volver</a>

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
<script defer type="text/javascript" src="../js/validacion-eliminararchivo.js"></script>

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
</body>
<?php

include_once("../estructura/pie.php");
?>