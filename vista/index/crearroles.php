<?php
$titulo = "amarchivo";
//include_once("../../configuracion.php");
include_once("../estructura/cabecera.php");

?>
<div class="d-flex justify-content-center h-100">
	<div class="card m-3">
		<div class="card-header mx-auto">
			<h2>Crear Rol</h2>
		</div>
		<div class="card-body justify-content-center">
			<form class="needs-validation" novalidate id="rol" name="rol" method="POST" action="accionusuarios.php" data-toggle="validator" enctype="multipart/form-data">

				<div class="input-group form-group">
					<!--NOMBRE DE ARCHIVO-->
					<label for="nombre" class="col-form-label">Ingrese nuevo rol: </label>
					<div class="input-group form-group">
						<input type="text" name="rodescripcion" id="rodescripcion" class="form-control" required>
						<label id="rol_mensaje_error" class="sin_error" aria-live="polite" ></label>
					</div>

					<!--este input controla la accion a realizar con el archivo ingresado-->
					<input  id="accion" name="accion" value="4" type="hidden" class="form-control">

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


	<!--validaciones roles-->
	<script defer type="text/javascript" src="../js/validacion-rol.js"></script>

	<!--jquery-->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<!--jquery validation-->
	<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>

	<?php

	include_once("../estructura/pie.php");
	?>