<?php
$Titulo = " accion";
//include_once("../../configuracion.php");
include_once("../estructura/cabecera.php");
?>
<?php
$realizado="";
$respuesta="";
$datos = data_submitted();
$accion = "";
//echo "imprimo los datos que llegan a accion";
//print_r($datos);
if(!empty($datos)){
  $accion = $datos['accion'];
  $objUsuario = new AbmUsuario();
//crear usuarioz
  if($accion==1){
    //busco que el login sea unico
    $login  = $datos['uslogin'];
    $condicion = "uslogin = '". $login."'";
    $usuarios = $objUsuario->buscarCondicion($condicion);
    $accion = "crear usuario";
    $realizado = false;
    //sino lo encuentro creo el usuario
    if(count($usuarios)==0){
      $realizado = $objUsuario->alta($datos);
      $accion = "crear usuario";
    }
  }

  if($accion!=1){
            //agregar rol a usuario
    if($accion==2){
      $realizado = $objUsuario->asignarrol($datos);
      //echo $realizado;
      $accion = "asignar rol a usuario";
    }
//borrar usuario
    if($accion==3){
      $datos['usactivo']=0;
      $realizado = $objUsuario->modificacion($datos);
      $accion = "borrar usuario";
    }
//crear rol
    if($accion==4){
      $objRol = new AbmRol();
      $realizado = $objRol->alta($datos);
      $accion = "crear rol";
    }

  }

  if($realizado!="" && $realizado){
    $respuesta="Accion: ".$accion." realizada correctamente";
  } else {
    $respuesta="Accion: ".$accion." No fue realizada correctamente";
  }
}

?>
<!--IMPRIMO LAS RESPUESTAS-->
<div class="d-flex justify-content-center h-100">
  <div class="card m-3" style="height: 150px;">
    <div class="card-body justify-content-center" style="text-align: center;">
      <h3><?php
      echo $respuesta;
      //header("Location:paginaprincipal.php");
      ?></h3>
      <div class="row align-items float-right mx-auto" style="margin: 10px;">
        <a role="button" href="usuariosregistrados.php" class="btn btn-primary" >Volver</a>
      </div>
    </div>
  </div>
</div>



<?php

include_once("../estructura/pie.php");
?>