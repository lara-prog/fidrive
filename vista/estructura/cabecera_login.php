<!doctype html>
<html lang="es">
<head>
    <?php
    include_once("../../configuracion.php");
    $sesion= new Session();
    ?>
    <link rel="shortcut icon" href="fai.ico">
    <!-- Required meta tags -->
    <!--formato de codificacion de caracteres-->
    <meta charset="utf-8">
    <!--esta etiqueta permite que bootstrap se adapte al dispositivo-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" >

    <!--iconos de fontawasome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


    <!--estilos-->
    <link rel="stylesheet" type="text/css" href="../css/estilos_login.css">

    <!--editor de texto enriquecido-->
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>


    <title><?php $Titulo?></title>

</head>
<body>
    <div class="container-fluid">
        <div class="row">


            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <!--<div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                        </div>
                    </div>
                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:200%;height:200%;left:0; top:0">
                        </div>
                    </div>
                </div>-->