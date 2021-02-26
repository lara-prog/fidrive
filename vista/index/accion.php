<?php
$Titulo = " accion";
include_once("../estructura/cabecera.php");
//include_once("../../configuracion.php");
?>
<?php
$respuesta="";
$datos = data_submitted();
//echo "imprimo los datos que llegan a accion";
//print_r($datos);
if(!empty($datos)){
      $accion = $datos['clave'];
      $objAbmArchivoCargado = new AbmArchivoCargado();
//subir archivo
      if($accion==0){
            $respuesta = $objAbmArchivoCargado->realizarAlta($datos);
      }
//modificar archivo
      if($accion==1){
            $respuesta = $objAbmArchivoCargado->realizarModificacion($datos);
      }

      if($accion != 0 && $accion != 1){
//recupero el archivo
            $id = $datos['idarchivocargado'];
            $dataBusqueda = "idarchivocargado = ".$id;

            $listaArchivos = $objAbmArchivoCargado->buscarCondicion($dataBusqueda);
            if(count($listaArchivos)!=0){
                  $archivo = $listaArchivos[0];
//recupero el id del archivo
                  $idarchivocargado = $archivo->getId();
//creo un objeto ace para buscar el ultimo estado del archivo
                  $objACE = new AbmArchivoCargadoEstado();
                  $condicion = "acefechafin = '0000-00-00 00:00:00' AND idarchivocargado = '$idarchivocargado'";
                  $listaHistorialEstados = $objACE ->buscarCondicion($condicion);
                  $ultimoEstado = $listaHistorialEstados[0];
//recupero el id del ultimo estado para verificar si el archivo esta
//cargado = 1, compartido=2, no compartido=3
                  $idEstado = $ultimoEstado->getIdTipos()->getId();
//recupero la accion del formulario de origen

//  echo "imprimo datos que llegan a accion  ";
// print_r($datos);


//compartir archivo y verificar que no este compartido idestado = 2
                  if($accion==2){
                        if($idEstado!=2){
                              $respuesta = $objAbmArchivoCargado->realizarCompartir($datos);
                        } else {
                              $respuesta = "no se puede compartir el archivo";
                        }
                  }
//dejar de compartir archivo y verificar que no se halla dejado de compartir idestado = 3
                  if($accion==3){
                        if($idEstado!=3 && $idEstado!=0 ){
                              $respuesta = $objAbmArchivoCargado->realizarDejarCompartir($datos);
                        } else {
                              $respuesta = "no se puede dejar de compartir el archivo";
                        }
                  }


//eliminar el archivo y verificar que no se halla eliminado idestado = 4
                  if($accion==4){
                        if($idEstado!=4){
                              $respuesta = $objAbmArchivoCargado->realizarBaja($datos);
                        } else {
                              $respuesta = "no se puede eliminar el archivo";
                        }
                  }

            }
      }
}

?>
<!--IMPRIMO LAS RESPUESTAS-->
<div class="d-flex justify-content-center h-100">
      <div class="card m-3" style="height: 150px;">
            <div class="card-body justify-content-center" style="text-align: center;">
                  <h3><?php echo $respuesta?></h3>
                  <div class="row align-items float-right mx-auto" style="margin: 10px;">
                        <a role="button" href="contenido.php" class="btn btn-primary" >Volver</a>
                  </div>
            </div>
      </div>
</div>



<?php

include_once("../estructura/pie.php");
?>