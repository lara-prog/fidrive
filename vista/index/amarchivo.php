<?php
$titulo = "amarchivo";
//include_once("../../configuracion.php");
include_once("../estructura/cabecera.php");
//recupero los usuarios
//$objUsuario = new AbmUsuario();
//$listaUsuarios = $objUsuario -> buscar(null);
//$listaUsuarios = $objUsuario -> filtrarNoBorrados();


//recupero los datos que vienen del boton modificar
$usuario="";
$datos = data_submitted();
$id = $datos['idusuario'];
$objUsuario = new AbmUsuario();
$condicion = "idusuario = '".$id."'";
$usuarios = $objUsuario->buscarCondicion($condicion);
if(count($usuarios)!=0){
	$usuario = $usuarios[0];
	$archivoModificar = "";
	$icono="";
	$nombreArchivo = "Elija un archivo";
	$idArchivo ="";
	if(!empty($datos)){
		if(isset($datos['clave'])){
			$clave = $datos['clave'];
		}
		if(isset($datos['idarchivocargado'])){
		//busco el archivo y recupero el nombre, el id
		//y el icono para mostrarlo en formulario y mandar al accion
			$id = $datos['idarchivocargado'];
			$condicion = "idarchivocargado = ".$id;
			$objAbmArchivoCargado = new AbmArchivoCargado();
			$archivoLista=$objAbmArchivoCargado->buscarCondicion($condicion);
			if(count($archivoLista)!=0){
				$archivoModificar = $archivoLista[0];
				$nombreArchivo = $archivoModificar->getNombre();
				$idArchivo = $archivoModificar->getId();
				$icono = $archivoModificar->getIcono();
			}
		}
	}

}


?>
<div class="d-flex justify-content-center h-100">
	<div class="card m-3">
		<div class="card-header mx-auto">
			<h2>Subir/Modificar Archivo</h2>
		</div>
		<div class="card-body justify-content-center">
			<form class="needs-validation" novalidate id="amarchivo" name="amarchivo" method="POST" action="accion.php" data-toggle="validator" enctype="multipart/form-data">

				<!--Archivo-->
				<div class="input-group form-group">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="archivo" name="archivo" lang="es"
						value="<?= $nombreArchivo?>">
						<label class="custom-file-label" for="inputGroupFile01"><?= $nombreArchivo?></label>
					</div>
				</div>

				<div class="input-group form-group">
					<!--NOMBRE DE ARCHIVO-->
					<label for="nombre" class="col-form-label">Nombre de archivo: </label>
					<div class="input-group form-group">
						<input type="text" readonly name="acnombre" id="acnombre" placeholder="" class="form-control"  value="<?= $nombreArchivo?>">
					</div>
					<!--USUARIOS-->
					<label for="usuario" class="col-form-label">Usuario:</label>
					<div class="input-group form-group">
						<input type="text" readonly name="us" id="us" value="<?= $usuario->getNombre()." ".$usuario->getApellido()?>" style="width: 100%">
						<input type="hidden" name="idusuario" id="idusuario" value="<?=$usuario->getId()?>">

					</div>

					<!--ICONOS-->
					<label for="icon" class="col-form-label">Seleccionar Icono que se va a utilizar:</label>
					<div class="input-group form-group">
						<div class="form-check form-check-inline">
							<input type="radio" id="zip" name="acicono" value=".zip" class="form-check-input" <?php if($icono!=""&&($icono==".zip")):?>checked=' <? = echo "checked"?>  <?php endif; ?>' required><br>
							<i class="fas fa-file-archive"></i>
							<label for="zip" class="form-check-label">.zip</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" id="pdf" name="acicono" value=".pdf" class="form-check-input" <?php if($icono!=""&&($icono==".pdf")):?>checked=' <? = echo "checked"?>  <?php endif; ?>' required><br>
							<i class="fas fa-file-pdf"></i>
							<label for="pdf" class="form-check-label">.pdf</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" id="doc" name="acicono" value=".doc" class="form-check-input" <?php if($icono!=""&&($icono==".doc")):?>checked=' <? = echo "checked"?>  <?php endif; ?>' required><br>
							<i class="fas fa-file" ></i>
							<label for="doc" class="form-check-label">.doc</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" id="img" name="acicono" value=".img" class="form-check-input" <?php if($icono!=""&&($icono==".img")):?>checked=' <? = echo "checked"?>  <?php endif; ?>' required><br>
							<i class="fas fa-file-image"></i>
							<label for="img" class="form-check-label">.img</label>
						</div>
					</div>
					<label id="icono_mensaje_error" class="sin_error" aria-live="polite"> </label>
					<!--DESCRIPCION-->

				</div>
				<div class="form-group">
					<label for="descripcion" class="col-form-label">Descripción del archivo: </label>
					<textarea id="editor" name="acdescripcion" class="form-control" placeholder="Esta es una descripción genérica, si lo necesita la puede cambiar." >
					</textarea>
					<!--<div id="editor" name="descripcion" class="form-control"><p></p></div>-->
				</div>

				<!--este input controla la accion a realizar con el archivo ingresado-->
				<input name="clave" id="clave" type="hidden" placeholder="" class="form-control" value="<?=$clave?>">

				<!--MANDA EL ID DEL ARCHIVO A MODIFICAR-->
				<input type="hidden" id="idarchivocargado" name="idarchivocargado" class="form-control" value="<?= $idArchivo ?>">

				<!--BOTONES-->
				<div class="btn-toolbar " role="toolbar" aria-label="" style="display: flex; justify-content: center;">
					<div class="btn-group mr-2" role="group" aria-label="">
						<button type="reset" class="btn btn-danger" id="boton_borrar" name="boton_borrar" style="width: 100px;">Borrar</button>
					</div>
					<div class="btn-group mr-2" role="group" aria-label="">
						<a role="button" class="btn btn-secondary" id="boton" name="boton" href="contenido.php" style="width: 100px;">Volver</a>
					</div>
					<div class="btn-group mr-2" role="group" aria-label="">
						<button type="submit" class="btn btn-primary" id="boton" name="boton" style="width: 100px;">Enviar</button>
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