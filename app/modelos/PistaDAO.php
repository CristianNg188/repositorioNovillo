<?php

class PistaDAO {
    private $conn;
    
    public function __construct($conn){
        if (!$conn instanceof mysqli) {
            return false;
        }
        $this->conn=$conn;
    }
    
    public function insertar(Pista $p){
        $sql="INSERT INTO pistas (tipo,numero,descripcion,precio) VALUES (?,?,?,?)";
        
        if (!$stm=$this->conn->prepare($sql)){
            die("error:".$this->conn->error);
        }
        
        $tipo=$p->getTipo();
        $numero=$p->getNumero();
        $descripcion=$p->getDescripcion();
        $precio=$p->getPrecio();
        
        $stm->bind_param('sisi',$tipo,$numero,$descripcion,$precio);
        
        $stm->execute();
    }
    
    public function borrar(int $id){
        $sql="DELETE FROM pistas WHERE id=?";
        if (!$stm=$this->conn->prepare($sql)){
            die("error:".$this->conn->error);
        }
        $stm->bind_param('i',$id);
        $stm->execute();
        
        if ($stm->affected_rows==0) {
            return false;
        }else{
            return true;
        }
    }
    
    public function actualizar(Pista $p){
        $sql="UPDATE pistas SET tipo=?,numero=?,descripcion=?,precio=? WHERE id=?";
        if (!$stm=$this->conn->prepare($sql)){
            die("error:".$this->conn->error);
        }
        
        $id=$p->getId();
        $tipo=$p->getTipo();
        $numero=$p->getNumero();
        $descripcion=$p->getDescripcion();
        $precio=$p->getPrecio();
        
        $stm->bind_param('sisii',$tipo,$numero,$descripcion,$precio,$id);
        
        $stm->execute();
    }
    
    public function obtener($id){
        $sql="SELECT * FROM pistas WHERE id=?";
        
        if (!$stm=$this->conn->prepare($sql)){
            die("error:".$this->conn->error);
        }
        
        $stm->bind_param('i',$id);
        
        $stm->execute();
        
        $result=$stm->get_result();
        
        return $result->fetch_object('Pista');
    }
    
    public function obtenerTodos(){
        $sql="SELECT * FROM pistas";
        $result=$this->conn->query($sql);
            
        if (!$result) {
            die("Error al ejecutar:".$conn->error);
        }
        
        $pistas = array();
        
        while ($pista=$result->fetch_object('Pista')) {
            $pistas[]=$pista;
        }
        return $pistas;
    }
    
    public function obtenerPorTipo($tipo){
        $sql="SELECT * FROM pistas";
        $result=$this->conn->query($sql);
            
        if (!$result) {
            die("Error al ejecutar:".$conn->error);
        }
        
        $pistas = array();
        
        while ($pista=$result->fetch_object('Pista')) {
            if ($tipo==$pista->getTipo()) {
                $pistas[]=$pista;
            }
        }
        return $pistas;
    }
    
    public function obtenerTipos(){
        $sql="SELECT DISTINCT tipo FROM pistas";
        $result=$this->conn->query($sql);
            
        if (!$result) {
            die("Error al ejecutar:".$conn->error);
        }
        
        $pistas = array();
        
        while ($pista=$result->fetch_object('Pista')) {
            $pistas[]=$pista->getTipo();
        }
        return $pistas;
    }
    
    public function obtenerTodosAjax() {
        $sql = "SELECT * FROM pistas";
        if (!$result = $this->conn->query($sql)) {
            die("Error al ejecutar la SQL " . $this->conn->error);
        }
        $array_pistas = array();
        while ($pista = $result->fetch_object('Pista')) {
            $array_pistas[]=$pista->getId();
        }
        return $array_pistas;
    }
    
    public function obtenerPorTipoAjax($tipo){
        $sql="SELECT * FROM pistas WHERE tipo LIKE ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $tipo=$tipo."%";
        $stmt->bind_param('s', $tipo);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $array_pistas = array();
        while ($pista = $result->fetch_object('Pista')) {
            $array_pistas[]=$pista->getId();
        }
        return $array_pistas;
    }
    
    public function obtenerPorDescripcionAjax($descripcion){
        $sql="SELECT * FROM pistas WHERE descripcion LIKE ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $descripcion=$descripcion."%";
        $stmt->bind_param('s', $descripcion);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $array_pistas = array();
        while ($pista = $result->fetch_object('Pista')) {
            $array_pistas[]=$pista->getId();
        }
        return $array_pistas;
    }
    
    public function obtenerPorPrecio($precio){
        $sql="SELECT * FROM pistas WHERE precio=?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('i', $precio);
        $stmt->execute();
        
        $result=$stmt->get_result();
        
        return $result->fetch_object('Pista');
    }
    
    public function obtenerPorPrecioAjax($precio){
        $sql="SELECT * FROM pistas WHERE precio=?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('i', $precio);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $array_pistas = array();
        while ($pista = $result->fetch_object('Pista')) {
            $array_pistas[]=$pista->getId();
        }
        return $array_pistas;
    }
    
    public function obtenerNumeroPorTipo($tipo,$numero){
        $sql="SELECT * FROM pistas WHERE tipo=?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('s', $tipo);
        $stmt->execute();
        
        $result = $stmt->get_result();
        while ($pista = $result->fetch_object('Pista')) {
            if ($pista->getNumero()==$numero) {
                return true;
            }
        }
        return false;
    }
}
