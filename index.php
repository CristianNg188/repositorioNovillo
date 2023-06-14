<?php
session_start();

//////// CONTROLADOR FRONTAL /////////

/* REQUIRES DE MODELOS, CONTROLADORES Y CONFIG */
require 'app/config.php';
require 'app/utilidades/MensajeFlash.php';
require 'app/modelos/ConexionBD.php';
require 'app/modelos/Usuario.php';
require 'app/modelos/Pista.php';
require 'app/modelos/Reserva.php';
require 'app/modelos/lineaReserva.php';
require 'app/modelos/UsuarioDAO.php';
require 'app/modelos/PistaDAO.php';
require 'app/modelos/ReservaDAO.php';
require 'app/modelos/lineasReservaDAO.php';
require 'app/controladores/UsuariosController.php';
require 'app/controladores/DeporController.php';
require 'app/controladores/PistasController.php';
require 'app/controladores/ReservasController.php';

/* MAPA DE ENRUTAMIENTO */
$map = array(/*----------------*/
    "inicio" => array("controller" => "DeporController", "method" => "inicio", "publica" =>true, "rolAdmin" =>false),
    "noticias" => array("controller" => "DeporController", "method" => "irNoticias", "publica" =>true, "rolAdmin" =>false),
    "actividades" => array("controller" => "DeporController", "method" => "irActividades", "publica" =>true, "rolAdmin" =>false),
    "mi" => array("controller" => "DeporController", "method" => "irMi", "publica" =>true, "rolAdmin" =>false),
    "login" => array("controller" => "UsuariosController", "method" => "login", "publica" =>true, "rolAdmin" =>false),
    "logout" => array("controller" => "UsuariosController", "method" => "logout", "publica" =>false, "rolAdmin" =>false),
    "registroUser" => array("controller" => "UsuariosController", "method" => "registroUser", "publica" =>true, "rolAdmin" =>false),
    "reservar" => array("controller" => "DeporController", "method" => "reservar", "publica" =>false, "rolAdmin" =>false),
    "confirmarReserva" => array("controller" => "ReservasController", "method" => "confirmarReserva", "publica" =>false, "rolAdmin" =>false),
    "OpcionesAdmim" => array("controller" => "DeporController", "method" => "irOpcionesAdm", "publica" =>false, "rolAdmin" =>true),
    "registroAdmin" => array("controller" => "UsuariosController", "method" => "registroAdmin", "publica" =>false, "rolAdmin" =>true),/*Lista de usuarios*/
    "comprobar_email" => array("controller" => "UsuariosController", "method" => "comprobar_email", "publica" =>true, "rolAdmin" =>false),
    "comprobar_dni" => array("controller" => "UsuariosController", "method" => "comprobar_dni", "publica" =>true, "rolAdmin" =>false),
    "comprobar_emailExiste" => array("controller" => "UsuariosController", "method" => "comprobar_emailExiste", "publica" =>true, "rolAdmin" =>false),
    "comprobar_usuarioExiste" => array("controller" => "UsuariosController", "method" => "comprobar_usuarioExiste", "publica" =>true, "rolAdmin" =>false),
    "cambiarAtributoUsuario" => array("controller" => "UsuariosController", "method" => "cambiarAtributoUsuario", "publica" =>false, "rolAdmin" =>true),
    "listarUsuarios" => array("controller" => "DeporController", "method" => "listarUsuarios", "publica" =>false, "rolAdmin" =>true),
    "filtrarUsuarios" => array("controller" => "UsuariosController", "method" => "filtrarUsuarios", "publica" =>false, "rolAdmin" =>true),
    "borrarUsuario" => array("controller" => "UsuariosController", "method" => "borrarUsuario", "publica" =>false, "rolAdmin" =>true),/*fin lista usuarios*/
    "PerfilUsuario" => array("controller" => "UsuariosController", "method" => "perfil", "publica" =>false, "rolAdmin" =>false),/*Parte del perfil*/
    "cambiarContra" => array("controller" => "UsuariosController", "method" => "cambiarContra", "publica" =>false, "rolAdmin" =>false),
    "darseBaja" => array("controller" => "UsuariosController", "method" => "darseBaja", "publica" =>false, "rolAdmin" =>false),
    "listarPistas" => array("controller" => "DeporController", "method" => "listarPistas", "publica" =>false, "rolAdmin" =>true),/*Lista de pistas*/
    "filtrarPistas" => array("controller" => "PistasController", "method" => "filtrarPistas", "publica" =>false, "rolAdmin" =>true),
    "crearPistas" => array("controller" => "PistasController", "method" => "crearPistas", "publica" =>false, "rolAdmin" =>true),
    "compruebaNumeroExiste" => array("controller" => "PistasController", "method" => "compruebaNumeroExiste", "publica" =>false, "rolAdmin" =>true),
    "borrarPista" => array("controller" => "PistasController", "method" => "borrarPista", "publica" =>false, "rolAdmin" =>true),/*fin lista pista*/
    "listarReservas" => array("controller" => "DeporController", "method" => "listarReservas", "publica" =>false, "rolAdmin" =>false),/*Lista de reservas*/
    "borrarReserva" => array("controller" => "ReservasController", "method" => "borrarReserva", "publica" =>false, "rolAdmin" =>false),
    "filtrarReservas" => array("controller" => "ReservasController", "method" => "filtrarReservas", "publica" =>false, "rolAdmin" =>false),
    "listaLineas" => array("controller" => "ReservasController", "method" => "irLineas", "publica" =>false, "rolAdmin" =>false),
    "borrarLinea" => array("controller" => "ReservasController", "method" => "borrarLinea", "publica" =>false, "rolAdmin" =>false)
);

