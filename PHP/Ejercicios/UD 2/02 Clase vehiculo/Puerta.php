<?php
  require_once './Ventana.php';
  
  class Puerta {
    private $ventana;
    private $abierta;

    public function __construct($abierta = false) {
      $this -> abierta = $abierta;
      $this -> ventana = new Ventana();
    }

    public function getAbierta() {
      return $this->abierta;
    }

    public function setAbierta($bool) {
      $this->abierta = $bool;
    }

    public function getAbiertaVentana() {
      return $this->ventana->getAbierta();
    }

    public function setAbiertaVentana($bool) {
      $this->ventana->setAbierta($bool);
    }

    public function abrirCerrar() {
      $this -> abierta = !$this -> abierta;
    }

    public function __toString() {
      $estado = $this->abierta ? 'abierta' : 'cerrada'; 
      $estadoVentana = $this->ventana->getAbierta() ? 'abierta' : 'cerrada'; 
      return "La puerta está $estado y tiene una ventana $estadoVentana.";
    }
  } 