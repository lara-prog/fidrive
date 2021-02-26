<?php
$titulo = "contenido";
include_once("../estructura/cabecera.php");
if(!$sesion->esAdmin()){
	header("Location:paginaprincipal.php");
}
$arreglo_usuarios=array();
if(class_exists('AbmUsuario')){
	$objUsuarios = new AbmUsuario();
	$arreglo_usuarios = $objUsuarios->filtrarNoBorrados();
	//print_r($arreglo_usuarios);
}

?>
<div class="row d-flex justify-content-center px-md-4 m-5 ">
	<div class="col-sm-12 justify-content-center">
		<div class="card" style="width: 1050px;">
			<div class="card-body">
				<div class="row">
					<h2 class="card-title col">Usuarios Registrados</h2>
					<div class="col">
						<form method="POST" action="registro.php">

							<button type="submit" class="btn btn-outline-info mx-1" id="boton" name="boton">Nuevo Usuario</button>
						</form>
					</div>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Nombre</th>
							<th scope="col">Apellido</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($arreglo_usuarios as $usuario): ?>
							<tr>
								<th scope="row"><?= $usuario->getNombre() ?></th>
								<th scope="row"><?= $usuario->getApellido() ?></th>
								<td class="container float-right">
									<div class="row align-items">
										<form method="POST" action="vermasusuario.php">
											<input type="hidden" id="idusuario" name="idusuario" value="<?=$usuario->getId() ?>">
											<button type="submit" class="btn btn-outline-success mx-1" id="boton" name="boton">Ver Más</button>
										</form>

										<form method="POST" action="agregarrol.php" >
											<input type="hidden" id="idusuario" name="idusuario" value="<?=$usuario->getId() ?>">
											<input type="hidden"  id="accion" name="accion" value="2">
											<button type="submit" class="btn btn-outline-info mx-1" id="boton" name="boton">Agregar Rol</button>
										</form>


										<form method="POST" action="accionusuarios.php" >
											<input type="hidden" id="idusuario" name="idusuario" value="<?=$usuario->getId() ?>">
											<input type="hidden"  id="accion" name="accion" value="3">
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