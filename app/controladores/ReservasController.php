<?php

class ReservasController {
    function confirmarReserva() {
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
        
        if ($usuarioDAO->obtenerPorId($_SESSION['idUsuario'])->getEstado()=="inactivo") {
            MensajeFlash::guardarMensaje("No puedes reservar");
            header("Location: index.php");
            die();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            
            $fecha = date('Y-m-d', strtotime('+1 day'));
            $fechaLimite=date('Y-m-d', strtotime('+8 day'));

            if ($fecha<=$_SESSION['fecha'] && $_SESSION['fecha']<$fechaLimite) {
                $fecha = $_SESSION['fecha'];
            }else{
                header('Location: index.php?action=reservar');
                die();
            }
            
            $numLineas=$_SESSION['numLineasN'];
            $infoReservas=$_SESSION['infoReservas'];
            $pistasDAO=new PistaDAO(ConexionBD::conectar());
            $total=0;
            $info="";
            $parte2="";
            $lineas = array();
            for ($j=0; $j<$numLineas; $j++){
        
                if ($j==0 && $numLineas!=1) {
                    $info= substr($infoReservas,0,strpos($infoReservas, ","));
                    $parte2=substr($infoReservas,strpos($infoReservas, ",")+1);
                }else if($numLineas==1){
                    $info=$infoReservas;
                }else if(($numLineas-1)==$j){
                    $info=substr($parte2,0);
                }else{
                    $info= substr($parte2,0,strpos($parte2, ","));
                    $parte2=substr($parte2,strpos($parte2, ",")+1);
                }


                $idPista= substr($info,0,strpos($info,"-"));

                $hora= substr($info,strpos($info,"-")+1);

                $lineaAcabada = new lineaReserva();
                $lineaAcabada->setIdPista($idPista);
                $lineaAcabada->setHora($hora);
                $lineaAcabada->setFecha($fecha);

                $lineas[]=$lineaAcabada;
                $total=$total+$pistasDAO->obtener($lineaAcabada->getIdPista())->getPrecio();
            }
            
            $reservaDAO = new ReservaDAO(ConexionBD::conectar());
            $reserva = new Reserva();

            $fecha_actual = new DateTime();
            $hora_actual = $fecha_actual->format('Y-m-d H:i:s');
            $reserva->setFecha($hora_actual);
            
            $reserva->setPrecio($total);
            $reserva->setIdUsuario($_SESSION['idUsuario']);
            $idReserva = $reservaDAO->insertar($reserva);

            $lineaReservaDAO = new lineasReservaDAO(ConexionBD::conectar());
            for ($j = 0; $j < count($lineas); $j++) {
                $lineaReserva = $lineas[$j];
                $lineaReserva->setIdReserva($idReserva);
                $lineaReservaDAO->insertar($lineaReserva);
            }
            unset($_SESSION['lineasReservas']);
            unset($_SESSION['fecha']);
            unset($_SESSION['infoReservas']);
            unset($_SESSION['numLineasN']);
            header('Location: index.php?action=listarReservas');
            die();
        }
        
        $fecha = date('Y-m-d', strtotime('+1 day'));
        $fechaLimite=date('Y-m-d', strtotime('+8 day'));
        
        if ($fecha<=$_GET['fecha'] && $_GET['fecha']<$fechaLimite) {
            $fecha = $_GET['fecha'];
        }else{
            header('Location: index.php?action=reservar');
            die();
        }
        
        $infoReservas = $_GET['infoReservas'];
        $_SESSION['infoReservas']=$infoReservas;
        
        $numLineas = $_GET['numArray'];
        $_SESSION['numLineasN']=$numLineas;
        
        $pistasDAO=new PistaDAO(ConexionBD::conectar());
        $lineas = array();
        $info="";
        $parte2="";
        $total=0;
        
        for ($j=0; $j<$numLineas; $j++){
        
            if ($j==0 && $numLineas!=1) {
                $info= substr($infoReservas,0,strpos($infoReservas, ","));
                $parte2=substr($infoReservas,strpos($infoReservas, ",")+1);
            }else if($numLineas==1){
                $info=$infoReservas;
            }else if(($numLineas-1)==$j){
                $info=substr($parte2,0);
            }else{
                $info= substr($parte2,0,strpos($parte2, ","));
                $parte2=substr($parte2,strpos($parte2, ",")+1);
            }


            $idPista= substr($info,0,strpos($info,"-"));

            $hora= substr($info,strpos($info,"-")+1);
            
            $lineaAcabada = new lineaReserva();
            $lineaAcabada->setIdPista($idPista);
            $lineaAcabada->setHora($hora);
            $lineaAcabada->setFecha($fecha);
            
            $lineas[]=$lineaAcabada;
            $total=$total+$pistasDAO->obtener($lineaAcabada->getIdPista())->getPrecio();
        }
        
        $_SESSION['fecha'] = $fecha;
        
        $pagina="confirmarReserva";
        require 'app/vistas/confirmarReserva.php';
    }
    
