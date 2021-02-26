<?php
class ArchivoCargado {
	private $idarchivocargado;
	private $acnombre;
	private $acdescripcion;
	private $acicono;
	private $idusuario;
	private $aclinkacceso;
	private $accantidaddescarga;
	private $accantidadusada;
	private $acfechainiciocompartir;
	private $acfechafincompartir;
	private $acprotegidoclave;
	private $mensajeoperacion;

	public function __construct(){
		$this->idarchivocargado = "";
		$this->acnombre = "";
		$this->acdescripcion = "";
		$this->acicono = "";
		$this->idusuario = "";
		$this->aclinkacceso = "";
		$this->accantidaddescarga = "";
		$this->accantidadusada = "";
		$this->acfechainiciocompartir = "";
		$this->acfechafincompartir = "";
		$this->acprotegidoclave = "";
		$this->mensajeoperacion = "";
	}

//METODOS SETS
	public function setear($id, $nombre, $desc, $icono, $usuario, $link, $cantD, $cantU, $fechaI, $fechaF, $clave){
		$this->setId($id);
		$this->setNombre($nombre);
		$this->setDescripcion($desc);
		$this->setIcono($icono);
		$this->setUsuario($usuario);
		$this->setLink($link);
		$this->setCantDescarga($cantD);
		$this->setCantUsada($cantU);
		$this->setFechaInicio($fechaI);
		$this->setFechaFin($fechaF);
		$this->setClave($clave);
	}

	public function setId($id){
		$this->idarchivocargado = $id;
	}

	public function setNombre($nombre){
		$this->acnombre = $nombre;
	}

	public function setDescripcion($desc){
		$this->acdescripcion = $desc;
	}

	public function setIcono($icono){
		$this->acicono = $icono;
	}

	public function setUsuario($usuario){
		$this->idusuario = $usuario;
	}

	public function setLink($link){
		$this->aclinkacceso = $link;
	}

	public function setCantDescarga($cantD){
		$this->accantidaddescarga = $cantD;
	}

	public function setCantUsada($cantU){
		$this->accantidadusada = $cantU;
	}

	public function setFechaInicio($fechaI){
		$this->acfechainiciocompartir = $fechaI;
	}

	public function setFechaFin($fechaF){
		$this->acfechafincompartir = $fechaF;
	}

	public function setClave($clave){
		$this->acprotegidoclave = $clave;
	}

	public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

//METODOS GETS
	public function getId(){
		return $this->idarchivocargado;
	}

	public function getNombre(){
		return $this->acnombre;
	}

	public function getDescripcion(){
		return $this->acdescripcion;
	}

	public function getIcono(){
		return $this->acicono;
	}

	public function getUsuario(){
		return $this->idusuario;
	}

	public function getLink(){
		return $this->aclinkacceso;
	}

	public function getCantDescarga(){
		return $this->accantidaddescarga;
	}

	public function getCantUsada(){
		return $this->accantidadusada;
	}

	public function getFechaInicio(){
		return $this->acfechainiciocompartir;
	}

	public function getFechaFin(){
		return $this->acfechafincompartir;
	}

	public function getClave(){
		return $this->acprotegidoclave;
	}
	public function getmensajeoperacion(){
		return $this->mensajeoperacion;
	}

//CONSULTAS A LA BASE DE DATOS
	public function cargar(){
		$resp = false;
		$base=new BaseDatos();
		$sql="SELECT * FROM archivocargado WHERE idarchivocargado= ".$this->getId();
		if ($base->Iniciar()) {
			$res = $base->Ejecutar($sql);
			if($res>-1){
				if($res>0){
					$row = $base->Registro();
					$this->setear($row['idarchivocargado'], $row['acnombre'], $row['acdescripcion'], $row['acicono'], $row['idusuario'], $row['aclinkacceso'], $row['accantidaddescarga'], $row['accantidadusada'], $row['acfechainiciocompartir'], $row['acefechafincompartir'], $row['acprotegidoclave']);
				}
			}
		} else {
			$this->setmensajeoperacion("ArchivoCargado->listar: ".$base->getError());
		}
		return $resp;
	}

