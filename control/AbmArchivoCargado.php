<?php
//Clase que maneja el control de las entidades Archivo Cargado
class AbmArchivoCargado {
	// $archivos guarda los datos de un archivo
	private  $archivos;
	//$ruta mantiene la direccion de la carpeta de archivos
	private $ruta;

	/**
	*Metodo constructor
	*@param
	*@return $objAbmArchivoCargado
	*/
	public function __construct(){
		$this->archivos = [];
		$this->ruta = "../../archivos/";
		$this->escanear_directorio();
	}

	//metodo privado que guarda el archivo en la variable de instancia escaneando el directorio
	private function escanear_directorio(){
		if ($gestor = opendir($this->ruta)) {
			while (false !== ($entrada = readdir($gestor))) {
				if ($entrada != "." && $entrada != "..") {
					$this->archivos[]=$entrada;
				}
			}
			closedir($gestor);
		}
	}

	/**
	*metodo que devuelve el archivo
	*@param
	*@return $archivos
	*/
	public function get_archivos(){
		return $this->archivos;
	}

	//metodo que guarda el archivo en el directorio  elegido a partir de $_FILES
	public function subirArchivo($datos){
		$nombreArchivo=$_FILES['archivo']['name'];
		$dir = "../../archivos/";
		$todoOK=true;
		//verifico error
		if ($_FILES["archivo"]["error"] <= 0) {
			$todoOK=true;
		}
		else {
			$todoOK=false;
		}
		//verifico tamaño de archivo
		if ($todoOK && $_FILES['archivo']["size"] / 1024 >1000)
		{
			$todoOK=false;
		}

		//verifico si puedo copiar el archivo
		if ($todoOK && !copy($_FILES['archivo']['tmp_name'], $dir.$_FILES['archivo']['name']))
		{
			$todoOK=false;
		}
		return $todoOK;
	}

	/*
	*ABM CARGAR
	*
	*/
	/**
	*metodo que carga el objeto archivo cargado instanciandolo y seteando sus atributos
	*@param array $param
	*@return obj $objAbmArchvoCargaado
	*/
	private function cargarObjeto($param){
		$objAbmArchvoCargado = null;
		//verifico que todos los parametros vengan como parametros
		if(array_key_exists('idarchivocargado', $param) and array_key_exists('acnombre', $param) and array_key_exists('acdescripcion', $param) and array_key_exists('acicono', $param) and array_key_exists('idusuario', $param) and array_key_exists('aclinkacceso', $param) and array_key_exists('accantidaddescarga', $param) and array_key_exists('accantidadusada', $param) and array_key_exists('acfechainiciocompartir', $param) and array_key_exists('acfechafincompartir', $param) and array_key_exists('acprotegidoclave', $param)){


			$objAbmArchvoCargado = new ArchivoCargado();
			$objAbmArchvoCargado->setear($param['idarchivocargado'],$param['acnombre'], $param['acdescripcion'], $param['acicono'], $param['idusuario'], $param['aclinkacceso'], $param['accantidaddescarga'], $param['accantidadusada'], $param['acfechainiciocompartir'], $param['acfechafincompartir'], $param['acprotegidoclave']);

		}
		return $objAbmArchvoCargado;
	}

