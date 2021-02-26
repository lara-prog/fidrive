<?php
class AbmUsuario {

	/**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object
     */
	private function cargarObjeto($param){
		$obj = null;
		if(array_key_exists('idusuario', $param) and array_key_exists('usnombre', $param) and array_key_exists('usapellido', $param) and array_key_exists('uslogin', $param) and array_key_exists('usclave', $param) and array_key_exists('usactivo', $param)){
			$obj = new Usuario();
			$obj->setear($param['idusuario'], $param['usnombre'], $param['usapellido'], $param['uslogin'], $param['usclave'], $param['usactivo']);
		}
		return $obj;
	}

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object
     */
	private function cargarObjetoConClave($param){
		$obj = null;
		if(isset($param['idusuario'])){
			$obj = new Usuario();
			$obj->setear($param['idusuario'], null);
		}
		return $obj;
	}

	/**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
	private function seteadosCamposClaves($param){
		$resp = false;
		if(isset($param['idusuario'])){
			$resp = true;
		}
		return $resp;
	}

	 /**
     *
     * @param array $param
     */
	public function alta($param){
		$resp = false;
		$param['idusuario'] = null;
		$elObjUsuario = $this->cargarObjeto($param);
		if($elObjUsuario!=null and $elObjUsuario->insertar()){
			$idusuario = $elObjUsuario->getId();
			$resp = true;
			$objRol=new AbmRol;
			$condicion = "idrol = 3";
			$arreglorol = $objRol->buscarCondicion($condicion);
			if(count($arreglorol)!=0){
				$rol = $arreglorol[0];
				$objAbmUsuarioRol=new AbmUsuarioRol();
				$parametro = ["idrol"=>$rol->getId(), "idusuario"=>$idusuario];
				$resp = $objAbmUsuarioRol->alta($parametro);
			}
		}
		return $resp;
	}

	public function asignarrol($param) {
		$idusuario = $param['idusuario'];
		$idrol = $param['idrol'];
		$objAbmUsuarioRol = new AbmUsuarioRol();
		$parametro = ["idrol"=>$idrol, "idusuario"=>$idusuario];
		$resp = $objAbmUsuarioRol->alta($parametro);
		return $resp;
	}

	/**
     * permite eliminar un objeto
     * @param array $param
     * @return boolean
     */
	public function baja($param){
		$resp = false;
		if($this->seteadosCamposClaves($param)){
			$elObjUsuario = $this->cargarObjetoConClave($param);
			if($elObjUsuario!=null and $elObjUsuario->eliminar()){
				$resp = true;
			}
		}
		return $resp;
	}

   /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
	public function modificacion($param){
		$resp = false;
		//$objUsuario = new Usuario();
		$condicion = "idusuario = ".$param['idusuario'];
		$usuarios = $this->buscarCondicion($condicion);
		if(count($usuarios)!=0){
			$usuario = $usuarios[0];
			$param['usnombre']=$usuario->getNombre();
			$param['usapellido']=$usuario->getApellido();
			$param['uslogin']=$usuario->getLogin();
			$param['usclave']=$usuario->getClave();
			if($this->seteadosCamposClaves($param)){
				$elObjUsuario = $this->cargarObjeto($param);
				if($elObjUsuario!=null and $elObjUsuario->modificar()){
					$resp = true;
				}
			}
		}

		return $resp;
	}

  /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
	public function buscar($param){
		$where = " true ";
		if($param<>NULL){
			if(isset($param['idusuario']))
				$where.=" and idusuario=".$param['idusuario'];
			if(isset($param['usnombre']))
				$where.=" and usnombre=".$param['usnombre'];
			if(isset($param['usapellido']))
				$where.=" and usapellido=".$param['usapellido'];
			if(isset($param['uslogin']))
				$where.=" and uslogin=".$param['uslogin'];
			if(isset($param['usclave']))
				$where.=" and usclave=".$param['usclave'];
			if(isset($param['usactivo']))
				$where.=" and usactivo=".$param['usactivo'];
		}
		$usuario = new Usuario();
		$arreglo = $usuario->listar($where);
		return $arreglo;
	}

	/**
	*metodo que realiza una buscqueda en la base de datos a partir de un string
	* @param string $condicion
	* @return array $arreglo
	*/
	public function buscarCondicion($condicion){
		//echo "CONDICION EN ABM: ".$condicion;
		//echo "\nCONDICION EN LA BUSQUEDA: ".$condicion;
		$where="";
		if($condicion<>null){
			$where.=$condicion;
		}
		$archivoCargadoEstado  = new Usuario();
		//echo "\nWHERE: ".$where;
		$arreglo = $archivoCargadoEstado->listar($where);
		//print_r($arreglo);
		return $arreglo;
	}

	public function filtrarNoBorrados(){
		$arreglo_usuarios = array();
		$condicion = "usactivo = 1";
		$arreglo_usuarios = $this->buscarCondicion($condicion);
		//print_r($arreglo_usuarios);
		return $arreglo_usuarios;
	}



}
?>