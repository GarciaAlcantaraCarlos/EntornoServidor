<?php

require_once './model/ProductoModel.php';
require_once './model/Producto.php';

$productoModel = new ProductoModel();

$productos = $productoModel->obtenerTodosProductos();

foreach ($productos as $producto) {
  echo $producto;
}

echo "<a href='./view/agregar.php'>Nuevo producto</a>";