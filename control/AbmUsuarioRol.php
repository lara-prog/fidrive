<?php
class AbmUsuarioRol {
	 /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object
     */

	 private function cargarObjeto($param){
        //verEstructura($param);
	 	$objUsuarioRol = null;
        //print_r($param);
	 	if( array_key_exists('idrol',$param) and array_key_exists('idusuario',$param)){
	 		$objUsuarioRol = new UsuarioRol();
            $objUsuarioRol->setear($param['idusuario'], $param['idrol']);
        }
        return $objUsuarioRol;
    }
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object
     */
    private function cargarObjetoConClave($param){
    	$objUsuarioRol = null;
        //print_R ($param);
    	if( isset($param['idusuario']) && isset($param['idrol']) ){
    		$objUsuarioRol = new UsuarioRol();
    		$objUsuarioRol->setear($objUsuario, $objRol);
    	}
    	return $objUsuarioRol;
    }


    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */

    private function seteadosCamposClaves($param){

    	$resp = false;
    	if (isset($param['idusuario']) && isset($param['idrol']));

    	$resp = true;
    	return $resp;

    }

    /**
     *
     * @param array $param
     */
    public function alta($param){
    	$resp = false;
    	$objUsuarioRol = $this->cargarObjeto($param);
    	if ($objUsuarioRol!=null and $objUsuarioRol->insertar()){
    		$resp = true;
    	}

    	return $resp;
    }

    /**
     * permite eliminar un objeto
     * @param array $param
     * @return boolean
     */

    public function baja($param){
        //verEstructura($param);
    	$resp = false;
    	if ($this->seteadosCamposClaves($param)){

    		$objUsuarioRol = $this->cargarObjeto($param);

    		if ($objUsuarioRol !=null and $objUsuarioRol->eliminar()){

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
        //echo "Estoy en modificacion";
        //print_R($param);
    	$resp = false;
    	if ($this->seteadosCamposClaves($param)){

    		$objUsuarioRol = $this->cargarObjeto($param);

    		if($objUsuarioRol !=null and $objUsuarioRol->modificar()){
    			$resp = true;

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
        // print_R ($param);

    	$where = " true ";
    	if ($param<>NULL){
    		if  (isset($param['idusuario']))
    			$where.=" and idusuario='".$param['idusuario']."'";
    		if  (isset($param['idrol']))
    			$where.=" and idrol ='".$param['idrol']."'";
    	}
        $usuarioRol= new UsuarioRol();
        $arreglo = $usuarioRol->listar($where, "");
        return $arreglo;

    }

    /**
    *metodo que realiza una buscqueda en la base de datos a partir de un string
    *@param string $condicion
    *@return array $arreglo
    */
    public function buscarCondicion($param){
        // print_R ($param);
       // $where = " true ";
        if ($param<>NULL){
            $usuarioRol= new UsuarioRol();
            $arreglo = $usuarioRol->listar($param);
        }
        return $arreglo;
    }

    /**
    *metodo que realiza una busqueda en la base de datos a partir de un string para verificar el rol admin
    *@param string $condicion
    *@return array $arreglo
    */
    public function esAdmin($id){
        $esAdmin = false;
        $condicion = "idusuario = '".$id."' AND idrol= '1'";
        $resultado = $this->buscarCondicion($condicion);
        if(count($resultado)!=0){
            $esAdmin = true;
        }
        return $esAdmin;
    }
}
?>