<?php
$titulo = "roles";
include_once("../estructura/cabecera.php");
if(!$sesion->esAdmin()){
	header("Location:paginaprincipal.php");
}
$arreglo_roles=array();
if(class_exists('AbmRol')){
	$objRoles = new AbmRol();
	$arreglo_roles = $objRoles->buscar(null);
	//print_r($arreglo_usuarios);
}

?>
<div class="row d-flex justify-content-center px-md-4 m-5 ">
	<div class="col-sm-12 justify-content-center">
		<div class="card" style="width: 600px;">
			<div class="card-body">
				<div class="row">
					<h2 class="card-title col">Roles</h2>
					<div class="col">
						<form method="POST" action="crearroles.php">

							<button type="submit" class="btn btn-outline-info mx-1" id="boton" name="boton">Agregar Rol</button>
						</form>
					</div>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">ID Rol</th>
							<th scope="col">Detalle</th>

						</tr>
					</thead>
					<tbody>
						<?php foreach ($arreglo_roles as $rol): ?>
							<tr>
								<th scope="row"><?= $rol->getId() ?></th>
								<th scope="row"><?= $rol->getDescripcion() ?></th>

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