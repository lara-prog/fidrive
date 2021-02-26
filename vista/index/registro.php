<?php
$titulo = "login";
//include_once("../../configuracion.php");
include_once("../estructura/cabecera_login.php");

?>
<body>
	<div class="container">
		<div class="d-flex justify-content-center h-100">
			<div class="card" id="registro">
				<div class="card-header mx-auto">
					<h2>REGISTRARSE</h2>
				</div>
				<div class="card-body">
					<form id="registro" name="registro" method="POST" action="accionusuarios.php" class="was-validated" novalidate>
						<div class="form-group">
							<label for="validationCustom01">Ingrese su nombre: </label>
							<div class="input-group form-group">
								<input type="text" class="form-control" name="usnombre" id="usnombre" required>
							</div>
						</div>
						<div class="form-group">
							<label for="validationCustom02">Ingrese su apellido: </label>
							<div class="input-group form-group">
								<input type="text" class="form-control" name="usapellido" id="usapellido" required>
							</div>
						</div>
						<div class="form-group">
							<label for="validationCustom03">Ingrese su nick: </label>
							<div class="input-group form-group">
								<input type="text" class="form-control" name="uslogin" id="uslogin" required>
							</div>
						</div>
						<div class="form-group">
							<label for="validationCustom04">Ingrese su password: </label>
							<div class="input-group form-group">
								<input type="password" class="form-control"  name="usclave" id="usclave" onchange="md5pass();" required>
							</div>
							<div style="position: absolute; z-index: 4; left: 410px; top: 385px; width: 300px; height: 35px;">
								<label id="pass_mensaje_error" class="sin_error" aria-live="polite"></label>
							</div>
						</div>

						<div class="btn-toolbar " role="toolbar" aria-label="" style="display: flex; justify-content: center;">
							<div class="btn-group mr-2" role="group" aria-label="">
								<?php if(!$sesion->sesionActiva()||!$sesion->validar()) {
									echo '<a role="button" class="btn btn-secondary" id="" name="" href="login.php" style="width: 170px;">Volver</a>';
								} else {
									echo'<a role="button" class="btn btn-secondary" id="" name="" href="usuariosregistrados.php" style="width: 170px;">Volver</a>';
								}
								?>
							</div>
							<div class="btn-group mr-2" role="group" aria-label="Second group">
								<button type="submit" class="btn login_btn" id="boton" name="boton" style="width: 170px;">Enviar</button>
							</div>
						</div>
						<input type="hidden" id="usactivo" name="usactivo" value="1">
						<input type="hidden" id="accion" name="accion" value="1">
					</form>
				</div>

			</div>
		</div>
	</div>
	<!--validaciones registr-->

	<script defer type="text/javascript" src="../js/validacion-registro.js"></script>

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<!--jquery validation-->
	-<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>
	<script type="text/javascript">
	window.onload = function(){
		document.getElementById('boton').disabled=true;
	}
	</script>


	<?php

	include_once("../estructura/pie.php");
	?>