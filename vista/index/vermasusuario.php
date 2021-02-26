<?php
$titulo = "contenido";
include_once("../estructura/cabecera.php");
//include_once("../../configuracion.php");
?>
<?php
if(!$sesion->esAdmin()){
	header("Location:paginaprincipal.php");
}
$datos = data_submitted();
$objAbmUsuarios = new AbmUsuario();
$condicion = "idusuario = ".$datos['idusuario'];
$usuarios = $objAbmUsuarios->buscarCondicion($condicion);
if(count($usuarios)!=0){
	$usuario = $usuarios[0];
	$objAbmUsuariosRol = new AbmUsuarioRol();
	$usuarioRoles=$objAbmUsuariosRol->buscarCondicion($condicion);
}


?>
<div class="row d-flex justify-content-center px-md-4 m-5 ">
	<div class="col-sm-12 justify-content-center">
		<div class="card" style="width: 1050px;">
			<div class="card-body">
				<div class="row">
					<h2 class="card-title col">Detalle de Usuario</h2>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Nombre</th>
							<th scope="col">Apellido</th>
							<th scope="col">Login</th>
							<th scope="col"></th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row"><?= $usuario->getId() ?></th>
							<th scope="row"><?= $usuario->getNombre() ?></th>
							<th scope="row"><?= $usuario->getApellido() ?></th>
							<th scope="row"><?= $usuario->getLogin() ?></th>
							<th scope="row">
								<div class="btn-group">
									<button class="btn btn btn-dark btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Roles Actuales
									</button>
									<div class="dropdown-menu">
										<?php foreach ($usuarioRoles as $rol): ?>
											<a class="dropdown-item" href="#"><?= $rol->getIdRol()->getDescripcion() ?></a>
										<?php endforeach; ?>
									</div>
								</div>

							</th>
							<td class="container float-right">
								<div class="row align-items">
									<a role="button" href="usuariosregistrados.php" class="btn btn-primary" >Volver</a>
								</div>
							</td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<?php

include_once("../estructura/pie.php");
?>