<?php
  class Producto {
    private $name;
    private $price;

    public function __construct($name="", $price=0) {
      $this -> name = $name;
      $this -> price = $price;
    }

    function getName() {
      return $this->name;
    }

    function setName($name) {
      $this->name = $name;
    }

    function getPrice() {
      return $this->price;
    }

    function setPrice($price) {
      $this->price = $price;
    }
  }
  