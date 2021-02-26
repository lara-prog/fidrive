<?php
class EstadoTipos {
	private $idestadotipos;
	private $etdescripcion;
	private $etactivo;
	private $mensajeoperacion;

	public function __construct(){
		$this->idestadotipos = "";
		$this->etdescripcion = "";
		$this->etactivo = "";
	}
//METODOS SETS
	public function setear($id, $desc, $activo){
		$this->setId($id);
		$this->setDescripcion($desc);
		$this->setActivo($activo);
	}

	public function setId($id){
		$this->idestadotipos = $id;
	}

	public function setDescripcion($desc){
		$this->etdescripcion = $desc;
	}

	public function setActivo($activo){
		$this->etactivo = $activo;
	}

	public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

//GETS
	public function getId(){
		return $this->idestadotipos;
	}

	public function getDescripcion(){
		return $this->etdescripcion;
	}

	public function getActivo(){
		return $this->etactivo;
	}

	public function getmensajeoperacion(){
		return $this->mensajeoperacion;
	}

//CONSULTAS A BASE DE DATOS
	public function cargar(){
		$resp = false;
		$base=new BaseDatos();
		$sql="SELECT * FROM estadotipos WHERE idestadotipos= ".$this->getId();
		if ($base->Iniciar()) {
			$res = $base->Ejecutar($sql);
			if($res>-1){
				if($res>0){
					$row = $base->Registro();
					$this->setear($row['idestadotipos'],$row['etdescripcion'],$row['etactivo']);
				}
			}
		} else {
			$this->setmensajeoperacion("EstadoTipos->listar: ".$base->getError());
		}
		return $resp;
	}

	public function listar($condicion="", $limite=""){
		$arregloEstadoTipos = array();
		$base = new BaseDatos();
		$sql="SELECT * FROM estadotipos ";
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
					$obj= new EstadoTipos();

					$obj->setear($row['idestadotipos'],$row['etdescripcion'],$row['etactivo']);

					array_push($arregloEstadoTipos, $obj);
				}
			}
		} else {
			$this->setmensajeoperacion("EstadoTipos->listar: ".$base->getError());
		}
		return $arregloEstadoTipos;
	}

	public function insertar(){
		$base=new BaseDatos();
		$resp= false;

		$descripcion = $this->getDescripcion();
		$activo = $this->getActivo();

		$sql= "INSERT INTO estadotipos(etdescripcion, etactivo)
		VALUES ('$descripcion', '$activo')";

		if($base->Iniciar()){
			if ($elid = $base->Ejecutar($sql)) {
				$this->setId($elid);
				$resp = true;
			} else {
				$this->setmensajeoperacion("EstadoTipos->insertar: ".$base->getError());
			}
		} else {
			$this->setmensajeoperacion("EstadoTipos->insertar: ".$base->getError());
		}

		return $resp;
	}

	public function modificar(){
		$resp =false;
		$base=new BaseDatos();
		$idEstado = $this->getId();
		$descripcion = $this->getDescripcion();
		$activo = $this->getActivo();

		$sql= "UPDATE estadotipos SET etdescripcion='$descripcion', etactivo = '$activo' WHERE idestadotipos = '$idEstado'";

		if($base->Iniciar()){
			if($base->Ejecutar($sql)){
				$resp=  true;
			}else{
				$this->setmensajeoperacion("EstadoTipos->modificar: ".$base->getError());

			}
		}else{
			$this->setmensajeoperacion("EstadoTipos->modificar: ".$base->getError());

		}
		return $resp;
	}

	public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		$id = $this->getId();
		if($base->Iniciar()){
			$sql="DELETE FROM estadotipos WHERE idestadotipos = '$id'" ;
			if($base->Ejecutar($sql)){
				$resp=  true;
			}else{
				$this->setmensajeoperacion("EstadoTipos->eliminar: ".$base->getError());

			}
		}else{
			$this->setmensajeoperacion("EstadoTipos->eliminar: ".$base->getError());

		}
		return $resp;
	}
}
?>