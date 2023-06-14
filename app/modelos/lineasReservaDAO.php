<?php

class lineasReservaDAO {
    private $conn;
    
    public function __construct($conn){
        if (!$conn instanceof mysqli) {
            return false;
        }
        $this->conn=$conn;
    }
    
    public function insertar(lineaReserva $lr){
        $sql="INSERT INTO lineasreservas (idReserva,idPista,hora,fecha) VALUES (?,?,?,?)";
        
        if (!$stm=$this->conn->prepare($sql)){
            die("error:".$this->conn->error);
        }
        
        $idReserva=$lr->getIdReserva();
        $idPista=$lr->getIdPista();
        $hora=$lr->getHora();
        $fecha=$lr->getFecha();
        
        $stm->bind_param('iiis',$idReserva,$idPista,$hora,$fecha);
        
        $stm->execute();
    }
    
    public function borrar(lineaReserva $lr){
        $sql="DELETE FROM lineasreservas WHERE id=?";
        if (!$stm=$this->conn->prepare($sql)){
            die("error:".$this->conn->error);
        }
        $id=$lr->getId();
        
        $stm->bind_param('i',$id);
        $stm->execute();
        
        if ($stm->affected_rows==0) {
            return false;
        }else{
            return true;
        }
    }
    
    public function actualizar(lineaReserva $lr){
        $sql="UPDATE lineasreservas SET idReserva=?,idPista=?,hora=?,fecha=?  WHERE id=?";
        if (!$stm=$this->conn->prepare($sql)){
            die("error:".$this->conn->error);
        }
        
        $id=$lr->getId();
        $idReserva=$lr->getIdReserva();
        $idPista=$lr->getIdPista();
        $hora=$lr->getHora();
        $fecha=$lr->getFecha();
        
        $stm->bind_param('iiisi',$idReserva,$idPista,$hora,$fecha,$id);
        
        $stm->execute();
    }
    
    public function obtener(int $id){
        $sql="SELECT * FROM lineasreservas WHERE id=?";
        
        if (!$stm=$this->conn->prepare($sql)){
            die("error:".$this->conn->error);
        }
        
        $stm->bind_param('i',$id);
        
        $stm->execute();
        
        $result=$stm->get_result();
        
        return $result->fetch_object('lineaReserva');
    }
    
    public function obtenerTodos(){
        $sql="SELECT * FROM lineasreservas";
        $result=$this->conn->query($sql);
            
        if (!$result) {
            die("Error al ejecutar:".$conn->error);
        }
        
        $lineasReservas = array();
        
        while ($lineaReserva=$result->fetch_object('lineaReserva')) {
            $lineasReservas[]=$lineaReserva;
        }
        return $lineasReservas;
    }
    
    public function obtenerTodosAjax() {
        $sql="SELECT * FROM lineasreservas";
        $result=$this->conn->query($sql);
            
        if (!$result) {
            die("Error al ejecutar:".$conn->error);
        }
        
        $lineasReservas = array();
        
        while ($lineaReserva=$result->fetch_object('lineaReserva')) {
            $lineasReservas[]=$lineaReserva->getId();
        }
        return $lineasReservas;
    }
    
    public function obtenerPorReserva(int $idReserva) {
        $sql = "SELECT * FROM lineasreservas WHERE idReserva = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('i', $idReserva);
        $stmt->execute();

        $result = $stmt->get_result();
        $lineasReservas = array();
        while ($lineaReserva = $result->fetch_object('lineaReserva')) {
            $lineasReservas[]=$lineaReserva;
        }
        return $lineasReservas;
    }
    
    public function obtenerPorReservaAjax(int $idReserva) {
        $sql = "SELECT * FROM lineasreservas WHERE idReserva = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('i', $idReserva);
        $stmt->execute();

        $result = $stmt->get_result();
        $lineasReservas = array();
        while ($lineaReserva = $result->fetch_object('lineaReserva')) {
            $lineasReservas[]=$lineaReserva->getId();
        }
        return $lineasReservas;
    }
    
    public function obtenerPorReservaDistinct(int $idReserva) {
        $sql = "SELECT DISTINCT idReserva FROM lineasreservas WHERE idReserva = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('i', $idReserva);
        $stmt->execute();

        $result = $stmt->get_result();
        $lineasReservas = $result->fetch_array();
        return $lineasReservas;
    }
    
    public function obtenerPorPista(int $idPista) {
        $sql = "SELECT * FROM lineasreservas WHERE idPista = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('i', $idPista);
        $stmt->execute();

        $result = $stmt->get_result();
        $lineasReservas = array();
        while ($lineaReserva = $result->fetch_object('lineaReserva')) {
            $lineasReservas[]=$lineaReserva;
        }
        return $lineasReservas;
    }
    
    public function obtenerPorPistaAjax(int $idPista) {
        $sql = "SELECT * FROM lineasreservas WHERE idPista = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('i', $idPista);
        $stmt->execute();

        $result = $stmt->get_result();
        $lineasReservas = array();
        while ($lineaReserva = $result->fetch_object('lineaReserva')) {
            $lineasReservas[]=$lineaReserva->getId();
        }
        return $lineasReservas;
    }
    
    public function obtenerPorHora(int $hora) {
        $sql = "SELECT * FROM lineasreservas WHERE hora = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('i', $hora);
        $stmt->execute();

        $result = $stmt->get_result();
        $lineasReservas = array();
        while ($lineaReserva = $result->fetch_object('lineaReserva')) {
            $lineasReservas[]=$lineaReserva;
        }
        return $lineasReservas;
    }
    
    public function obtenerPorHoraAjax(int $hora) {
        $sql = "SELECT * FROM lineasreservas WHERE hora = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('i', $hora);
        $stmt->execute();

        $result = $stmt->get_result();
        $lineasReservas = array();
        while ($lineaReserva = $result->fetch_object('lineaReserva')) {
            $lineasReservas[]=$lineaReserva->getId();
        }
        return $lineasReservas;
    }
    
    public function obtenerPorFecha(Date $fecha) {
        $fecha_str = date('Y-m-d H:i:s', $fecha->getTimestamp());
        $sql = "SELECT * FROM lineasreservas WHERE fecha = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('s', $fecha_str);
        $stmt->execute();

        $result = $stmt->get_result();
        $lineasReservas = array();
        while ($lineaReserva = $result->fetch_object('lineaReserva')) {
            $lineasReservas[]=$lineaReserva;
        }
        return $lineasReservas;
    }
    
    public function obtenerPorFechaAjax(Date $fecha) {
        $fecha_str = date('Y-m-d H:i:s', $fecha->getTimestamp());
        $sql = "SELECT * FROM lineasreservas WHERE fecha = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('s', $fecha_str);
        $stmt->execute();

        $result = $stmt->get_result();
        $lineasReservas = array();
        while ($lineaReserva = $result->fetch_object('lineaReserva')) {
            $lineasReservas[]=$lineaReserva->getId();
        }
        return $lineasReservas;
    }
}
