<?php

class lineaReserva {
    private $id;
    private $idReserva;
    private $idPista;
    private $hora;
    private $fecha;
    
    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getIdReserva() {
        return $this->idReserva;
    }

    public function getIdPista() {
        return $this->idPista;
    }

    public function getHora() {
        return $this->hora;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdReserva($idReserva): void {
        $this->idReserva = $idReserva;
    }

    public function setIdPista($idPista): void {
        $this->idPista = $idPista;
    }

    public function setHora($hora): void {
        $this->hora = $hora;
    }

    public function setFecha($fecha): void {
        $this->fecha = $fecha;
    }
}