    function borrarReserva() {
        header("Content-type: application/json; charset=utf-8");

        if (!isset($_POST['id'])) {
            print json_encode(["error" => "falta parametro id"]);
            die();
        }

        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $reservadao = new ReservaDAO(ConexionBD::conectar());
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());

        $reserva=$reservadao->obtener($id);
        if ($_SESSION['idUsuario']==$reserva->getIdUsuario() || $usuarioDAO->obtenerPorId($_SESSION['idUsuario'])->getRol()=="admin") {
            
            $lineasReservasDAO=new lineasReservaDAO(ConexionBD::conectar());
            $lr=$lineasReservasDAO->obtenerPorReserva($reserva->getId());
            $fechaLr=$lr[0]->getFecha();
            
            if ($fechaLr>date('Y-m-d')) {
                if ($reservadao->borrar($reserva)) {
                    $lineas=$lineasReservasDAO->obtenerPorReserva($id);
                    for ($i = 0; $i < count($lineas); $i++) {
                        $lineasReservasDAO->borrar($lineas[$i]);
                    }
                    print json_encode(array("resultado" => true));
                } else {
                    print json_encode(array("resultado" => false));
                }
            }else{
                print json_encode(array("resultado" => false));
            }
        }else{
            print json_encode(array("resultado" => false));
        }
        
    }
    
    function filtrarReservas() {
        $palabraClave = htmlentities($_POST['palabraClave']);
        $filtro = htmlentities($_POST['filtro']);
        
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
        $usuarioComp=$usuarioDAO->obtenerPorId($_SESSION['idUsuario']);

        $reservadao = new ReservaDAO(ConexionBD::conectar());
        $reservas = null;
        if ($usuarioComp->getRol()=="admin") {
            switch ($filtro) {
                case "id":
                    $array = array();
                    if (!$reservas = $reservadao->obtener($palabraClave)) {
                        $array[] = -1;
                    } else {
                        $array[] = $reservas->getId();
                    }
                    $reservas = $array;
                    break;
                case "idUsuario":
                    $reservas = $reservadao->obtenerPorUsuarioAjax($palabraClave);
                    break;
                case "precio":
                    $reservas = $reservadao->obtenerPorPrecioAjax($palabraClave);
                    break;
                case "fechaReserva":
                    $cont_fechas = array();
                    $array=$reservadao->obtenerTodosAjax();
                    
                    for ($i = 0; $i < count($array); $i++) {
                        if ($reservas = $reservadao->obtenerPorFechaAjax($palabraClave,$array[$i])) {
                            $cont_fechas[] = $reservas;
                        }
                    }
                    
                    if (count($cont_fechas)==0) {
                        $cont_fechas[]=-1;
                    }
                    
                    $reservas = $cont_fechas;
                    break;
                default:
                    $reservas = $reservadao->obtenerTodosAjax();
                    break;
            }
        }else{
            switch ($filtro) {
                case "id":
                    $array = array();
                    if (!$reservas = $reservadao->obtenerEspUser($palabraClave,$_SESSION['idUsuario'])) {
                        $array[] = -1;
                    } else {
                        $array[] = $reservas->getId();
                    }
                    $reservas = $array;
                    break;
                case "precio":
                    $reservas = $reservadao->obtenerPorPrecioAjaxEspUser($palabraClave,$_SESSION['idUsuario']);
                    break;
                case "fechaReserva":
                    $cont_fechas = array();
                    $array=$reservadao->obtenerTodosAjaxEspUser($_SESSION['idUsuario']);
                    
                    for ($i = 0; $i < count($array); $i++) {
                        if ($reservas = $reservadao->obtenerPorFechaAjax($palabraClave,$array[$i])) {
                            $cont_fechas[] = $reservas;
                        }
                    }
                    
                    if (count($cont_fechas)==0) {
                        $cont_fechas[]=-1;
                    }
                    
                    $reservas = $cont_fechas;
                    break;
                default:
                    $reservas = $reservadao->obtenerTodosAjaxEspUser($_SESSION['idUsuario']);
                    break;
            }
        }
        
        header("Content-type: application/json; charset=utf-8");
        print json_encode(array("resultado" => true, "reservas" => $reservas));
        exit;
    }
    
    function irLineas(){
        $idReserva=filter_var($_GET["idReserva"],FILTER_SANITIZE_NUMBER_INT);
        
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
        $reservadao = new ReservaDAO(ConexionBD::conectar());
        $lineasReservasDAO=new lineasReservaDAO(ConexionBD::conectar());
        $pistasDAO = new PistaDAO(ConexionBD::conectar());
        
        $reserva=$reservadao->obtener($idReserva);
        $lineas=null;
        if ($_SESSION['idUsuario']==$reserva->getIdUsuario() || $usuarioDAO->obtenerPorId($_SESSION['idUsuario'])->getRol()=="admin") {
            $lineas=$lineasReservasDAO->obtenerPorReserva($idReserva);
        }else{
            MensajeFlash::guardarMensaje("No te pertenece");
            header("Location: index.php");
            die();
        }        
        $fecha=$lineas[0]->getFecha();
        $borrado=false;
        if ($fecha>date('Y-m-d')) {
            $borrado=true;
        }
        $pagina="listaLineas";
        require 'app/vistas/listaLineas.php';
    }
    
    function borrarLinea(){
        header("Content-type: application/json; charset=utf-8");

        if (!isset($_POST['id'])) {
            print json_encode(["error" => "falta parametro id"]);
            die();
        }

        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $reservadao = new ReservaDAO(ConexionBD::conectar());
        $lineasReservasDAO=new lineasReservaDAO(ConexionBD::conectar());
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
        $pistasDAO = new PistaDAO(ConexionBD::conectar());
        
        if ($lineaRes=$lineasReservasDAO->obtener($id)) {
            
            $reserva=$reservadao->obtener($lineaRes->getIdReserva());
            
            if ($_SESSION['idUsuario']==$reserva->getIdUsuario() || $usuarioDAO->obtenerPorId($_SESSION['idUsuario'])->getRol()=="admin") {

                $fechaLr=$lineaRes->getFecha();

                if ($fechaLr>date('Y-m-d')) {
                    
                    $idPist=$lineaRes->getIdPista();
                    $pista=$pistasDAO->obtener($idPist);
                    $precio=$pista->getPrecio();
                    
                    if ($lineasReservasDAO->borrar($lineaRes)) {
                        
                        $totalRes=$reserva->getPrecio()-$precio;
                        
                        if ($totalRes==0) {
                            $reservadao->borrar($reserva);
                        }else{
                            $reserva->setPrecio($totalRes);
                            $reservadao->actualizar($reserva);
                        }
                        
                        print json_encode(array("resultado" => true));
                    } else {
                        print json_encode(array("resultado" => false));
                    }
                }else{
                    print json_encode(array("resultado" => false));
                }
            }else{
                print json_encode(array("resultado" => false));
            }
        }else{
            print json_encode(array("resultado" => false));
        }
    }
}
