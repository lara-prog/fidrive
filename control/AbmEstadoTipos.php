<?php
//Clase que maneja el control de las entidades Estado Tipos
class AbmEstadoTipos {
	/*
	*ABM CARGAR
	*
	*/
	//metodo que carga el objeto estado tipos instanciandolo y seteando sus atributos
	//parametro array $param
	//return obj $objAbmEstadoTipos
	private function cargarObjeto($param){
		$obj = null;
		//verifico que todos los parametros vengan como parametros
		if(array_key_exists('idestadotipos', $param) and array_key_exists('descripcion', $param) and array_key_exists('activo', $param)){
			$obj = new EstadoTipos();
			$obj->setear($param['idestadotipos'],$param['etdescripcion'],$param['etactivo']);
		}
		return $obj;
	}

	/*
	*ABM CARGAR OBJETO CON CLAVE
	*
	*/
	//metodo que carga el objeto estado tipos instanciandolo y seteando sus clave
	//parametro array $param
	//return obj $objestadotipos
	private function cargarObjetoConClave($param){
		$obj = null;
		if(isset($param['idestadotipos'])){
			$obj = new Usuario();
			$obj->setear($param['idestadotipos'], null);
		}
		return $obj;
	}


	/*
	*ABM SETEADOS CAMPOS CLAVES
	*/
	//metodo que verifica si dentro del arreglo de parametro id existe
	//parametro array $param
	//return boolean $resp
	private function seteadosCamposClaves($param){
		$resp = false;
		if(isset($param['idestadotipos'])){
			$resp = true;
		}
		return $resp;
	}

	/*
*ABM REALIZAR ALTA
*/
//metodo que permite crear, setear atributos y dar de alta una instancia de estado tipos en la bbdd
//parametro array $param
//return string $respuesta
	public function alta($param){
		$resp = false;
		$elObjEstadoTipos = $this->cargarObjeto($param);
		if($elObjEstadoTipos!=null and $elObjEstadoTipos->insertar()){
			$resp = true;
		}
		return $resp;
	}

/*
*ABM REALIZAR BAJA DE ARCHIVO
*/
//metodo que cambia el estado del archivo a dado de baja
//param array $param
//return string $respuesta
	public function baja($param){
		$resp = false;
		if($this->seteadosCamposClaves($param)){
			$elObjEstadoTipos = $this->cargarObjetoConClave($param);
			if($elObjEstadoTipos!=null and $elObjEstadoTipos->eliminar()){
				$resp = true;
			}
		}
	return $resp;
}

/*
*ABM REALIZAR MODIFICACION
*/
//metodo que modifica los atributos segun la solicitud del usuario
//parametro array $param
//return string $respuesta
	public function modificacion($param){
		$resp = false;
		if($this->seteadosCamposClaves($param)){
			$elObjEstadoTipos = $this->cargarObjeto($param);
			if($elObjEstadoTipos!=null and $elObjEstadoTipos->modificar()){
				$resp = true;
			}
		}
	return $resp;
	}

//metodo que realiza una buscqueda en la base de datos a partir de un arreglo
//param array $param
//return array $arreglo
	public function buscar($param){
		$where = " true ";
		if($param<>NULL){
			if(isset($param['idestadotipos']))
				$where.=" and idestadotipos=".$param['idestadotipos'];
			if(isset($param['etdescripcion']))
				$where.=" and etdescripcion=".$param['etdescripcion'];
			if(isset($param['etactivo']))
				$where.=" and etactivo=".$param['etactivo'];

		}
		$estadoTipos = new EstadoTipos();
		$arreglo = $estadoTipos->listar($where);
		return $arreglo;
	}
	}
?>