	/*
	*ABM CARGAR OBJETO CON CLAVE
	*
	*/
	/**
	*metodo que carga el objeto archivo cargado instanciandolo y seteando sus clave
	*@param array $param
	*@return obj $objAbmArchvoCargaado
	*/
	private function cargarObjetoConClave($param){
		$obj = null;
		if(isset($param['idarchivocargado'])){
			$obj = new ArchivoCargado();
			$obj->setear($param['idarchivocargado'], null, null, null, null, null, null, null, null, null, null);
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
		if(isset($param['idarchivocargado'])){
			$resp = true;
		}
		return $resp;
	}

/*
*ABM REALIZAR ALTA
*/
/**
*metodo que permite crear, setear atributos y dar de alta una instancia de archivo cargado en la bbdd
*@param array $param
*@return string $respuesta
*/
public function realizarAlta($param){
	$respuesta = "";
	//seteo los atributos que no estan disponibles al crear un archivo
	$param['idarchivocargado']=null;
	$param['aclinkacceso']=null;
	$param['accantidaddescarga']=null;
	$param['accantidadusada']=null;
	$param['acfechafincompartir']=null;
	$param['acfechainiciocompartir']=null;
	$param['acprotegidoclave']=null;
	//guardo el archivo en el directorio correspondiente
	if($this->subirArchivo($param)){
		//creo una instancia de archivo cargado y seteo sus atributos
		$elObjArchivoCargado = $this->cargarObjeto($param);
		//creo un nuevo registro en la bbdd
		if($elObjArchivoCargado!=null and $elObjArchivoCargado->insertar()){
			$usuario_ace = $param['idusuario'];
			$descripcion = "archivo cargado por el usuario con id $usuario_ace";
			$idEstado = 1;
			//seteo atributos necesarios para crear un nuevo estado de archivo en un arreglo asociativo
			$arreglo_ACE = array("objArchivo"=>$elObjArchivoCargado, "descripcion"=>$descripcion, "usuario"=>$usuario_ace, "idestado"=>$idEstado, "clave"=>0);
			//mando a crear el nuevo estado, devuelve true o false
			$res = $this->crearNuevoEstado($arreglo_ACE);
			if($res){
				$respuesta = "el archivo se subio correctamente";
			} else {
				$respuesta = "el archivo NO se subio correctamente, NO SE CREO EL ESTADO CORRESPONDIENTE";
			}
		}
	} else {
		$respuesta = "el archivo NO se subio correctamente AL ARCHIVO ";
	}
	return $respuesta;
}

/*
*ABM REALIZAR MODIFICACION
*/
/**
*metodo que modifica los atributos segun la solicitud del usuario
*@param array $param
*@return string $respuesta
*/
public function realizarModificacion($param){
	//seteo los parametros que no posee el parametro
	$respuesta ="";
	$param['aclinkacceso']=null;
	$param['accantidaddescarga']=null;
	$param['accantidadusada']=null;
	$param['acfechafincompartir']=null;
	$param['acfechainiciocompartir']=null;
	$param['acprotegidoclave']=null;
	//mando a verificar que el id esta seteado
	if($this->seteadosCamposClaves($param)){
		//mando a crear e inicializar el objeto
		$elObjArchivoCargado = $this->cargarObjeto($param);
		//mando la consulta a la bbdd
		if($elObjArchivoCargado!=null and $elObjArchivoCargado->modificar()){
			$respuesta = "el archivo se ha modificado correctamente";
		}else{
			$respuesta = "el archivo No se ha modificado correctamente";
		}
	}else{
		$respuesta = "el archivo No se ha modificado correctamente";
	}
	return $respuesta;
}

/*
*ABM COMPARTIR ARCHIVO
*/
/**
*cambiar el nombre del archivo almacenado en la bbd para poder compartir mediante un link
*@param string $nombreActual, $link
*@return boolean $realizado
*/
private function renovarNombre($nombreActual,$link){
	$realizado = false;
	$nombreAnterior = "../../archivos/".$nombreActual;
	$pos = strrpos($nombreActual, '.');
	$extension = substr($nombreActual, $pos);
	$nombreNuevo = "../../archivos/".$link.$extension;
	//en el caso de no haberlo compartido antes, se guarda el nombre
	if(file_exists($nombreAnterior)){
		if(rename($nombreAnterior, $nombreNuevo)){
			$realizado = true;
		}
	//en el caso de haber compartido antes, el nombre ya debe haberse modificado
	//como se utiliza la encriptacion por md5, el resultado sera el mismo
	//entonces solo se setea como realizado
	} else if(file_exists($nombreNuevo)){
		$realizado = true;
	}
	return $realizado;
}
/**
*metodo que cambia el estado del archivo a compartir
*@param array $param
*@return string $respuesta
*/
public function realizarCompartir($param){
	$respuesta ="";
	$resp="";
	//RECUPERO TODOS LOS DATOS DEL ARCHIVO
	$idArchivo = $param['idarchivocargado'];
	$condicion = "idarchivocargado = $idArchivo";
	//voy a buscar el objeto archivo a bbdd
	$listaAbmAC = array();
	$listaAbmAC = $this->buscarCondicion($condicion);
	$archivo = $listaAbmAC[0];
	//seteo los atributos al arreglo param, a partir de los datos provenientes del objeto
	$param['idarchivocargado']=$archivo->getId();
	$param['acicono']=$archivo->getIcono();
	$param['idusuario']=$archivo->getUsuario()->getId();
	$param['acdescripcion']=$archivo->getDescripcion();
	$param['accantidadusada']=null;
	//GENERO LAS FECHAS NECESARIAS
	//el sistema mantiene el dato de las fechas de cuando se compartió en $fechaHoy
	//y el dia que se dejara de compartir en $fechaFin
	$fechaHoy =date("Y-m-d H:i:s");
	$dias = $param['dias'];
	$fechaFin = date("Y-m-d H:i:s", strtotime($fechaHoy."+ $dias days"));
	$param['acfechainiciocompartir']=$fechaHoy;
	$param['acfechafincompartir']=$fechaFin;
    //mando a verificar que el id del archivo este en el parametro, creo e inicializo los atributos del archivo
    //y envio la consulta para modificar en la base de datos
	if($this->seteadosCamposClaves($param)){
		$elObjArchivoCargado = $this->cargarObjeto($param);
		if($elObjArchivoCargado!=null and $elObjArchivoCargado->modificar()){
		//seteo atributos necesarios para crear un nuevo estado de archivo en un arreglo asociativo
			$usuario_ace=$param['usuarioACE'];
			$descripcion = "archivo compartido por usuario con id: $usuario_ace";
			$idEstado = 2;
			$arreglo_ACE = array("objArchivo"=>$elObjArchivoCargado, "descripcion"=>$descripcion, "usuario"=>$usuario_ace, "idestado"=>$idEstado, "clave"=>2);
			$resp = $this->crearNuevoEstado($arreglo_ACE);
			//mando a crear el nuevo estado, devuelve true o false
			if($resp){
				//guardo el nuevo nombre del archivo
				if($this->renovarNombre($param['acnombre'], $param['aclinkacceso'])){
					$respuesta = "el archivo se compartio correctamente";
				}
			} else {
				$respuesta = "el archivo NO se compartio correctamente";
			}
		} else{
			$respuesta = "el archivo NO se compartio correctamente";
		}
	} else {
		$respuesta = "el archivo NO se compartio correctamente";
	}
	return $respuesta;
}

/*
*ABM REALIZAR DEJAR DE COMPARTIR
*/
/**
*metodo que cambia el estado del archivo a dejar de compartir
*@param array $param
*@return string $respuesta
*/
public function realizarDejarCompartir($param){
	$resp = false;
	$respuesta ="";
	//RECUPERO TODOS LOS DATOS DEL ARCHIVO
	$idArchivo = $param['idarchivocargado'];
	$condicion = "idarchivocargado = $idArchivo";
	//voy a buscar el objeto archivo a la bbdd
	$listaAbmAC = $this->buscarCondicion($condicion);
	$archivo = $listaAbmAC[0];
	//seteo los atributos al arreglo param, a partir de los datos provenientes del objeto
	$param['idarchivocargado']=$archivo->getId();
	$param['acicono']=$archivo->getIcono();
	$param['idusuario']=$archivo->getUsuario()->getId();
	$param['acdescripcion']=$archivo->getDescripcion();
	$param['aclinkacceso']=$archivo->getLink();
	$param['accantidaddescarga']=$archivo->getCantDescarga();
	$param['acfechainiciocompartir']=$archivo->getFechaInicio();
	$param['acfechafincompartir']=$archivo->getFechaFin();
	$param['accantidadusada']=null;
	//voy a verificar que el id de archivo este presente en el paraetro
	if($this->seteadosCamposClaves($param)){
		$elObjArchivoCargado = $this->cargarObjetoConClave($param);
		if($elObjArchivoCargado!=null){
			//creo y seteo el parametro necesario para el nuevo estado dejar de compartir
			$arregloNuevoACE = array();
			$idEstado=3;
			$usuario_ace = $param['usuario_ACE'];
			$descripcion =$param['acedescripcion'];
			$arreglo_ACE = array("objArchivo"=>$elObjArchivoCargado, "descripcion"=>$descripcion, "usuario"=>$usuario_ace, "idestado"=>$idEstado, "clave"=>3);

			$resp = $this->crearNuevoEstado($arreglo_ACE);
			if($resp){
				$respuesta ="el archivo se dejo de compartir correctamente";
			} else {
				$respuesta ="el archivo NO se dejo de compartir correctamente";
			}
		}  else {
			$respuesta ="el archivo NO se dejo de compartir correctamente";
		}
	}  else {
		$respuesta ="el archivo NO se dejo de compartir correctamente";
	}
	return $respuesta;
}

/*
*ABM REALIZAR BAJA DE ARCHIVO
*/
/**
*metodo que cambia el estado del archivo a dado de baja
*@param array $param
*@return string $respuesta
*/
public function realizarBaja($param){
	$resp = false;
	$respuesta ="";
	//RECUPERO TODOS LOS DATOS DEL ARCHIVO
	$idArchivo = $param['idarchivocargado'];
	$condicion = "idarchivocargado = $idArchivo";
	//voy a buscar el objeto archivo a la bbdd
	$listaAbmAC = $this->buscarCondicion($condicion);
	$archivo = $listaAbmAC[0];
	//seteo los atributos al arreglo param, a partir de los datos provenientes del objeto
	$param['idarchivocargado']=$archivo->getId();
	$param['acicono']=$archivo->getIcono();
	$param['idusuario']=$archivo->getUsuario()->getId();
	$param['acdescripcion']=$archivo->getDescripcion();
	$param['aclinkacceso']=$archivo->getLink();
	$param['accantidaddescarga']=$archivo->getCantDescarga();
	$param['acfechainiciocompartir']=$archivo->getFechaInicio();
	$param['acfechafincompartir']=$archivo->getFechaFin();
	$param['accantidadusada']=null;
	//voy a verificar que el id de archivo este presente en el paraetro
	if($this->seteadosCamposClaves($param)){
		$elObjArchivoCargado = $this->cargarObjetoConClave($param);
		if($elObjArchivoCargado!=null){
			//creo y seteo el parametro necesario para el nuevo estado dejar de compartir
			$arregloNuevoACE = array();
			$idEstado=4;
			$usuario_ace = $param['usuario_ACE'];
			$descripcion =$param['acedescripcion'];
			$arreglo_ACE = array("objArchivo"=>$elObjArchivoCargado, "descripcion"=>$descripcion, "usuario"=>$usuario_ace, "idestado"=>$idEstado, "clave"=>4);

			$resp = $this->crearNuevoEstado($arreglo_ACE);
			if($resp){
				$respuesta ="el archivo se dio de baja correctamente";
			} else {
				$respuesta ="el archivo NO se dio de baja correctamente";
			}
		}  else {
			$respuesta ="el archivo NO se dio de baja correctamente";
		}
	}  else {
		$respuesta ="el archivo NO se dio de baja correctamente";
	}
	return $respuesta;
}

/**
*metodo para crear un estado cada vez que el usuario lo solicite: cargar, compartir, dejar de compartir, eliminar
*@param array $param
*@return boolean $resp
*/
private function crearNuevoEstado($param){
	$resp = false;
	//recupero los datos necesarios para las diferentes acciones
	$idEstadoTipos = $param['idestado'];
	$objArchivo = $param['objArchivo'];
	$descripcion = $param['descripcion'];
	$usuario = $param['usuario'];
	//fijo la fecha de hoy para crear el nuevo estado
	$objFecha =date("Y-m-d H:i:s");
	$fechaFin = null;
	//busco el estado que el usuario solicita en la bbdd
	$objAbmEstadoTipos = new AbmEstadoTipos;
	$datosEstado['idestadotipos']=$idEstadoTipos;
	$listaestado = $objAbmEstadoTipos->buscar($datosEstado);
	$unEstado = $listaestado[0];
	//en caso de no ser un alta, se debe actualizar el estado anterior
	if($param['clave']!=0){
	//creo un objeto de archivo cargado estado
		$objACE = new AbmArchivoCargadoEstado();
	//recupero el id del archivo
		$idarchivocargado = $objArchivo->getId();
	//busco el ultimo objeto archivo cargado estado de dicho archivo
		$condicion = "acefechafin = '0000-00-00 00:00:00' AND idarchivocargado = '$idarchivocargado'";
		$listaHistorialEstados = $objACE ->buscarCondicion($condicion);
		$ultimoEstado = $listaHistorialEstados[0];
	//recupero el id del ultimo estado del archivo
		$id = $ultimoEstado->getIdEstado();
	//recupero los atributos de la tupla para modificar el estado actual
		$idUltimoEstado = $ultimoEstado->getIdEstado();
		$idestadoTipo = $ultimoEstado->getIdTipos()->getId();
		$descripcion = $ultimoEstado->getDescripcion();
		$usuario = $ultimoEstado->getUsuario()->getId();
		$fechaInicio = $ultimoEstado->getFechaInicio();
		$idarchivocargado = $ultimoEstado->getIdArchivo()->getId();
	//genero el arreglo para mandar a modificar
		$anteriorAce=array("idarchivocargadoestado"=>$idUltimoEstado, "idestadotipos"=>$idestadoTipo, "acedescripcion"=>$descripcion, "idusuario"=>$usuario, "acefechaingreso"=>$fechaInicio, "acefechafin"=>$objFecha, "idarchivocargado"=>$idarchivocargado);
		$resp = $objACE->modificacion($anteriorAce);
	}

	//armo el arreglo para crear el nuevo archivo cargado estado
	$arreglo_nuevoACE = array("idarchivocargadoestado"=>null, "idestadotipos"=>$idEstadoTipos, "acedescripcion"=>$descripcion,"idusuario"=> $usuario,"acefechaingreso"=> $objFecha, "acefechafin"=>$fechaFin, "idarchivocargado"=> $objArchivo->getId());
	//mando a crear el objeto archivo cargado estado
	$archivoCargadoEstado = new AbmArchivoCargadoEstado();
	$resp = $archivoCargadoEstado->alta($arreglo_nuevoACE);
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
	$archivoCargado = new ArchivoCargado();
	$arreglo = $archivoCargado->listar($where);
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
		if(isset($param['idarchivocargado']))
			$where.=" and idarchivocargado=".$param['idarchivocargado'];
		if(isset($param['nombre']))
			$where.=" and acnombre=".$param['nombre'];
		if(isset($param['descripcion']))
			$where.=" and acdescripcion=".$param['descripcion'];
		if(isset($param['icono']))
			$where.=" and acicono=".$param['icono'];
		if(isset($param['usuario']))
			$where.=" and idusuario=".$param['usuario'];
		if(isset($param['link']))
			$where.=" and aclinkacceso=".$param['link'];
		if(isset($param['cantDescarga']))
			$where.=" and accantidaddescarga=".$param['cantidadDescarga'];
		if(isset($param['cantidadUsada']))
			$where.=" and accantidadusada=".$param['cantidadUsada'];
		if(isset($param['acfechainiciocompartir']))
			$where.=" and acfechainiciocompartir=".$param['acfechainiciocompartir'];
		if(isset($param['acfechafincompartir']))
			$where.=" and acfechafincompartir=".$param['acfechafincompartir'];
		if(isset($param['clave']))
			$where.=" and acprotegidoclave=".$param['clave'];

	}
	$archivoCargado = new ArchivoCargado();
	$arreglo = $archivoCargado->listar($where);
	return $arreglo;
}

}
?>