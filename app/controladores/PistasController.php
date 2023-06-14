<?php

class PistasController {
    
    function filtrarPistas(){
        $palabraClave=htmlentities($_POST['palabraClave']);
        $filtro=htmlentities($_POST['filtro']);
        
        $pistasDAO = new PistaDAO(ConexionBD::conectar());
        $pistas=null;
        switch ($filtro) {
            case "id":
                $array=array();
                if (!$pistas=$pistasDAO->obtener($palabraClave)){
                    $array[]=-1;
                }else{
                    $array[]=$pistas->getId();
                }
                $pistas=$array;
                break;
            case "tipo":
                $pistas=$pistasDAO->obtenerPorTipoAjax($palabraClave);
                break;
            case "descripcion":
                $pistas=$pistasDAO->obtenerPorDescripcionAjax($palabraClave);
                break;
            case "precio":
                $pistas=$pistasDAO->obtenerPorPrecioAjax($palabraClave);
                break;           
            default:
                $pistas=$pistasDAO->obtenerTodosAjax();
                break;
        }
        header("Content-type: application/json; charset=utf-8");
        print json_encode(array("resultado"=>true, "pistas" =>$pistas)) ;
        exit;
    }
    
    function crearPistas(){
        $tipo="";
        $numero="";
        $descripcion="";
        $precio="";
        $id="";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $tipo = filter_var($_POST['tipo'], FILTER_SANITIZE_STRING);
            $numero = filter_var($_POST['numero'], FILTER_SANITIZE_NUMBER_INT);
            $descripcion = filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING);
            $precio = filter_var($_POST['precio'], FILTER_SANITIZE_NUMBER_INT);
            
            $pistasdao=new PistaDAO(ConexionBD::conectar());
            $diferentesTipos=$pistasdao->obtenerTipos();
            $igual=false;
            
            $pista=new Pista();
            foreach ($diferentesTipos as $tipejos){
                if (strcasecmp($tipejos, $tipo) == 0) {
                    $igual=true;
                    $pista->setTipo($tipejos);
                }
            }
            
            if($igual==false){
                $pista->setTipo($tipo);
            }
            
            $pista->setNumero($numero);
            $pista->setDescripcion($descripcion);
            $pista->setPrecio($precio);
            
            if ($_SESSION['$edita']) {
                $idPistaModifica=filter_var($_POST['idPistaModifica'], FILTER_SANITIZE_NUMBER_INT);
                $pista->setId($idPistaModifica);
                $pistasdao->actualizar($pista);
            }else{
                $pistasdao->insertar($pista);
            }

            header('Location: index.php?action=listarPistas');
            die();
            
        }
        
        $pistasdao=new PistaDAO(ConexionBD::conectar());
        $_SESSION['$edita']=false;
        if (isset($_GET["id"])) {
            $_SESSION['$edita']=true;
            $pista=$pistasdao->obtener($_GET["id"]);
            $tipo=$pista->getTipo();
            $numero=$pista->getNumero();
            $descripcion=$pista->getDescripcion();
            $precio=$pista->getPrecio();
            $id=$pista->getId();
        }
        
        $tipoPistas=$pistasdao->obtenerTipos();
        $usuarioDAO=new UsuarioDAO(ConexionBD::conectar());
        $pagina="registroPista";
        require 'app/vistas/registroPista.php';
    }
    
    function compruebaNumeroExiste(){
        header("Content-type: application/json; charset=utf-8");
        
        if (!isset($_POST['numero'])) {
            print json_encode(["error"=>"falta parametro numero"]);
            die();
        }
        
        if (!isset($_POST['tipo'])) {
            print json_encode(["error"=>"falta parametro tipo"]);
            die();
        }
        
        $numero= filter_var($_POST['numero'],FILTER_SANITIZE_NUMBER_INT);
        $tipo=filter_var($_POST['tipo'],FILTER_SANITIZE_STRING);
        
        $pistasdao=new PistaDAO(ConexionBD::conectar());
        $diferentesTipos=$pistasdao->obtenerTipos();
            
        foreach ($diferentesTipos as $tipejos){
            if (strcasecmp($tipejos, $tipo) == 0) {
                $tipo=$tipejos;
            }
        }
        
        if($pistasdao->obtenerNumeroPorTipo($tipo, $numero)){
            print json_encode(array("existe"=>true));
        }else{
            print json_encode(array("existe"=>false));
        }
        sleep(1);
    }
    
    function borrarPista(){
        header("Content-type: application/json; charset=utf-8");
        
        if (!isset($_POST['id'])) {
            print json_encode(["error"=>"falta parametro id"]);
            die();
        }
        
        $id= filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
        $pistasDAO=new PistaDAO(ConexionBD::conectar());
        
        if ($pistasDAO->borrar($id)){
            print json_encode(array("resultado"=>true));
        }else{
            print json_encode(array("resultado"=>false));
        }
    }
}