	public function listar($condicion="", $limite=""){
		$arregloArchivoCargado = array();
		$base = new BaseDatos();
		$sql="SELECT * FROM archivocargado ";
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
					$obj= new ArchivoCargado();
					$usuario = new Usuario();
					$usuario->setId($row['idusuario']);
					$usuario->cargar();

					$obj->setear($row['idarchivocargado'], $row['acnombre'], $row['acdescripcion'], $row['acicono'], $usuario, $row['aclinkacceso'], $row['accantidaddescarga'], $row['accantidadusada'], $row['acfechainiciocompartir'], $row['acefechafincompartir'], $row['acprotegidoclave']);
					array_push($arregloArchivoCargado, $obj);
				}
			}
		} else {
			$this->setmensajeoperacion("ArchivoCargado->listar: ".$base->getError());
		}
		return $arregloArchivoCargado;
	}

		public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		//$id = $this->getId();
		$nombre = $this->getNombre();
		$descripcion = $this->getDescripcion();
		$icono = $this->getIcono();
		$usuario = $this->getUsuario();
		$link = $this->getLink();
		$cantDescarga = $this->getCantDescarga();
		$cantUsada = $this->getCantUsada();
		$fechaInicio = $this->getFechaInicio();
		$fechaFin = $this->getFechaFin();
		$clave = $this->getClave();

		$sql= "INSERT INTO archivocargado(acnombre, acdescripcion, acicono, idusuario, aclinkacceso, accantidaddescarga, accantidadusada, acfechainiciocompartir, acefechafincompartir, acprotegidoclave)
		VALUES ('$nombre', '$descripcion', '$icono', '$usuario', '$link', '$cantDescarga', '$cantUsada', '$fechaInicio', '$fechaFin', '$clave')";

		if($base->Iniciar()){
			if ($elid = $base->Ejecutar($sql)) {
				$this->setId($elid);
				$resp = true;
			} else {
				$this->setmensajeoperacion("ArchivoCargado->insertar: ".$base->getError());
			}
		} else {
			$this->setmensajeoperacion("ArchivoCargado->insertar: ".$base->getError());
		}

		return $resp;
	}

		public function modificar(){
		$resp =false;
		$base=new BaseDatos();
		$id = $this->getId();
		$nombre = $this->getNombre();
		$descripcion = $this->getDescripcion();
		$icono = $this->getIcono();
		$usuario = $this->getUsuario();
		$link = $this->getLink();
		$cantDescarga = $this->getCantDescarga();
		$cantUsada = $this->getCantUsada();
		$fechaInicio = $this->getFechaInicio();
		$fechaFin = $this->getFechaFin();
		$clave = $this->getClave();

		$sql= "UPDATE archivocargado SET acnombre = '$nombre', acdescripcion = '$descripcion', acicono = '$icono', idusuario = '$usuario', aclinkacceso = '$link', accantidaddescarga = '$cantDescarga', accantidadusada = '$cantUsada', acfechainiciocompartir = '$fechaInicio', acefechafincompartir = '$fechaFin', acprotegidoclave = '$clave' WHERE idarchivocargado = '$id'" ;

		if($base->Iniciar()){
			if($base->Ejecutar($sql)){
				$resp=  true;
			}else{
				$this->setmensajeoperacion("ArchivoCargado->modificar: ".$base->getError());

			}
		}else{
			$this->setmensajeoperacion("ArchivoCargado->modificar: ".$base->getError());

		}
		return $resp;
	}

	public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		$id = $this->getId();
		if($base->Iniciar()){
			$sql="DELETE FROM archivocargado WHERE idarchivocargado = '$id'" ;
			if($base->Ejecutar($sql)){
				$resp=  true;
			}else{
				$this->setmensajeoperacion("ArchivoCargado->eliminar: ".$base->getError());

			}
		}else{
			$this->setmensajeoperacion("ArchivoCargado->eliminar: ".$base->getError());

		}
		return $resp;
	}
}
?>