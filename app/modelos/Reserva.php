<?php

class Reserva {
    private $id;
    private $idUsuario;
    private $fecha;
    private $precio;
    
    public function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdUsuario($idUsuario): void {
        $this->idUsuario = $idUsuario;
    }

    public function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    public function setPrecio($precio): void {
        $this->precio = $precio;
    }
}
