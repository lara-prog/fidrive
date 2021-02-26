<!doctype html>
<html lang="es">
<head>
  <!--SESION-->
  <?php
  //dejar el include de configuracion!!!!!!
  include_once("../../configuracion.php");
  $sesion = new Session();
  if(!$sesion->sesionActiva()||!$sesion->validar()) {
    header("Location:login.php");
  } else {
    $idusuario=$sesion->getIdUsuario();
    $condicion = "idusuario = '".$idusuario."'";
    $objUsuario = new AbmUsuario();
    $usuarios = $objUsuario->buscarCondicion($condicion);
    //print_r($usuarios);
    if(count($usuarios)!=0){
      $usuario = $usuarios[0];
      $nombreUsuario = $usuario->getNombre()." ".$usuario->getApellido();
    }
  }
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
  <link rel="stylesheet" type="text/css" href="../css/estilos.css">

  <!--editor de texto enriquecido-->
  <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

  <title><?php $Titulo?></title>

</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand mb-0 h1"  href="paginaprincipal.php">
     <img src="fai.ico" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
   FIDRIVE</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ">
      <li class="nav-item active">
        <a class="nav-link" href="paginaprincipal.php">Home <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Archivos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="contenido.php">Ver Archivos</a>
          <a class="dropdown-item" href="compartidos.php">Ver Compartidos</a>
        </div>
      </li>
      <?php
      if($sesion->esAdmin()){
        echo '<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Gestion de Usuarios
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="usuariosregistrados.php">Ver Usuarios</a>
        <a class="dropdown-item" href="roles.php">Ver Roles</a>
        </div>
        </li>';

      }
      ?>

      <li class="nav-item">
        <a class="nav-link" href="accioncerrarsesion.php">Salir</a>
      </li>

    </ul>
     <span class="navbar-text">
      <?php echo "Usuario: ".$nombreUsuario; ?>
    </span>
  </div>
</div>
</nav>

<div class="container-fluid">
  <div class="row">

    <main role="main" class="col-md-12 ml-sm-auto px-md-4">
               <!-- <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                        </div>
                    </div>
                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:200%;height:200%;left:0; top:0">
                        </div>
                    </div>
                </div>-->