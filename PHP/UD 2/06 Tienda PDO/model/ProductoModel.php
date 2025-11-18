<?php

require_once './model/Conector.php';
require_once './model/Producto.php';

class ProductoModel {
  private $miConector;

  public function __construct() {
    $this->miConector = new Conector();
  }

  public function filaAProducto($fila) {
    $id = $fila["ID"];
    $nombre = $fila["NOMBRE"];
    $precio = $fila["PRECIO"];

    $producto = new Producto($id, $nombre, $precio);

    return $producto;
  }

  public function obtenerTodosProductos() {
    $conexion = $this->miConector->conectar();
    
    $consulta = $conexion->prepare("SELECT * FROM producto");
    $consulta->execute();

    $resultadoConsulta = $consulta->fetchAll();

    foreach ($resultadoConsulta as $fila) {
      $productos[] = $this->filaAProducto($fila);
    }

    return $productos;
  }

  public function obtenerProductoPorId($id) {
    $conexion = $this->miConector->conectar();
    
    $consulta = $conexion->prepare("SELECT * FROM producto WHERE id = :id");
    $consulta->bindParam(':id', $id);
    $consulta->execute();

    $resultadoConsulta = $consulta->fetch();
    $producto = $this->filaAProducto($resultadoConsulta);
  }

  public function insertarProducto($producto) {
    $conexion = $this->miConector->conectar();
    
    $consulta = $conexion->prepare("INSERT INTO PRODUCTO(NOMBRE, PRECIO) VALUES (:nombre, :precio)");
    $consulta->bindParam(':nombre', $prodcuto->nombre);
    $consulta->bindParam(':producto', $prodcuto->precio);

    return $consulta->execute(); // Devuelve booleano según éxito en la consulta
  }

  public function eliminarPorId($id) {
    $conexion = $this->miConector->conectar();
    
    $consulta = $conexion->prepare("DELETE PRODUCTO WHERE ID=:id");
    $consulta->bindParam(':id', $id);

    return $consulta->execute(); // Devuelve booleano según éxito en la consulta
  }
}