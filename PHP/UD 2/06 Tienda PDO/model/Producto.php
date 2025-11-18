<?php

class Producto {
  private $id;
  private $nombre;
  private $precio;

  public function __construct($id, $nombre, $precio) {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->precio = $precio;
  }

  public function getId() {
    return $this->id;
  }
  public function setId($id) {
    $this->id = $id;
  }

  public function getNombre() {
    return $this->nombre;
  }
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  public function getPrecio() {
    return $this->precio;
  }
  public function setPrecio($precio) {
    $this->precio = $precio;
  }

  public function __toString() {
    return "<p>$this->nombre: $this->precio €</p>
            <form method='POST' action='./view/eliminar.php'>
              <input type='hidden' name='id' value='$this->id'>
              <input type='submit'>   
            </form>
    ";
  }
}