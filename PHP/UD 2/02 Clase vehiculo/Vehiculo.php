<?php
  require_once './Puerta.php';
  
  class Vehiculo {
    private $numeroDePuertas;
    private $puertas;
    private $tipoMotor;
    private $potencia;
    private $etiquetaMedioambiental;
    private $arrancado;

    public function __construct($numeroDePuertas = 4,
                                $tipoMotor = '',
                                $potencia = 200,
                                $etiquetaMedioambiental = false) {
      $this -> numeroDePuertas = $numeroDePuertas;
      $this -> tipoMotor = $tipoMotor;
      $this -> potencia = $potencia;
      $this -> etiquetaMedioambiental = $etiquetaMedioambiental;
      $this -> arrancado = false;

      # $puertas = array:fill(0, $numeroDePuertas, new Puerta);
      $puertas = [];
      for ($i=0; $i < $numeroDePuertas; $i++) { 
        $puertas[] = new Puerta();
      }

      $this -> puertas = $puertas;
    }

    public function encenderApagar() {
      $this->arrancado = !$this->arrancado;
    }

    public function cerrarVehículo() {
      for ($i=0; $i < $this->numeroDePuertas; $i++) { 
        $this->puertas[i]->setAbierta(false);
        $this->puertas[i]->setAbiertaVentana(false);
      }
    }

    public function puedeEntrarZBE() {
      $result = $this->etiquetaMedioambiental ? true : false;
    }

    public function __toString() {
      $disponeEtiqueta = ($this->etiquetaMedioambiental) ? 'Si' : 'No' ;
      $estaArrancado = ($this->arrancado) ? 'arrancado' : 'apagado' ;
      $openStateString = '';

      foreach ($this->puertas as $id => $puerta) {
        $id += 1;
        $openStateString .= "<li>Puerta $id: " . $puerta->__toString() . "</li>";
      }

      return "<p>Este vehículo tiene un motor $this->tipoMotor de $this->potencia caballos de potencia. $disponeEtiqueta dispone de etiqueta medioambiental y está $estaArrancado. Tiene $this->numeroDePuertas puertas que están: <ul>$openStateString.</ul></p>";
    }
  }