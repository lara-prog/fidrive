<?php
include_once("../estructura/cabecera.php");
//$sesion = new Session();
if($sesion->sesionActiva()&&$sesion->validar()) {
	$sesion->cerrarSesion();
}
?>