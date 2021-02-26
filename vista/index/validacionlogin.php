<?php
//include_once("../../configuracion.php");
include_once("../estructura/cabecera_login.php");
$Titulo = "accion";

$datos = data_submitted();
//print_r($datos);
$uslogin = $datos['uslogin'];
$usclave = $datos['usclave'];
$objusuario = new AbmUsuario();
$condicion = "uslogin = '" .$uslogin."' AND usclave = '".$usclave."'";
//$condicion = "usclave =".$usclave;
//$usuario = $objusuario->buscar($datos);
$usuarios = $objusuario->buscarCondicion($condicion);

//print_r($usuario);
if(count($usuarios)!=0){
	//id del usuario
	$usuario = $usuarios[0];
	$id = $usuario->getId();
	//login del usuario
	$login = $usuario->getLogin();
	$usuariorol = new AbmUsuarioRol();
	$esAdmin = $usuariorol->esAdmin($id);
	$sesion = new Session();
	if($esAdmin){
		$realizado = $sesion->iniciar($id, $login, "administrador");
	}
	else {
		$realizado = $sesion->iniciar($id, $login, "otro usuario");
	}
	header("Location:paginaprincipal.php");

} else {
		header("Location:login.php");
}
?>