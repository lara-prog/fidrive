<?php
//Clase que maneja el control de las entidades Archivo Cargado estado
class AbmArchivoCargadoEstado {
	/*
	*ABM CARGAR
	*
	*/
	/**
	*metodo que carga el objeto archivo cargado estado instanciandolo y seteando sus atributos
	*@param array $param
	*@return obj $objAbmArchvoCargadoEstado
	*/
	private function cargarObjeto($param){
		$obj = null;
		//verifico que todos los parametros vengan como parametros
		if(array_key_exists('idarchivocargadoestado', $param) and array_key_exists('idestadotipos', $param) and array_key_exists('acedescripcion', $param) and array_key_exists('idusuario', $param) and array_key_exists('acefechaingreso', $param) and array_key_exists('acefechafin', $param) and array_key_exists('idarchivocargado', $param)){
			$obj = new ArchivoCargadoEstado();
			$obj->setear($param['idarchivocargadoestado'],$param['idestadotipos'],$param['acedescripcion'],$param['idusuario'],$param['acefechaingreso'] ,$param['acefechafin'],$param['idarchivocargado']);
		}
		return $obj;
	}

	/*
	*ABM CARGAR OBJETO CON CLAVE
	*
	*/
	/**
	*metodo que carga el objeto archivo cargado estad instanciandolo y seteando sus clave
	*@param array $param
	*@return obj $objAbmArchvoCargaado
	*/
	private function cargarObjetoConClave($param){
		$obj = null;
		if(isset($param['idarchivocargadoestado'])){
			$obj = new ArchivoCargadoEstado();
			$obj->setear($param['idarchivocargadoestado'], null);
		}
		return $obj;
	}

	/*
	*ABM SETEADOS CAMPOS CLAVES
	*/
	/**
	*metodo que verifica si dentro del arreglo de parametro id existe
	*@param array $param
	*@return boolean $resp
	*/
	private function seteadosCamposClaves($param){
		$resp = false;
		if(isset($param['idarchivocargadoestado'])){
			$resp = true;
		}
		return $resp;
	}

/*
*ABM REALIZAR ALTA
*/
/**
*metodo que permite crear, setear atributos y dar de alta una instancia de archivo cargado estado en la bbdd
*@param array $param
*@return string $respuesta
*/
	public function alta($param){
		$resp = false;
		$elObjArchivoCargadoEstado = $this->cargarObjeto($param);
		if($elObjArchivoCargadoEstado!=null and $elObjArchivoCargadoEstado->insertar()){
			$resp = true;
		}
		return $resp;
	}

/*
*ABM REALIZAR BAJA DE ARCHIVO
*/
/**
*metodo que cambia el estado del archivo a dado de baja
* @param array $param
*@return string $respuesta
*/
	public function baja($param){
		$resp = false;
		if($this->seteadosCamposClaves($param)){
			$elObjArchivoCargadoEstado = $this->cargarObjetoConClave($param);
			if($elObjArchivoCargadoEstado!=null and $elObjArchivoCargadoEstado->eliminar()){
				$resp = true;
			}
		}
		return $resp;
	}

/*
*ABM REALIZAR MODIFICACION
*/
/**
*metodo que modifica los atributos segun la solicitud del usuario
*@param array $param
*@return string $respuesta
*/
	public function modificacion($param){
		$resp = false;
		if($this->seteadosCamposClaves($param)){
			$elObjArchivoCargadoEstado = $this->cargarObjeto($param);
			if($elObjArchivoCargadoEstado!=null and $elObjArchivoCargadoEstado->modificar()){
				$resp = true;
			}
		}
		return $resp;
	}
/**
*metodo que realiza una buscqueda en la base de datos a partir de un string
*@param string $condicion
*@return array $arreglo
	*/
	public function buscarCondicion($condicion){
		$where="";
		if($condicion<>null){
			$where.=$condicion;
		}
		$archivoCargadoEstado  = new ArchivoCargadoEstado();
		$arreglo = $archivoCargadoEstado->listar($where);
		return $arreglo;
	}

/**
*metodo que realiza una buscqueda en la base de datos a partir de un arreglo
*@param array $param
*@return array $arreglo
*/
	public function buscar($param){
		$where = " true ";
		if($param<>NULL){
			if(isset($param['idarchivocargadoestado']))
				$where.=" and idarchivocargadoestado=".$param['idarchivocargadoestado'];
			if(isset($param['idestadotipos']))
				$where.=" and idestadotipos=".$param['idestadotipos'];
			if(isset($param['acedescripcion']))
				$where.=" and acedescripcion=".$param['acedescripcion'];
			if(isset($param['idusuario']))
				$where.=" and idusuario=".$param['idusuario'];
			if(isset($param['acefechaingreso']))
				$where.=" and acefechaingreso=".$param['acefechaingreso'];
			if(isset($param['acefechafin']))
				$where.=" and acefechafin=".$param['acefechafin'];
			if(isset($param['idarchivocargado']))
				$where.=" and idarchivocargado=".$param['idarchivocargado'];


		}
		$archivoCargadoEstado  = new ArchivoCargadoEstado();
		$arreglo = $archivoCargadoEstado->listar($where);
		return $arreglo;
	}

	/**
	*metodo que busca y devuelve los archivos que esten compartidos
	* @param
	* @return array $arreglo_archivoCompartidos
	*/
	public function filtrarCompartidos(){
		$arreglo_archivos=array();
		$condicion = "idestadotipos = 2 AND acefechafin = '0000-00-00 00:00:00'";
		$arreglo_archivosCompartidos = $this->buscarCondicion($condicion);
		return $arreglo_archivosCompartidos;
	}

	/**
	*metodo que busca y devuelve los archivos que esten compartidos por el usuario
	* @param $id
	* @return array $arreglo_archivoCompartidos
	*/
	public function filtrarCompartidosDeUsuario($id){
		$arreglo_archivos=array();
		$condicion = "idestadotipos = 2 AND acefechafin = '0000-00-00 00:00:00' AND idusuario = '".$id."'";
		$arreglo_archivosCompartidos = $this->buscarCondicion($condicion);
		return $arreglo_archivosCompartidos;
	}

	/**
	*metodo que busca y devuelve los archivos que esten no esten borrados
	* @param
	* @return array $arreglo_archivosNoBorrados
	*/
	public function filtrarNoBorrados(){
		$arreglo_archivos = array();
		$condicion = "idestadotipos <> 4 AND acefechafin = '0000-00-00 00:00:00'";
		$arreglo_archivosNoBorrados = $this->buscarCondicion($condicion);
		return $arreglo_archivosNoBorrados;
	}

	/**
	*metodo que busca y devuelve los archivos que esten no esten borrados de un usuario
	* @param $id
	* @return array $arreglo_archivoNoBorrados
	*/
	public function filtrarNoBorradosDeUsuario($id){
		$arreglo_archivos = array();
		$condicion = "idestadotipos <> 4 AND acefechafin = '0000-00-00 00:00:00' AND idusuario = '".$id."'";
		$arreglo_archivosNoBorrados = $this->buscarCondicion($condicion);
		return $arreglo_archivosNoBorrados;
	}

	/**
	*metodo que busca y devuelve los archivos que esten no esten borrados de un usuario
	* @param $fecha
	* @return boolean $verificado
	*/
	public function estaCompartido($fecha){
		$verificado = false;
		if(strcmp($fecha, "0000-00-00 00:00:00")== 0){
			$verificado = true;
		}
		return $verificado;
	}
}

?>