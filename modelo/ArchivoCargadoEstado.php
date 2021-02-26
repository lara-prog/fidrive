<?php
class ArchivoCargadoEstado {
	private $idarchivocargadoestado;
	private $idestadotipos;
	private $acedescripcion;
	private $idusuario;
	private $acefechaingreso;
	private $acefechafin;
	private $idarchivocargado;
	private $mensajeoperacion;

	public function __construct(){
		$this->idarchivocargadoestado = "";
		$this->idestadotipos = "";
		$this->acedescripcion = "";
		$this->idusuario = "";
		$this->acefechaingreso = "";
		$this->acefechafin = "";
		$this->idarchivocargado="";
		$this->mensajeoperacion = "";
	}

	//METODOS SETS
	public function setear($idEstado, $idTipos, $desc, $idUsuario, $fechaI, $fechaF, $idArchivo){
		$this->setIdEstado($idEstado);
		$this->setIdTipos($idTipos);
		$this->setDescripcion($desc);
		$this->setUsuario($idUsuario);
		$this->setFechaInicio($fechaI);
		$this->setFechaFin($fechaF);
		$this->setIdArchivo($idArchivo);

	}

	public function setIdEstado($idEstado){
		$this->idarchivocargadoestado = $idEstado;
	}

	public function setIdTipos($idTipos){
		$this->idestadotipos =  $idTipos;
	}

	public function setDescripcion($desc){
		$this->acedescripcion = $desc;
	}

	public function setUsuario($usuario){
		$this->idusuario = $usuario;
	}

	public function setFechaInicio($fechaI){
		$this->acefechaingreso = $fechaI;
	}

	public function setFechaFin($fechaF){
		$this->acefechafin = $fechaF;
	}

	public function setIdArchivo($idArchivo){
		$this->idarchivocargado = $idArchivo;
	}

	public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

	public function getIdEstado(){
		return $this->idarchivocargadoestado;
	}

//METODOS GETS
	public function getIdTipos(){
		return $this->idestadotipos;
	}

	public function getDescripcion(){
		return $this->acedescripcion;
	}

	public function getUsuario(){
		return $this->idusuario;
	}

	public function getFechaInicio(){
		return $this->acefechaingreso;
	}

	public function getFechaFin(){
		return $this->acefechafin;
	}

	public function getIdArchivo(){
		return $this->idarchivocargado;
	}
	public function getmensajeoperacion(){
		return $this->mensajeoperacion;
	}
//CONSULTAS A BASE DE DATOS
	public function cargar(){
		$resp = false;
		$base=new BaseDatos();
		$sql="SELECT * FROM archivocargadoestado WHERE idarchivocargadoestado= ".$this->getIdEstado();
		if ($base->Iniciar()) {
			$res = $base->Ejecutar($sql);
			if($res>-1){
				if($res>0){
					$row = $base->Registro();
					$this->setear($row['idarchivocargadoestado'],$row['idestadotipos'],$row['acedescripcion'],$row['idusuario'],$row['acefechaingreso'] ,$row['acefechafin'],$row['idarchivocargado']);
				}
			}
		} else {
			$this->setmensajeoperacion("ArchivoCargadoEstado->listar: ".$base->getError());
		}
		return $resp;
	}

	public function listar($condicion="", $limite=""){
		$arregloArchivoCargadoEstado = array();
		$base = new BaseDatos();
		$sql="SELECT * FROM archivocargadoestado ";
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
					$obj= new ArchivoCargadoEstado();

					$usuario = new Usuario();
					$usuario->setId($row['idusuario']);
					$usuario->cargar();

					$estado =new EstadoTipos();
					$estado->setId($row['idestadotipos']);
					$estado->cargar();

					$archivo = new ArchivoCargado();
					$archivo->setId($row['idarchivocargado']);
					$archivo->cargar();

					$obj->setear($row['idarchivocargadoestado'], $estado, $row['acedescripcion'], $usuario, $row['acefechaingreso'], $row['acefechafin'], $archivo);

					array_push($arregloArchivoCargadoEstado, $obj);
				}
			}
		} else {
			$this->setmensajeoperacion("ArchivoCargadoEstado->listar: ".$base->getError());
		}
		return $arregloArchivoCargadoEstado;
	}

	public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$idEstado= $this->getIdEstado();
		$tipo = $this->getIdTipos();
		$descripcion = $this->getDescripcion();
		$usuario = $this->getUsuario();
		$fechaI = $this->getFechaInicio();
		$fechaF = $this->getFechaFin();
		$archivo = $this->getIdArchivo();

		$sql= "INSERT INTO archivocargadoestado(idestadotipos, acedescripcion, idusuario, acefechaingreso, acefechafin, idarchivocargado)
		VALUES ('$tipo', '$descripcion', '$usuario', '$fechaI', '$fechaF', '$archivo')";

		if($base->Iniciar()){
			if ($elid = $base->Ejecutar($sql)) {
				$this->setIdEstado($elid);
				$resp = true;
			} else {
				$this->setmensajeoperacion("ArchivoCargadoEstado->insertar: ".$base->getError());
			}
		} else {
			$this->setmensajeoperacion("ArchivoCargadoEstado->insertar: ".$base->getError());
		}

		return $resp;
	}

	public function modificar(){
		$resp =false;
		$base=new BaseDatos();
		$idEstado= $this->getIdEstado();
		$tipo = $this->getIdTipos();
		$descripcion = $this->getDescripcion();
		$usuario = $this->getUsuario();
		$fechaI = $this->getFechaInicio();
		$fechaF = $this->getFechaFin();
		$archivo = $this->getIdArchivo();

		$sql= "UPDATE archivocargadoestado SET idestadotipos='$tipo', acedescripcion='$descripcion', idusuario ='$usuario', acefechaingreso = '$fechaI', acefechafin = '$fechaF', idarchivocargado = '$archivo' WHERE idarchivocargadoestado = '$idEstado'";

		if($base->Iniciar()){
			if($base->Ejecutar($sql)){
				$resp=  true;
			}else{
				$this->setmensajeoperacion("ArchivoCargadoEstado->modificar: ".$base->getError());

			}
		}else{
			$this->setmensajeoperacion("ArchivoCargadoEstado->modificar: ".$base->getError());

		}
		return $resp;
	}

	public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		$id = $this->getIdEstado();
		if($base->Iniciar()){
			$sql="DELETE FROM archivocargadoestado WHERE idarchivocargadoestado = '$id'" ;
			if($base->Ejecutar($sql)){
				$resp=  true;
			}else{
				$this->setmensajeoperacion("ArchivoCargadoEstado->eliminar: ".$base->getError());

			}
		}else{
			$this->setmensajeoperacion("ArchivoCargadoEstado->eliminar: ".$base->getError());

		}
		return $resp;
	}
}
?>