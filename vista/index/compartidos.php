<?php
$titulo = "compartidos";
include_once("../estructura/cabecera.php");
//include_once("../../configuracion.php");
$arreglo_archivos=array();
if(class_exists('AbmArchivoCargadoEstado')){
	$objArchivoCargadoEstado = new AbmArchivoCargadoEstado();
	$idusuario = $sesion->getIdUsuario();
	$arreglo_archivos = $objArchivoCargadoEstado ->filtrarCompartidosDeUsuario($idusuario);
}
?>

<div class="row d-flex justify-content-center px-md-4 m-5">
	<div class="col-sm-12 justify-content-center">
		<div class="card" style="width: 1050px;">
			<div class="card-body">
				<div class="row">
					<h2 class="card-title col">Archivos Compartidos</h2>
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
											<input type="hidden" name="idusuario" id="idusuario" value="<?=$archivo->getUsuario()->getId()?>">
											<button type="submit" class="btn btn-outline-info mx-1" id="boton" name="boton">Modificar</button>
										</form>

										<form method="POST" action="eliminararchivocompartido.php" >
											<input type="hidden" name="idarchivocargado" id="idarchivocargado" value="<?=$archivo->getIdArchivo()->getId()?>">
											<input type="hidden" name="idusuario" id="idusuario" value="<?=$archivo->getUsuario()->getId()?>">
											<button type="submit" class="btn btn-outline-warning mx-1" id="boton" name="boton">Dejar de Compartir</button>
										</form>

										<form method="POST" action="eliminararchivo.php" >
											<input type="hidden" name="idarchivocargado" id="idarchivocargado" value="<?=$archivo->getIdArchivo()->getId()?>">
											<input type="hidden" name="idusuario" id="idusuario" value="<?=$archivo->getUsuario()->getId()?>">
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

<!--validaciones contenido-->
<script defer type="text/javascript" src="../js/validacion-contenido.js"></script>

<?php
include_once("../estructura/pie.php");
?>