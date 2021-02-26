<?php
$PROYECTO ='progwebdin2020/fai2196fidrive';

//variable que almacena el directorio del proyecto
//$ROOT =$_SERVER['DOCUMENT_ROOT']."/$PROYECTO/";

$GLOBALS['ROOT'] =$_SERVER['DOCUMENT_ROOT'] ."/ProgWebDin2020/fai2196fidrive/";

// Variable que define la pagina de autenticacion del proyecto
$INICIO = "Location:http://".$_SERVER['HTTP_HOST']."$PROYECTO"."/Vista/Index/login.php";
//$INICIO = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/vista/index/login.php";

include_once('utiles/funciones.php');

// variable que define la pagina principal del proyecto (menu principal)
//$PRINCIPAL = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/principal.php";


//$_SESSION['ROOT']=$ROOT;


//$GLOBALS['ROOT'] =$_SERVER['DOCUMENT_ROOT'] ."/progwebdin2020/fai2196fidrive/";

//include_once("utiles/funciones.php");

//define("URL","login.php", true);



//header('Content-Type: text/html; charset=utf-8');
//header ("Cache-Control: no-cache, must-revalidate ");

//$PROYECTO ='progwebdin2020/fai2196fidrive';

//variable que almacena el directorio del proyecto
//$ROOT =$_SERVER['DOCUMENT_ROOT']."/$PROYECTO/";

//include_once($ROOT.'utiles/funciones.php');


// Variable que define la pagina de autenticacion del proyecto
//$INICIO = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/vista/login/login.php";

// variable que define la pagina principal del proyecto (menu principal)
//$PRINCIPAL = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/principal.php";


//$_SESSION['ROOT']=$ROOT;

//$GLOBALS['ROOT'] =$_SERVER['DOCUMENT_ROOT'] ."/progwebdin2020/fai2196fidrive/";

//include_once("utiles/funciones.php");

?>