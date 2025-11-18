<?php 
  if (isset($_POST['nombre'])) {
    require_once '../model/ProductoModel.php';
    require_once '../model/Producto.php';

    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];

    $producto = new Producto(null, $nombre, $precio);

    $productoModel->insertarProducto($nuevoProducto);

    header(Location: '../index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form method="POST">
    <label><input name="nombre" type="text"></label>
    <label><input name="precio" type="text"></label>
    <input type="submit" value="Agregar">
  </form>
</body>
</html>