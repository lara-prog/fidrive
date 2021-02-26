<?php
$titulo = "compartirarchivo";
//include_once("../../configuracion.php");
include_once("../estructura/cabecera.php");
//busco los usuarios de la base de datos
//$objUsuario = new AbmUsuario();
//$listaUsuarios = $objUsuario -> buscar(null);
//$listaUsuarios = $objUsuario -> filtrarNoBorrados();
//compartir archivo
$datos = data_submitted();
$id = $datos['idusuario'];
$objUsuario = new AbmUsuario();
$condicion = "idusuario = '".$id."'";
$usuarios = $objUsuario->buscarCondicion($condicion);
if(count($usuarios)!=0){
	$usuario = $usuarios[0];
	if(!empty($datos)){
	//busco el archivo y recupero el nombre, el id
	//para mostrarlo en formulario y mandar al accion
		if(isset($datos['idarchivocargado'])){
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
	<div class="card m-3" >
		<div class="card-header mx-auto">
			<h2>Compartir Archivo</h2>
		</div>
		<div class="card-body justify-content-center">
			<form id="compartirarchivo" name="compartirarchivo" method="POST" data-toggle="validator" class="need-validation" novalidate action="accion.php">


				<!--NOMBRE DE ARCHIVO-->
				<div class="form-group">
					<label for="nombre" class="col-form-label">Nombre de archivo a compartir: </label>
					<div class="input-group form-group form-inline">
						<input type="text" readonly name="acnombre" id="acnombre" placeholder="" class="form-control"  value="<?= $nombreArchivo?>">
					</div>
				</div>

				<!--USUARIOS ACE-->
				<div class="form-group ">
					<label for="usuario" class="col-form-label">Usuario:</label>
					<div class="input-group form-group form-inline">
						<input type="text" readonly name="usuario" id="usuario" value="<?= $usuario->getNombre()." ".$usuario->getApellido()?>" style="width: 100%">
						<input type="hidden" name="usuarioACE" id="usuarioACE" value="<?=$usuario->getId()?>">
					</div>
				</div>


				<!--CANTIDAD DE DIAS QUE SE COMPARTIRA--->
				<div class=" row">
					<div class="form-group col">
						<label for="cantidaddias" class="col-form-label">Cantidad de dias a compartir: </label>
						<div class="input-group form-group form-inline">
							<input type="number" name="dias" id="dias" placeholder="" class="form-control"  value="<?= $nombreArchivo?>" required>
							<label id="dias_mensaje_error" class="sin_error" aria-live="polite" ></label>
						</div>
					</div>
					<div class="form-group col">
						<label for="cantidaddias" class="col-form-label">Cantidad de descargas posibles: </label>
						<div class="input-group form-group form-inline">
							<input type="number" name="accantidaddescarga" id="accantidaddescarga" placeholder="" class="form-control" required>
							<label id="cantidadDescargas_mensaje_error" class="sin_error" aria-live="polite" ></label>
						</div>
					</div>
				</div>

				<!--CANTIDAD DE veces QUE SE COMPARTIRA--->
				<!--<div class="form-group">
					<label for="cantidaddias" class="col-form-label">Cantidad de descargas posibles: </label>
					<div class="input-group form-group form-inline">
						<input type="number" name="accantidaddescarga" id="accantidaddescarga" placeholder="" class="form-control" required>
						<label id="cantidadDescargas_mensaje_error" class="sin_error" aria-live="polite" ></label>
					</div>
				</div>-->

				<!--SELECCIONAR SI NECESITA UNA CLAVE DE PROTECCION-->
				<div class="form-group">
					<label for="icon" class="col-form-label">Se debe proteger con contraseña:</label>
					<div class="input-group form-group">
						<div class="form-check form-check-inline">
							<input type="radio" id="sicheck" name="check" value="si" class="form-check-input" ><br>
							<label for="si" class="form-check-label">si</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" id="nocheck" name="check" value="no" class="form-check-input"><br>
							<label for="no" class="form-check-label">no</label>
						</div>
					</div>
				</div>
				<!--CLAVE DE PROTECCION-->
				<div class="form-group" style="display: none;" id="content">
					<label for="clave" class="col-form-label" >Clave del Archivo a compartir:</label>
					<div class="input-group form-group">
						<input type="password" name="acprotegidoclave" id="acprotegidoclave" placeholder="password" class="form-control"  required>
						<div>
							<label id="clave_mensaje_error" class="sin_error" aria-live="polite" ></label>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="clave" class="col-form-label" >Link para compartir archivo:</label>

					<div class="input-group form-group">
						<input type="text" readonly="readonly" name="aclinkacceso" id="aclinkacceso" class="form-control" required style="margin-right: 5px;">
						<label id="link_mensaje_error" class="sin_error" aria-live="polite" ></label>

						<div class="btn-group" role="group" aria-label="First group">
							<button type="button" class="btn btn-info mb-3" id="boton_link" name="boton_link" onclick="md5link();">Generar link</button>
						</div>
					</div>

				</div>

				<!--MANDA EL ID DEL ARCHIVO A MODIFICAR-->
				<input type="hidden" id="idarchivocargado" name="idarchivocargado" class="form-control" value="<?= $idArchivo ?>">

				<!--MANDA LA ACCION A REALIZAR-->
				<input type="hidden" name="clave" id="clave" class="form-control" value="2">

				<!--BOTONES-->
				<div class="btn-toolbar " role="toolbar" aria-label="" style="display: flex; justify-content: center;">
					<div class="btn-group mr-2" role="group" aria-label="">
						<button type="reset" class="btn btn-danger" id="boton_borrar" name="boton_borrar" style="width: 100px;">Borrar</button>
					</div>
					<div class="btn-group mr-2" role="group" aria-label="">
						<a role="button" class="btn btn-secondary" id="botonvolver" name="botonvolver" href="contenido.php" style="width: 100px;">Volver</a>
					</div>
					<div class="btn-group mr-2" role="group" aria-label="">
						<button type="submit" class="btn btn-primary" id="boton" name="boton" style="width: 100px;">Enviar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!--validaciones compartirarchivo-->
<script defer type="text/javascript" src="../js/validacion-compartirarchivo.js"></script>

<!--jquery-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!--jquery validation-->
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>

<script type="text/javascript">
	window.onload = function(){
		document.getElementById('boton').disabled=true;
	}
</script>


<?php

include_once("../estructura/pie.php");
?>