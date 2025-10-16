<?php
  # Perro: nombre, edad, raza, sexo
  # Métodos: Ladrar, calcEdadHumana, toString
  # Constructores: vacío y completo
  # Instacia perros e imprime

  class Perro {
    private $nombre;
    private $edad;
    private $raza;
    private $sexo;

    public function __construct($nombre="", $edad=0, $raza="", $sexo="") {
      $this -> nombre = $nombre;
      $this -> edad = $edad;
      $this -> raza = $raza;
      $this -> sexo = $sexo;
    }

    public function ladrar() {
    echo "Guau guau.";
  }

    public function calcularEdadHumana(){
      return $this->edad * 7;
    }

    public function __toString() {
      $humanos = $this->calcularEdadHumana();
      return "$this->nombre es un perro de raza $this->raza, tiene $this->edad años ($humanos en humanos) y es $this->sexo";
    }
  }

  $miPerro = new Perro('Firulais', raza: 'Schnauzer');
  print_r($miPerro);
  echo $miPerro->__toString();