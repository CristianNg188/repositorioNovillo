<?php

class Pista {
    private $id;
    private $tipo;
    private $numero;
    private $descripcion;
    private $precio;
    
    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setTipo($tipo): void {
        $this->tipo = $tipo;
    }

    public function setNumero($numero): void {
        $this->numero = $numero;
    }

    public function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }
    
    public function setPrecio($precio): void {
        $this->precio = $precio;
    }
}
