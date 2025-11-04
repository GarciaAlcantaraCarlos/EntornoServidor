<?php
  class Ventana {
    private $abierta;

    public function __construct($abierta = false) {
      $this -> abierta = $abierta;
    }

    public function getAbierta() {
      return $this->abierta;
    }

    public function setAbierta($bool) {
      $this->abierta = $bool;
    }

    public function abrirCerrar() {
      $this -> abierta = !$this -> abierta;
    }

    public function __toString() {
      $estado = $this->abierta ? 'abierta' : 'cerrada'; 
      return "La ventana está $estado.";
    }
  }