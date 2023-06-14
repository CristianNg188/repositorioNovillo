<?php

class Usuario {
    private $id;
    private $usuario;
    private $email;
    private $contrasena;
    private $nombre;
    private $dni;
    private $telefono;
    private $poblacion;
    private $rol;
    private $estado;
    private $uid;
    private $foto;
    
    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getPoblacion() {
        return $this->poblacion;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getUid() {
        return $this->uid;
    }
    
    public function getFoto() {
        return $this->foto;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setUsuario($usuario): void {
        $this->usuario = $usuario;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setContrasena($contrasena): void {
        $this->contrasena = $contrasena;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setDni($dni): void {
        $this->dni = $dni;
    }

    public function setTelefono($telefono): void {
        $this->telefono = $telefono;
    }

    public function setPoblacion($poblacion): void {
        $this->poblacion = $poblacion;
    }

    public function setRol($rol): void {
        $this->rol = $rol;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }

    public function setUid($uid): void {
        $this->uid = $uid;
    }
    
    public function setFoto($foto): void {
        $this->foto = $foto;
    }
}
