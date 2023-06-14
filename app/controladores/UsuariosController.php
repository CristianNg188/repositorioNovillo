<?php

class UsuariosController {
    
    function registroAdmin(){
        $email="";
        $nombre="";
        $dni="";
        $telefono="";
        $poblacion="";
        $rol="user";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $dni= filter_var($_POST['dni'], FILTER_SANITIZE_STRING);
            $telefono = filter_var($_POST['tel'], FILTER_SANITIZE_NUMBER_INT);
            $poblacion = filter_var($_POST['poblacion'], FILTER_SANITIZE_STRING);
            $rol = filter_var($_POST['rol'], FILTER_SANITIZE_STRING);
            
            $usuario = new Usuario();
            $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
            
            $usuario->setEmail($email);
            $usuario->setNombre($nombre);
            $usuario->setDni($dni);
            $usuario->setTelefono($telefono);
            $usuario->setPoblacion($poblacion);
            $usuario->setRol($rol);
            $usuario->setEstado("activo");
            
            $usuarioDAO->insertar($usuario);

            header('Location: index.php');
            die();
            
        }
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
        $pagina="registroAdmin";
        require 'app/vistas/registroAdmin.php';
    }
    
    function comprobar_email(){
        header("Content-type: application/json; charset=utf-8");
        
        if (!isset($_POST['email'])) {
            print json_encode(["error"=>"falta parametro email"]);
            die();
        }
        
        $email= filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $usuarioDAO= new UsuarioDAO(ConexionBD::conectar());
        if($usuarioDAO->obtenerPorEmail($email)){
            print json_encode(array("existe"=>true));
        }else{
            print json_encode(array("existe"=>false));
        }
        if (!isset($_GET['rapido'])){
            sleep(1);
        }
    }
    
    function comprobar_dni(){
        header("Content-type: application/json; charset=utf-8");
        
        if (!isset($_POST['dni'])) {
            print json_encode(["error"=>"falta parametro dni"]);
            die();
        }
        
        $dni= filter_var($_POST['dni'],FILTER_SANITIZE_EMAIL);
        $usuarioDAO= new UsuarioDAO(ConexionBD::conectar());
        if($usuarioDAO->obtenerPorDni($dni)){
            print json_encode(array("existe"=>true));
        }else{
            print json_encode(array("existe"=>false));
        }
        sleep(1);
    }
        
    function registroUser(){
        $user="";
        $password="";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $user = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
            $password = filter_var($_POST['contra'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
            
            $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
            
            $usuario=$usuarioDAO->obtenerPorEmail($email);
            $passwordCodificado = password_hash($password, PASSWORD_BCRYPT);
            $usuario->setUsuario($user);
            $usuario->setContrasena($passwordCodificado);
            
            $usuarioDAO->actualizar($usuario);

            $_SESSION['usuario'] = $usuario->getUsuario();
            $_SESSION['idUsuario'] = $usuario->getId();
            
            $uid=sha1(time()+ rand());
            $usuario->setUid($uid);
            $usuarioDAO->actualizarUid($usuario);
            
            $_SESSION['uid']=$uid;
            
            header("Location: index.php");
            die();
            
        }
        
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
        $pagina="registroUser";
        require 'app/vistas/registroUser.php';
    }
    
    function comprobar_emailExiste(){
        header("Content-type: application/json; charset=utf-8");
        
        if (!isset($_POST['email'])) {
            print json_encode(["error"=>"falta parametro email"]);
            die();
        }
        
        $email= filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $usuarioDAO= new UsuarioDAO(ConexionBD::conectar());
        if($user=$usuarioDAO->obtenerPorEmail($email)){
            if ($user->getContrasena()==null) {
                print json_encode(array("existe"=>true));
            }else{
                print json_encode(array("existe"=>false));
            }
        }else{
            print json_encode(array("existe"=>false));
        }
        sleep(1);
    }
    
    function comprobar_usuarioExiste(){
        header("Content-type: application/json; charset=utf-8");
        
        if (!isset($_POST['user'])) {
            print json_encode(["error"=>"falta parametro user"]);
            die();
        }
        
        $user= filter_var($_POST['user'],FILTER_SANITIZE_EMAIL);
        $usuarioDAO= new UsuarioDAO(ConexionBD::conectar());
        if($usuarioDAO->obtenerPorUsuario($user)){
            print json_encode(array("existe"=>true));
        }else{
            print json_encode(array("existe"=>false));
        }
        sleep(1);
    }
    
    function login() {
        $pagina=filter_var($_POST['pagina'], FILTER_SANITIZE_STRING);
        $user = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
        $passwordFormulario = filter_var($_POST['contra'], FILTER_SANITIZE_STRING);
        
        $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
        $usuario = $usuarioDAO->obtenerPorUsuario($user);

        if (!$usuario || !password_verify($passwordFormulario, $usuario->getContrasena())) {  
            MensajeFlash::guardarMensaje("Usuario o contraseña incorrectos");
            header("Location: index.php?action=$pagina");
            die();
        } else {
            $_SESSION['usuario'] = $usuario->getUsuario();
            $_SESSION['idUsuario'] = $usuario->getId();
            
            $uid=sha1(time()+ rand());
            $usuario->setUid($uid);
            $usuarioDAO->actualizarUid($usuario);
            
            $_SESSION['uid']=$uid;
            
            if (isset($_POST['recuerda'])) {
                setcookie("uid",$uid, time()+7*24*60*60);
            }
            
            if ($pagina=="registroUser") {
                $pagina="inicio";
            }
            
            header("Location: index.php?action=$pagina");
            die();
        }
    }
    
    function logout() {
        session_destroy();
        setcookie("uid", "", time()-5);
        header("Location: index.php");
    }
    
    function filtrarUsuarios(){
        $palabraClave=htmlentities($_POST['palabraClave']);
        $filtro=htmlentities($_POST['filtro']);
        
        $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
        $usuarios=null;
        switch ($filtro) {
            case "id":
                $array=array();
                if (!$usuarios=$usuarioDAO->obtenerPorId($palabraClave)){
                    $array[]=-1;
                }else{
                    $array[]=$usuarios->getId();
                }
                $usuarios=$array;
                break;
            case "usuario":
                $usuarios=$usuarioDAO->obtenerPorUsuarioAjax($palabraClave);
                break;
            case "email":
                $usuarios=$usuarioDAO->obtenerPorEmailAjax($palabraClave);
                break;
            case "nombre":
                $usuarios=$usuarioDAO->obtenerPorNombreAjax($palabraClave);
                break;
            case "dni":
                $usuarios=$usuarioDAO->obtenerPorDniAjax($palabraClave);
                break;
            case "telefono":
                $usuarios=$usuarioDAO->obtenerPorTelefonoAjax($palabraClave);
                break;
            case "poblacion":
                $usuarios=$usuarioDAO->obtenerPorPoblacionAjax($palabraClave);
                break;
            case "rol":
                $usuarios=$usuarioDAO->obtenerPorRolAjax($palabraClave);
                break;
            case "estado":
                $usuarios=$usuarioDAO->obtenerPorEstadoAjax($palabraClave);
                break;            
            default:
                $usuarios=$usuarioDAO->obtenerTodosAjax();
                break;
        }
        header("Content-type: application/json; charset=utf-8");
        print json_encode(array("resultado"=>true, "usuarios" =>$usuarios)) ;
        exit;
    }
    
    function cambiarAtributoUsuario(){
        $id=$_POST['id'];
        $name=$_POST['name'];
        
        $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
        
        $usuario=$usuarioDAO->obtenerPorId($id);
        if ($usuario->getId()!=$_SESSION['idUsuario']) {
            if ($name=="rol") {
                if ($usuario->getRol()=="admin") {
                    $usuario->setRol("user");
                }else{
                    $usuario->setRol("admin");
                }
            }else{
                if ($usuario->getEstado()=="activo") {
                    $usuario->setEstado("inactivo");
                }else{
                    $usuario->setEstado("activo");
                }
            }
            $usuarioDAO->actualizar($usuario);
            header("Content-type: application/json; charset=utf-8");
            print json_encode(array("resultado"=>true));
        }else{
            header("Content-type: application/json; charset=utf-8");
            print json_encode(array("resultado"=>false));
        }
        
    }
    
    function borrarUsuario(){
        header("Content-type: application/json; charset=utf-8");
        
        if (!isset($_POST['id'])) {
            print json_encode(["error"=>"falta parametro id"]);
            die();
        }
        
        $id= filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
        $usuarioDAO= new UsuarioDAO(ConexionBD::conectar());
        if ($id!=$_SESSION['idUsuario']) {
            if ($usuarioDAO->borrar($id)){
                print json_encode(array("resultado"=>true));
            }else{
                print json_encode(array("resultado"=>false));
            }
        }else{
            print json_encode(array("resultado"=>false));
        }
    }
    
    function perfil(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $nombre= filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT);
            $poblacion = filter_var($_POST['poblacion'], FILTER_SANITIZE_STRING);
            
            $pagina=filter_var($_POST['paginitilla'], FILTER_SANITIZE_STRING);
            
            $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
            
            $usuario=$usuarioDAO->obtenerPorId($id);
            $usuario->setEmail($email);
            $usuario->setNombre($nombre);
            $usuario->setTelefono($telefono);
            $usuario->setPoblacion($poblacion);
            
            $ponerFoto=filter_var($_POST['ponerImagen'], FILTER_SANITIZE_STRING);
            if ($ponerFoto=="true") {
                $nuevoNombre = md5(rand());
                $nombreOriginal = $_FILES['foto']['name'];
                $extension = substr($nombreOriginal, strrpos($nombreOriginal, '.'));
                $nuevoNombreCompleto = $nuevoNombre . $extension;

                while (file_exists('web/imagenes/' . $nuevoNombreCompleto)) {
                    $nuevoNombre = md5(rand());
                    $nuevoNombreCompleto = $nuevoNombre . $extension;
                }

                move_uploaded_file($_FILES['foto']['tmp_name'],'web/imagenes/' . $nuevoNombreCompleto);
                if ($usuario->getFoto()!=null){
                    unlink("web/imagenes/".$usuario->getFoto());
                }
                $usuario->setFoto($nuevoNombreCompleto);
            }else if($ponerFoto=="especial"){
                if ($usuario->getFoto()!=null){
                    unlink("web/imagenes/".$usuario->getFoto());
                }
                $usuario->setFoto(null);
            }
            
            $usuarioDAO->actualizar($usuario);

            header('Location: index.php?action=PerfilUsuario&id='.$id.'&pagina='.$pagina);
            die();
            
        }
        $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
        
        $paginaAnterior=null;
        if (isset($_GET['pagina'])) {
            $paginaAnterior=$_GET['pagina'];
        }else{
            $paginaAnterior="inicio";
        }
        
        if ($paginaAnterior!="inicio" &&  $paginaAnterior!="noticias" &&  $paginaAnterior!="actividades" &&  $paginaAnterior!="mi" &&  $paginaAnterior!="reservar") {
            if ($paginaAnterior!="listarUsuarios") {
                if ($usuarioDAO->obtenerPorId($_SESSION['idUsuario'])->getRol()=="admin") {
                    $paginaAnterior="OpcionesAdmim";
                }else{
                    $paginaAnterior="inicio";
                }
            }
        }
        
        
        
        $usuario=$usuarioDAO->obtenerPorId($_GET['id']);
        $userPropio=false;
        
        if ($usuario->getId()==$_SESSION['idUsuario']) {
            $userPropio=true;
        }else{
            $usuarioComp=$usuarioDAO->obtenerPorId($_SESSION['idUsuario']);
            if ($usuarioComp->getRol()!="admin") {
                MensajeFlash::guardarMensaje("Debes ser administrador o propietario del perfil");
                header("Location: index.php");
                die();
            }
        }
        
        $pagina="perfil";
        require 'app/vistas/perfil.php';
    }
    
    
    
    function cambiarContra(){
        $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
        $nuevaContra=$_GET['contrase'];
        $id=$_GET['id'];
        
        if ($_SESSION['idUsuario']==$id) {
            $passwordCodificado = password_hash($nuevaContra, PASSWORD_BCRYPT);
            $usuario=$usuarioDAO->obtenerPorId($id);
            $usuario->setContrasena($passwordCodificado);
            $usuarioDAO->actualizar($usuario);
            header('Location: index.php?action=PerfilUsuario&id='.$id.'&pagina=inicio');
        }else{
            MensajeFlash::guardarMensaje("No tienes permisos de este perfil");
            header("Location: index.php");
            die();
        }
    }
    
    function darseBaja(){
        $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
        $id=$_GET['id'];
        if ($_SESSION['idUsuario']==$id) {
            if ($usuarioDAO->obtenerPorId($_SESSION['idUsuario'])->getRol()=="admin") {
                MensajeFlash::guardarMensaje("No puedes darte de baja siendo administrador");
                header("Location: index.php?action=PerfilUsuario&id=$id&pagina=inicio");
                die();
            }else{
                $usuarioDAO->borrar($id);
                session_destroy();
                setcookie("uid", "", time()-5);
                header("Location: index.php");
            }
        }else{
            MensajeFlash::guardarMensaje("No tienes permisos de este perfil");
            header("Location: index.php");
            die();
        }
        
        
    }
    
}