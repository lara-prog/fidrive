<?php
class Usuario {
	private $idusuario;
	private $usnombre;
	private $usapellido;
	private $uslogin;
	private $usclave;
	private $usactivo;
	private $mensajeoperacion;

	public function __construct(){
		$this->idusuario = "";
		$this->usnombre = "";
		$this->usapellido = "";
		$this->uslogin = "";
		$this->usclave = "";
		$this->usactivo = "";
		$this->mensajeoperacion ="";
	}

//METODOS SETS
	public function setear($id, $nombre, $apellido, $login, $clave, $activo){
		$this->setId($id);
		$this->setNombre($nombre);
		$this->setApellido($apellido);
		$this->setLogin($login);
		$this->setClave($clave);
		$this->setActivo($activo);
	}

	public function setId($id){
		$this->idusuario = $id;
	}

	public function setNombre($nombre){
		$this->usnombre = $nombre;
	}

	public function setApellido($apellido){
		$this->apellido = $apellido;
	}

	public function setLogin($login){
		$this->uslogin = $login;
	}

	public function setClave($clave){
		$this->usclave = $clave;
	}

	public function setActivo($activo){
		$this->usactivo = $activo;
	}

	public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

//METODOS GETS
	public function getId(){
		return $this->idusuario;
	}

	public function getNombre(){
		return $this->usnombre;
	}

	public function getApellido(){
		return $this->apellido;
	}

	public function getLogin(){
		return $this->uslogin;
	}

	public function getClave(){
		return $this->usclave;
	}

	public function getActivo(){
		return $this->usactivo;
	}

	public function getmensajeoperacion(){
		return $this->mensajeoperacion ;
	}

//CONSULTAS A BBDD
	public function cargar(){
		$resp = false;
		$base=new BaseDatos();
		$sql="SELECT * FROM usuario WHERE idusuario = ".$this->getId();
		if ($base->Iniciar()) {
			$res = $base->Ejecutar($sql);
			if($res>-1){
				if($res>0){
					$row = $base->Registro();
					$this->setear($row['idusuario'], $row['usnombre'], $row['usapellido'], $row['uslogin'], $row['usclave'], $row['usactivo']);
				}
			}
		} else {
			$this->setmensajeoperacion("usuario->listar: ".$base->getError());
		}
		return $resp;
	}

	public function listar($condicion="", $limite=""){
		//echo "\nCONDICION EN LISTAR: ".$condicion;
		//echo "\nLIMITE EN LISTAR: ".$limite;
		$arregloUsuario = array();
		$base = new BaseDatos();
		$sql="SELECT * FROM usuario ";
		if ($condicion!=""){
			$sql=$sql.' where '.$condicion;
		}
		if($limite!=""){
			$sql.=" limit $limite";
		}
		//echo "\nSQL EN LISTAR: ".$sql."\n\n";
		//echo "\n".$sql;
		$res = $base->Ejecutar($sql);
		if($res>-1){
			if($res>0){
				while ($row = $base->Registro()){
					$obj= new Usuario();
					$obj->setear($row['idusuario'], $row['usnombre'], $row['usapellido'], $row['uslogin'], $row['usclave'], $row['usactivo']);
					array_push($arregloUsuario, $obj);
				}
			}
		} else {
			$this->setmensajeoperacion("Usuario->listar: ".$base->getError());
		}
		return $arregloUsuario;
	}

	public function insertar(){
		$base=new BaseDatos();
		$resp= false;

		$nombre = $this->getNombre();
		$apellido = $this->getApellido();
		$login=$this->getLogin();
		$clave = $this->getClave();
		$activo = $this->getActivo();

		$sql= "INSERT INTO usuario(usnombre, usapellido, uslogin, usclave, usactivo)
		VALUES ('$nombre', '$apellido', '$login', '$clave', '$activo')";

		if($base->Iniciar()){
			if ($elid = $base->Ejecutar($sql)) {
				$this->setId($elid);
				$resp = true;
			} else {
				$this->setmensajeoperacion("Usuario->insertar: ".$base->getError());
			}
		} else {
			$this->setmensajeoperacion("Usuario->insertar: ".$base->getError());
		}

		return $resp;
	}

	public function modificar(){
		$resp =false;
		$base=new BaseDatos();
		$id = $this->getId();
		$nombre = $this->getNombre();
		$apellido = $this->getApellido();
		$login=$this->getLogin();
		$clave = $this->getClave();
		$activo = $this->getActivo();

		$sql= "UPDATE usuario SET usnombre = '$nombre', usapellido = '$apellido', uslogin = '$login', usclave = '$clave', usactivo = '$activo' WHERE idusuario = '$id'" ;

		if($base->Iniciar()){
			if($base->Ejecutar($sql)){
				$resp=  true;
			}else{
				$this->setmensajeoperacion("Usuario->modificar: ".$base->getError());

			}
		}else{
			$this->setmensajeoperacion("Usuario->modificar: ".$base->getError());

		}
		return $resp;
	}

	public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		$id = $this->getId();
		if($base->Iniciar()){
			$sql="DELETE FROM usuario WHERE idusuario = '$id'" ;
			if($base->Ejecutar($sql)){
				$resp=  true;
			}else{
				$this->setmensajeoperacion("Usuario->eliminar: ".$base->getError());

			}
		}else{
			$this->setmensajeoperacion("Usuario->eliminar: ".$base->getError());

		}
		return $resp;
	}






}
?>