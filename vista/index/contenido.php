<?php
$titulo = "contenido";
include_once("../estructura/cabecera.php");

$arreglo_archivos=array();
$archivo = "";
$idusuario = $sesion->getIdUsuario();
$objusuario = new AbmUsuario();
$condicion = "idusuario = '".$idusuario."'";
$usuarios = $objusuario->buscarCondicion($condicion);
if(count($usuarios)!=0){
	$usuario=$usuarios[0];
	if(class_exists('AbmArchivoCargadoEstado')){
		$objArchivoCargadoEstado = new AbmArchivoCargadoEstado();

		$arreglo_archivos = $objArchivoCargadoEstado->filtrarNoBorradosDeUsuario($idusuario);
		if(count($arreglo_archivos)!=0){
			$archivo = $arreglo_archivos[0];
	//print_r($arreglo_archivos);
		}

	}
}


?>
<div class="row d-flex justify-content-center px-md-4 m-5 ">
	<div class="col-sm-12 justify-content-center">
		<div class="card" style="width: 1050px;">
			<div class="card-body">
				<div class="row">
					<h2 class="card-title col">Contenido de Archivos</h2>
					<div class="col">
						<form method="POST" action="amarchivo.php">
							<input type="hidden" name="clave" value="0">
							<input type="hidden" name="idarchivocargado" id="idarchivocargado" value="">
							<input type="hidden" name="idusuario" id="idusuario" value="<?=$usuario->getId()?>">
							<button type="submit" class="btn btn-info mx-1" id="boton" name="boton">Subir Archivo</button>
						</form>
					</div>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Nombre</th>
							<th scope="col">Estado</th>
							<th scope="col">Usuario</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($arreglo_archivos as $archivo): ?>
							<tr>
								<th scope="row"><?= $archivo->getIdArchivo()->getNombre() ?></th>
								<td><?= $archivo->getIdTipos()->getDescripcion()?></td>
								<td><?= $archivo->getUsuario()->getNombre()." ".$archivo->getUsuario()->getApellido()?></td>
								<td class="container float-right">
									<div class="row align-items">
										<form method="POST" action="amarchivo.php" >
											<input type="hidden" name="clave" value="1">
											<input type="hidden" name="idarchivocargado" id="idarchivocargado" value="<?=$archivo->getIdArchivo()->getId()?>">
											<input type="hidden" name="idusuario" id="idusuario" value="<?=$usuario->getId() ?>">
											<button type="submit" class="btn btn-outline-info mx-1" id="boton" name="boton">Modificar</button>
										</form>

										<form method="POST" action="compartirarchivo.php" >
											<input type="hidden" name="idarchivocargado" id="idarchivocargado" value="<?=$archivo->getIdArchivo()->getId()?>">
											<input type="hidden" name="idusuario" id="idusuario" value="<?=$usuario->getId() ?>">
											<button type="submit" class="btn btn-outline-success mx-1" id="boton" name="boton">Compartir</button>
										</form>

										<form method="POST" action="eliminararchivo.php" >
											<input type="hidden" name="idarchivocargado" id="idarchivocargado" value="<?=$archivo->getIdArchivo()->getId()?>">
											<input type="hidden" name="idusuario" id="idusuario" value="<?=$usuario->getId() ?>">
											<button type="submit" class="btn btn-outline-danger mx-1" id="boton" name="boton">Eliminar</button>
										</form>

									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php

include_once("../estructura/pie.php");
?>