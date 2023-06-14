<?php

class ReservaDAO {
    private $conn;
    
    public function __construct($conn){
        if (!$conn instanceof mysqli) {
            return false;
        }
        $this->conn=$conn;
    }
    
    public function insertar(Reserva $r){
        $sql="INSERT INTO reservas (idUsuario,fecha,precio) VALUES (?,?,?)";
        
        if (!$stm=$this->conn->prepare($sql)){
            die("error:".$this->conn->error);
        }
        
        $idUsuario=$r->getIdUsuario();
        $fecha=$r->getFecha();
        $precio=$r->getPrecio();
        
        $stm->bind_param('isi',$idUsuario,$fecha,$precio);
        
        $stm->execute();
        return $stm->insert_id;
    }
    
    public function borrar(Reserva $r){
        $sql="DELETE FROM reservas WHERE id=?";
        if (!$stm=$this->conn->prepare($sql)){
            die("error:".$this->conn->error);
        }
        $id=$r->getId();
        
        $stm->bind_param('i',$id);
        $stm->execute();
        
        if ($stm->affected_rows==0) {
            return false;
        }else{
            return true;
        }
    }
    
    public function actualizar(Reserva $r){
        $sql="UPDATE reservas SET idUsuario=?,fecha=?,precio=? WHERE id=?";
        if (!$stm=$this->conn->prepare($sql)){
            die("error:".$this->conn->error);
        }
        
        $id=$r->getId();
        $idUsuario=$r->getIdUsuario();
        $fecha=$r->getFecha();
        $precio=$r->getPrecio();
        
        $stm->bind_param('isii',$idUsuario,$fecha,$precio,$id);
        
        $stm->execute();
    }
    
    public function obtener($id){
        $sql="SELECT * FROM reservas WHERE id=?";
        
        if (!$stm=$this->conn->prepare($sql)){
            die("error:".$this->conn->error);
        }
        
        $stm->bind_param('i',$id);
        
        $stm->execute();
        
        $result=$stm->get_result();
        
        return $result->fetch_object('Reserva');
    }
    
    public function obtenerEspUser($id,$idUser){
        $sql="SELECT * FROM reservas WHERE id=? and idUsuario=?";
        
        if (!$stm=$this->conn->prepare($sql)){
            die("error:".$this->conn->error);
        }
        
        $stm->bind_param('ii',$id,$idUser);
        
        $stm->execute();
        
        $result=$stm->get_result();
        
        return $result->fetch_object('Reserva');
    }
    
    public function obtenerTodos(){
        $sql="SELECT * FROM reservas";
        $result=$this->conn->query($sql);
            
        if (!$result) {
            die("Error al ejecutar:".$conn->error);
        }
        
        $reservas = array();
        
        while ($reserva=$result->fetch_object('Reserva')) {
            $reservas[]=$reserva;
        }
        return $reservas;
    }
    
    public function obtenerTodosAjax() {
        $sql = "SELECT * FROM reservas";
        if (!$result = $this->conn->query($sql)) {
            die("Error al ejecutar la SQL " . $this->conn->error);
        }
        $array_reservas = array();
        while ($reserva = $result->fetch_object('Reserva')) {
            $array_reservas[]=$reserva->getId();
        }
        return $array_reservas;
    }
    
    public function obtenerTodosAjaxEspUser($idUser) {
        $sql = "SELECT * FROM reservas WHERE idUsuario=?";
        
        if (!$stmt=$this->conn->prepare($sql)){
            die("error:".$this->conn->error);
        }
        
        $stmt->bind_param('i',$idUser);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_reservas = array();
        while ($reserva = $result->fetch_object('Reserva')) {
            $array_reservas[]=$reserva->getId();
        }
        return $array_reservas;
    }
    
    public function obtenerPorFecha($fecha) {
        $fecha_str = date('Y-m-d H:i:s', $fecha->getTimestamp());
        $sql = "SELECT * FROM reservas WHERE fecha = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('s', $fecha_str);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_reservas = array();
        while ($reserva = $result->fetch_object('Reserva')) {
            $array_reservas[]=$reserva;
        }
        return $array_reservas;
    }
    
    public function obtenerPorFechaAjax($fecha,$id) {
        $sql = "SELECT * FROM reservas WHERE DATE(fecha) = ? and id=?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('si', $fecha,$id);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_reservas = array();
        while ($reserva = $result->fetch_object('Reserva')) {
            $array_reservas[]=$reserva->getId();
        }
        return $array_reservas;
    }
    
    public function obtenerPorPrecio($precio) {
        $sql = "SELECT * FROM reservas WHERE precio = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('i', $precio);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_reservas = array();
        while ($reserva = $result->fetch_object('Reserva')) {
            $array_reservas[]=$reserva;
        }
        return $array_reservas;
    }
    
    public function obtenerPorPrecioAjax($precio) {
        $sql = "SELECT * FROM reservas WHERE precio = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('i', $precio);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_reservas = array();
        while ($reserva = $result->fetch_object('Reserva')) {
            $array_reservas[]=$reserva->getId();
        }
        return $array_reservas;
    }
    
    public function obtenerPorPrecioAjaxEspUser($precio,$idUser) {
        $sql = "SELECT * FROM reservas WHERE precio = ? and idUsuario=?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('ii', $precio,$idUser);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_reservas = array();
        while ($reserva = $result->fetch_object('Reserva')) {
            $array_reservas[]=$reserva->getId();
        }
        return $array_reservas;
    }
    
    public function obtenerPorUsuario($idUsuario) {
        $sql = "SELECT * FROM reservas WHERE idUsuario = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_reservas = array();
        while ($reserva = $result->fetch_object('Reserva')) {
            $array_reservas[]=$reserva;
        }
        return $array_reservas;
    }
    
    public function obtenerPorUsuarioAjax($idUsuario) {
        $sql = "SELECT * FROM reservas WHERE idUsuario = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_reservas = array();
        while ($reserva = $result->fetch_object('Reserva')) {
            $array_reservas[]=$reserva->getId();
        }
        return $array_reservas;
    }
}
