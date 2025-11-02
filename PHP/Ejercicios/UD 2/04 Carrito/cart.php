<!DOCTYPE html>
<html lang="en">
  <?php 
    session_start();
    require_once './productos.php';
    require_once './backend.php';
  ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supermercado Maripepi</title>
  <?php if(!empty($_POST)) processCart($_POST) ?>
</head>
<body>
  <h1>Supermercado Maripepi</h1>
  <h2>Tu carrito de la compra</h2>
  <button><a href='./index.php'>Seguir comprando</a></button>
  <br><br>
  <?php renderCartSection(); ?>
</body>
</html>