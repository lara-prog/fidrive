<?php
$titulo = "login";
//include_once("../../configuracion.php");
include_once("../estructura/cabecera_login.php");
//echo $_SERVER['REQUEST_URI'];
//print_r($_SESSION);
?>

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header mx-auto">
				<h2>BIENVENIDO A FIDRIVE</h2>
			</div>
			<div class="card-body">
				<form name="login" id="login" method="POST" action="validacionlogin.php">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="usuario" name="uslogin" id="uslogin" required>
						<label id="usuario_mensaje_error" class="sin_error" aria-live="polite" ></label>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name="usclave" id="usclave" required onchange="md5pass();">
						<label id="contrasena_mensaje_error" class="sin_error" aria-live="polite" ></label>
					</div>
					<div class="form-group justify-content-center">
						<input type="submit" value="Enviar" class="btn btn-block login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					¿No estás registrado?<a href="registro.php">Registrarse</a>
				</div>
			</div>
		</div>
	</div>
</div>


<!--validaciones amarchivo-->
<!--<script defer type="text/javascript" src="../js/validacion-login.js"></script>-->

<!--jquery-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!--jquery validation-->
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>


<?php

include_once("../estructura/pie.php");
?>