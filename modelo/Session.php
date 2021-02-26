<?php
class Session{
    public function __construct() {
        if(session_start()) {
        }
    }

//CARGO ID, LOGIN, ROL AL ARREGLO
    public function iniciar($idusuario, $uslogin, $usrol) {
        $realizado =false;
        if($this->sesionActiva()) {
            if($idusuario!=null && $uslogin!=null && $usrol!=null) {
                $_SESSION['idusuario']=$idusuario;
                $_SESSION['uslogin']=$uslogin;
                $_SESSION['usrol']=$usrol;
                $realizado =true;
            }
        }
        return $realizado;
    }

//VERIFICO SI EXITE UNA SESION ACTIVA
    public function sesionActiva() {
        $activa=false;
        if(session_status()===PHP_SESSION_ACTIVE) {
            $activa=true;
        }
        return $activa;
    }
//VERIFICO SI EXITE UN USUARIO LOGUEADO
    public function validar() {
        $inicia=false;
        if(isset($_SESSION['uslogin'])) {
           $inicia=true;
       }
       return $inicia;
   }

//VERIFICO QUE EL USUARIO SEA ADMINISTRADOR
   public function esAdmin(){
    $esAdmin = false;
    if ($_SESSION['usrol']=="administrador"){
        $esAdmin = true;
    }
    return $esAdmin;
}

//CIERRO LA SESION
public function cerrarSesion() {
    $cerrar=false;
    if(session_destroy()) {
        $cerrar=true;
        header("Location:login.php");
    }
    return $cerrar;
}

//DEVUELVO EL ARREGLO EN STRING
public function toString(){
    return print_r($_SESSION);
}

//METODOS GETS
public function getIdUsuario(){
    return $_SESSION['idusuario'];
}

public function getUsLogin(){
    return $_SESSION['uslogin'];
}

public function getUsRol(){
    return $_SESSION['usrol'];
}

    //public function __construct() {
      //  if(session_start()) {
            //$this->usuario=null;
            //$this->password=null;
            //$this->rol=null;
            //$this->mensajeoperacion="";
        //}
    //}

    //public function iniciar($uslogin, $usrol) {
    //    $realizado =false;
    //    if($this->sesionActiva()) {
    //        if($uslogin!=null && $usrol!=null) {
    //            $_SESSION['uslogin']=$uslogin;
                //$this->setIdUsuario($uslogin);
               // $_SESSION['usclave']=$uspass;
               // $this->setUsPass($uspass);
    //            $_SESSION['usrol']=$usrol;
                //$this->setUsRol($usrol);
    //            $realizado =true;
    //        }
    //    }
    //    return $realizado;
    //}
    //public function setIdUsuario($idusuario) {
    //    $this->usuario = $idusuario;
    //}

    //public function setUsPass($uspass) {
    //    $this->password = $uspass;
    //}

    //public function setUsRol($usrol) {
    //    $this->rol = $usrol;
    //}

   // public function getIdUsuario() {
    //    if($this->sesionActiva()) {
    //        $abmUsuario = new AbmUsuario();
    //        $condicion=['idusuario'=>$_SESSION['idusuario']];
    //        $usuarios= $abmUsuario->buscar($condicion);
    //        if(count($usuarios)==1) {
    //            $unUsuario = $usuarios[0];
    //        }
    //    }
    //    return $unUsuario;
    //}

    //public function getIdPassword() {
    //    if($this->sesionActiva()) {
    //        $abmUsuario = new AbmUsuario();
    //        $condicion=['idusuario'=>$_SESSION['usclave']];
    //        $usuarios= $abmUsuario->buscar($condicion);
    //        if(count($usuarios)==1) {
    //            $unUsuario = $usuarios[0];
    //            $clave = $unUsuario->getPass();
    //        }
    //    }
    //    return $unUsuario;
    //}

    //public function getUsuarioRol() {
    //    if($this->sesionActiva()) {
    //        $abmUsuarioRol = new AbmUsuarioRol();
    //        $condicion=['idusuario'=>$_SESSION['idusuario']];
    //        $usuarioRol = $abmUsuarioRol->buscar($condicion);
    //        if(count($usuarioRol)==1) {
    //            $idrol = $usuarioRol->getIdRol();
    //            $abmRol = new AbmRol();
    //            $condicion = ['idrol'=>$idrol];
    //            $objrol = $abmRol->buscar($condicion);
    //            if(count($objrol)==1) {
    //                $rol = $objrol->getDescripcion();
    //            }
    //        }
    //    }
    //    return $rol;
    //}


    //public function getMensajeoperacion() {
    //    return $this->mensajeoperacion;
    //}

    //public function setMensajeoperacion($mensajeoperacion) {
    //    $this->mensajeoperacion = $mensajeoperacion;
    //}




}