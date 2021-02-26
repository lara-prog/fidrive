<?php
class UsuarioRol {
	private $idusuario;
	private $idrol;
	private $mensajeoperacion;

	public function __construct(){
		$this->idusuario = "";
		$this->idrol = "";
		$this->mensajeoperacion = "";
	}

//METODOS SETS
	public function setear ($idusuario, $idrol){
		$this->setIdUsuario($idusuario);
		$this->setIdRol($idrol);
	}

	public function setIdUsuario($idusuario){
		$this->idusuario = $idusuario;
	}

	public function setIdRol($idrol){
		$this->idrol = $idrol;
	}

	public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

//METODOS GETS
	public function getIdUsuario(){
		return $this->idusuario;
	}

	public function getIdRol(){
		return $this->idrol;
	}

	public function getmensajeoperacion(){
		return $this->mensajeoperacion;
	}

//CONSULTAS A BBDD
	public function cargar(){
		$resp = false;
		$base=new BaseDatos();
		$idusuario = $this->getIdUsuario();
		$idrol = $this->getIdRol();
		$sql="SELECT * FROM usuariorol WHERE idusuario = '$idusuario' AND idrol = '$idrol'";
		if ($base->Iniciar()) {
			$res = $base->Ejecutar($sql);
			if($res>-1){
				if($res>0){
					$row = $base->Registro();
					$this->setear($row['idusuario'], $row['idrol']);
				}
			}
		} else {
			$this->setmensajeoperacion("UsuarioRol->listar: ".$base->getError());
		}
		return $resp;
	}

	public function listar($condicion="", $limite=""){
		$arregloUsuarioRol = array();
		$base = new BaseDatos();
		$sql="SELECT * FROM usuariorol ";
		if ($condicion!=""){
			$sql=$sql.' where '.$condicion;
		}
		if($limite!=""){
			$sql.=" limit $limite";
		}
		//echo "\n".$sql;
		$res = $base->Ejecutar($sql);
		if($res>-1){
			if($res>0){

				while ($row = $base->Registro()){
					$obj= new UsuarioRol();

					$usuario = new Usuario();
					$usuario->setId($row['idusuario']);
					$usuario->cargar();

					$rol = new Rol();
					$rol->setId($row['idrol']);
					$rol->cargar();

					$obj->setear($usuario, $rol);;
					array_push($arregloUsuarioRol, $obj);
				}
			}
		} else {
			$this->setmensajeoperacion("UsuarioRol->listar: ".$base->getError());
		}
		return $arregloUsuarioRol;
	}

	public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$idusuario = $this->getIdUsuario();
		$idrol = $this->getIdRol();
		$sql= "INSERT INTO usuariorol(idusuario, idrol) VALUES ('$idusuario', '$idrol')";

		if($base->Iniciar()){
			if ($elid = $base->Ejecutar($sql)) {
				//$this->setId($elid);
				$resp = true;
			} else {
				$this->setmensajeoperacion("UsuarioRol->insertar: ".$base->getError());
			}
		} else {
			$this->setmensajeoperacion("UsuarioRol->insertar: ".$base->getError());
		}

		return $resp;
	}

	public function modificar(){
		$resp =false;
		$base=new BaseDatos();
		$idusuario = $this->getIdUsuario();
		$idrol = $this->getIdRol();

		$sql= "UPDATE usuariorol SET idusuario = '$idusuario', idrol = '$idrol' WHERE idusuario = '$idusuario' AND idrol = '$idrol'" ;
		if($base->Iniciar()){
			if($base->Ejecutar($sql)){
				$resp=  true;
			}else{
				$this->setmensajeoperacion("UsuarioRol->modificar: ".$base->getError());

			}
		}else{
			$this->setmensajeoperacion("UsuarioRol->modificar: ".$base->getError());

		}
		return $resp;
	}

	public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		$idusuario = $this->getIdUsuario();
		$idrol = $this->getIdRol();
		if($base->Iniciar()){
			$sql="DELETE FROM usuariorol WHERE idusuario = '$idusuario' AND idrol = '$idrol'" ;
			if($base->Ejecutar($sql)){
				$resp=  true;
			}else{
				$this->setmensajeoperacion("UsuarioRol->eliminar: ".$base->getError());
			}
		}else{
			$this->setmensajeoperacion("UsuarioRol->eliminar: ".$base->getError());
		}
		return $resp;
	}
}
?>