/* PARSEO DE LA RUTA */
if (!isset($_GET['action'])) {   
    $action = 'inicio';
} else {
    if (!isset($map[$_GET['action']])) {  //Si no existe la acción en el mapa
        print "La acción indicada no existe.";
        header('Status: 404 Not Found');
        die();
    } else {
        $action = filter_var($_GET['action'], FILTER_SANITIZE_SPECIAL_CHARS);
    }
}

if (isset($_SESSION['uid'])) {
    $uid=$_SESSION['uid'];
    $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
    $usuario=$usuarioDAO->obtenerPorUid($uid);
    if (!$usuario) {
        if (isset($_SESSION['usuario'])) {
            unset($_SESSION['usuario']);
        }
        if (isset($_SESSION['idUsuario'])) {
            unset($_SESSION['idUsuario']);
        }
        unset($_SESSION['uid']);
    }else{
        $_SESSION['usuario'] = $usuario->getUsuario();
        $_SESSION['idUsuario'] = $usuario->getId();
    }
}else{
    if (isset($_SESSION['usuario'])) {
        unset($_SESSION['usuario']);
    }
    if (isset($_SESSION['idUsuario'])) {
        unset($_SESSION['idUsuario']);
    }
}

if (!isset($_SESSION['idUsuario']) && isset($_COOKIE['uid'])){
    $uid= filter_var($_COOKIE['uid'],FILTER_SANITIZE_STRING);
    
    $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
    $usuario=$usuarioDAO->obtenerPorUid($uid);
    
    if (!$usuario) {
        setcookie("uid", "", time()-5);
        header("Location: index.php");
    }else{
        $_SESSION['usuario'] = $usuario->getUsuario();
        $_SESSION['idUsuario'] = $usuario->getId();
        $_SESSION['uid']=$uid;
        
        setcookie("uid",$uid, time()+7*24*60*60);
    }
}



//Seguridad
if (!$map[$action]["publica"] && !isset($_SESSION['idUsuario'])) {
    MensajeFlash::guardarMensaje("Debes identificarte");
    header("Location: index.php");
    die();
}

if(!$map[$action]["publica"] && $map[$action]["rolAdmin"]){
    $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
    $userComprueba=$usuarioDAO->obtenerPorId($_SESSION['idUsuario']);
    if ($userComprueba->getRol()!="admin") {
        MensajeFlash::guardarMensaje("Debes ser administrador");
        header("Location: index.php");
        die();
    }
}

/* EJECUTAMOS EL CONTROLADOR NECESARIO */
$controller = $map[$action]['controller'];
$method = $map[$action]['method'];

if (method_exists($controller, $method)) {
    $obj_controller = new $controller();
    $obj_controller->$method();
} else {
    header('Status: 404 Not Found');
    echo "El método $method del controlador $controller no existe.";
}