<?php

class UsuarioDAO {
    
    private $conn;

    public function __construct($conn) {
        if (!$conn instanceof mysqli) { 
            return false;
        }
        $this->conn = $conn;
    }
    
    public function obtenerTodos() {
        $sql = "SELECT * FROM usuarios";
        if (!$result = $this->conn->query($sql)) {
            die("Error al ejecutar la SQL " . $this->conn->error);
        }
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario;
        }
        return $array_usuarios;
    }
    
    public function obtenerTodosAjax() {
        $sql = "SELECT * FROM usuarios";
        if (!$result = $this->conn->query($sql)) {
            die("Error al ejecutar la SQL " . $this->conn->error);
        }
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario->getId();
        }
        return $array_usuarios;
    }
    
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $usuario = $result->fetch_object('Usuario');
          
        return $usuario;
    }
    
    public function obtenerPorUid($uid) {
            $sql = "SELECT * FROM usuarios WHERE uid = ?";
            if (!$stmt = $this->conn->prepare($sql)) {
                die("Error al preparar la sentencia: " . $this->conn->error);
            }
            $stmt->bind_param('s', $uid);
            $stmt->execute();

            $result = $stmt->get_result();
            $usuario = $result->fetch_object('Usuario');
             
            return $usuario;
    }
    
    public function obtenerPorUsuario($user) {
        $sql = "SELECT * FROM usuarios WHERE usuario = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('s', $user);
        $stmt->execute();

        $result = $stmt->get_result();
        $usuario = $result->fetch_object('Usuario');
          
        return $usuario;
    }
    
    public function obtenerPorUsuarioAjax($user) {
        $sql = "SELECT * FROM usuarios WHERE usuario LIKE ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $user=$user."%";
        $stmt->bind_param('s', $user);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario->getId();
        }
        return $array_usuarios;
    }
    
    public function obtenerPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $usuario = $result->fetch_object('Usuario');
          
        return $usuario;
    }
    
    public function obtenerPorEmailAjax($email) {
        $sql = "SELECT * FROM usuarios WHERE email LIKE ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $email=$email."%";
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario->getId();
        }
        return $array_usuarios;
    }
    
    public function obtenerPorPoblacion($poblacion) {
        $sql = "SELECT * FROM usuarios WHERE poblacion = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('s', $poblacion);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario;
        }
        return $array_usuarios;
    }
    
    public function obtenerPorPoblacionAjax($poblacion) {
        $sql = "SELECT * FROM usuarios WHERE poblacion LIKE ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $poblacion=$poblacion."%";
        $stmt->bind_param('s', $poblacion);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario->getId();
        }
        return $array_usuarios;
    }
    
    public function obtenerPorEstado($estado) {
        $sql = "SELECT * FROM usuarios WHERE estado = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('s', $estado);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario;
        }
        return $array_usuarios;
    }
    
    public function obtenerPorEstadoAjax($estado) {
        $sql = "SELECT * FROM usuarios WHERE estado LIKE ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $estado=$estado."%";
        $stmt->bind_param('s', $estado);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario->getId();
        }
        return $array_usuarios;
    }
    
    public function obtenerPorNombre($nombre) {
        $sql = "SELECT * FROM usuarios WHERE nombre = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('s', $nombre);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario;
        }
        return $array_usuarios;
    }
    
    public function obtenerPorNombreAjax($nombre) {
        $sql = "SELECT * FROM usuarios WHERE nombre LIKE ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $nombre= $nombre."%";
        $stmt->bind_param('s', $nombre);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario->getId();
        }
        return $array_usuarios;
    }
    
    public function obtenerPorTelefono($telefono) {
        $sql = "SELECT * FROM usuarios WHERE telefono = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('s', $telefono);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario;
        }
        return $array_usuarios;
    }
    
    public function obtenerPorTelefonoAjax($telefono) {
        $sql = "SELECT * FROM usuarios WHERE telefono LIKE ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $telefono=$telefono."%";
        $stmt->bind_param('s', $telefono);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario->getId();
        }
        return $array_usuarios;
    }
    
    public function obtenerPorDni($dni) {
        $sql = "SELECT * FROM usuarios WHERE dni = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('s', $dni);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario;
        }
        return $array_usuarios;
    }
    
    public function obtenerPorDniAjax($dni) {
        $sql = "SELECT * FROM usuarios WHERE dni LIKE ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $dni=$dni."%";
        $stmt->bind_param('s', $dni);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario->getId();
        }
        return $array_usuarios;
    }
    
    public function obtenerPorRol($rol) {
        $sql = "SELECT * FROM usuarios WHERE rol = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $stmt->bind_param('s', $rol);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario;
        }
        return $array_usuarios;
    }
    
    public function obtenerPorRolAjax($rol) {
        $sql = "SELECT * FROM usuarios WHERE rol LIKE ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $rol=$rol."%";
        $stmt->bind_param('s', $rol);
        $stmt->execute();

        $result = $stmt->get_result();
        $array_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_usuarios[]=$usuario->getId();
        }
        return $array_usuarios;
    }
    
    public function insertar(Usuario $u) {
        $sql = "INSERT INTO usuarios (usuario,email,contrasena,nombre,dni,telefono,poblacion,rol,estado,foto) VALUES (?,?,?,?,?,?,?,?,?,?)";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        
        $usuario = $u->getUsuario();
        $email = $u->getEmail();
        $password = $u->getContrasena();
        $nombre = $u->getNombre();
        $dni=$u->getDni();
        $telefono = $u->getTelefono();
        $poblacion = $u->getPoblacion();
        $rol=$u->getRol();
        $estado=$u->getEstado();
        $foto=$u->getFoto();
        
        $stmt->bind_param('ssssssssss',$usuario, $email, $password, $nombre, $dni, $telefono, $poblacion, $rol, $estado, $foto);
        $stmt->execute();
    }
    
    public function actualizar(Usuario $u) {
        $sql = "UPDATE usuarios SET usuario=?, email=?, contrasena=?, nombre=?, dni=?, telefono=?, poblacion=?, rol=?, estado=?, foto=? WHERE id = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        
        $usuario = $u->getUsuario();
        $email = $u->getEmail();
        $password = $u->getContrasena();
        $nombre = $u->getNombre();
        $dni=$u->getDni();
        $telefono = $u->getTelefono();
        $poblacion = $u->getPoblacion();
        $rol=$u->getRol();
        $estado=$u->getEstado();
        $id=$u->getId();
        $foto=$u->getFoto();
        
        $stmt->bind_param('ssssssssssi',$usuario, $email, $password, $nombre, $dni, $telefono, $poblacion, $rol, $estado, $foto, $id);
        $stmt->execute();
    }
    
    public function actualizarUid(Usuario $u) {
        $sql = "UPDATE usuarios SET uid = ? "
                . "WHERE id = ?";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la sentencia: " . $this->conn->error);
        }
        $id = $u->getId();
        $uid = $u->getUid();
        $stmt->bind_param('si', $uid, $id);
        $stmt->execute();
    }
    
    public function borrar(int $id) {
        $sql="DELETE FROM usuarios WHERE id=?";
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
}
