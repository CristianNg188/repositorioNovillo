<?php

class DeporController {

    function inicio() {
       $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
       $pagina="inicio";
       require 'app/vistas/inicio.php';
    }

    function irNoticias() {
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
        $focus="no";
        if (isset($_GET['focus'])) {
            $focus=$_GET['focus'];
        }
        $pagina="noticias";
        require 'app/vistas/noticias.php';
    }

    function irActividades() {
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
        $pagina="actividades";
        require 'app/vistas/actividades.php';
    }

    function irMi() {
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
        $pagina="mi";
        require 'app/vistas/mi.php';
    }

    function irOpcionesAdm() {
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
        $pagina="opcionesAdmin";
        require 'app/vistas/opcionesAdmin.php';
    }

    function reservar() {
        
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
        
        if ($usuarioDAO->obtenerPorId($_SESSION['idUsuario'])->getEstado()=="inactivo") {
            MensajeFlash::guardarMensaje("No puedes reservar");
            header("Location: index.php");
            die();
        }
        
        $fecha = date('Y-m-d', strtotime('+1 day'));
        $fechaLimite=date('Y-m-d', strtotime('+8 day'));
        if (isset($_GET['fecha'])) {
            if ($fecha<=$_GET['fecha'] && $_GET['fecha']<$fechaLimite) {
                $fecha = $_GET['fecha'];
            }
        }

        $pistadao = new PistaDAO(ConexionBD::conectar());
        $pistas = $pistadao->obtenerTodos();

        $reservadao = new ReservaDAO(ConexionBD::conectar());
        $reservas = $reservadao->obtenerTodos();

        $lineaReservaDAO = new lineasReservaDAO(ConexionBD::conectar());
        $lineasReservas = $lineaReservaDAO->obtenerTodos();

        $tiposDeporte = $pistadao->obtenerTipos();
        
        $pagina="reservar";
        require 'app/vistas/reservar.php';
    }

    function listarUsuarios() {
        $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
        $usuarios = $usuarioDAO->obtenerTodos();
        $pagina="listaUsuarios";
        require 'app/vistas/listaUsuarios.php';
    }

    function listarPistas() {
        $pistasDAO = new PistaDAO(ConexionBD::conectar());
        $pistas = $pistasDAO->obtenerTodos();
        
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
        $pagina="listaPistas";
        require 'app/vistas/listaPistas.php';
    }

    function listarReservas() {
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
        $reservasDAO = new ReservaDAO(ConexionBD::conectar());
        
        $reservas = null; 
        $rolUser=$usuarioDAO->obtenerPorId($_SESSION['idUsuario'])->getRol();
        if ($rolUser=="admin") {
            $reservas = $reservasDAO->obtenerTodos();
        }else{
            $reservas = $reservasDAO->obtenerPorUsuario($_SESSION['idUsuario']);
        }
        $lineasReservasDAO=new lineasReservaDAO(ConexionBD::conectar());
        $pagina="listaReservas";
        require 'app/vistas/listaReservas.php';
    }
}
