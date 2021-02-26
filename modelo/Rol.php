<?php
class Rol {
	private $idrol;
	private $rodescripcion;
	private $mensajeoperacion;

	public function __construct(){
		$this->idrol = "";
		$this->rodescripcion = "";
		$this->mensajeoperacion = "";
	}

//METODOS SETS
	public function setear ($id, $des){
		$this->setId($id);
		$this->setDescripcion($des);
	}

	public function setId($id){
		$this->idrol = $id;
	}

	public function setDescripcion($des){
		$this->rodescripcion = $des;
	}

	public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

//METODOS GETS
	public function getId(){
		return $this->idrol;
	}

	public function getDescripcion(){
		return $this->rodescripcion;
	}

	public function getmensajeoperacion(){
		return $this->mensajeoperacion;
	}

//CONSULTAS A BASE DE DATOS
	public function cargar(){
		$resp = false;
		$base=new BaseDatos();
		$sql="SELECT * FROM rol WHERE idrol= ".$this->getId();
		if ($base->Iniciar()) {
			$res = $base->Ejecutar($sql);
			if($res>-1){
				if($res>0){
					$row = $base->Registro();
					$this->setear($row['idrol'], $row['rodescripcion']);
				}
			}
		} else {
			$this->setmensajeoperacion("Rol->listar: ".$base->getError());
		}
		return $resp;
	}

	public function listar($condicion="", $limite=""){
		$arregloRol = array();
		$base = new BaseDatos();
		$sql="SELECT * FROM rol ";
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
					$obj= new Rol();
					$obj->setear($row['idrol'], $row['rodescripcion']);;
					array_push($arregloRol, $obj);
				}
			}
		} else {
			$this->setmensajeoperacion("Rol->listar: ".$base->getError());
		}
		return $arregloRol;
	}

	public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		//$id = $this->getId();
		$descripcion = $this->getDescripcion();

		$sql= "INSERT INTO rol(rodescripcion) VALUES ('$descripcion')";

		if($base->Iniciar()){
			if ($elid = $base->Ejecutar($sql)) {
				$this->setId($elid);
				$resp = true;
			} else {
				$this->setmensajeoperacion("Rol->insertar: ".$base->getError());
			}
		} else {
			$this->setmensajeoperacion("Rol->insertar: ".$base->getError());
		}

		return $resp;
	}

	public function modificar(){
		$resp =false;
		$base=new BaseDatos();
		$id = $this->getId();
		$descripcion = $this->getDescripcion();

		$sql= "UPDATE rol SET rodescripcion = '$descripcion' WHERE idrol = '$id'" ;

		if($base->Iniciar()){
			if($base->Ejecutar($sql)){
				$resp=  true;
			}else{
				$this->setmensajeoperacion("Rol->modificar: ".$base->getError());

			}
		}else{
			$this->setmensajeoperacion("Rol->modificar: ".$base->getError());

		}
		return $resp;
	}

	public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		$id = $this->getId();
		if($base->Iniciar()){
			$sql="DELETE FROM rol WHERE idrol = '$id'" ;
			if($base->Ejecutar($sql)){
				$resp=  true;
			}else{
				$this->setmensajeoperacion("Rol->eliminar: ".$base->getError());

			}
		}else{
			$this->setmensajeoperacion("Rol->eliminar: ".$base->getError());

		}
		return $resp;
	}


}
?>