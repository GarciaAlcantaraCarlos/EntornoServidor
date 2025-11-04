<!DOCTYPE html>
<html lang="en">
  <?php 
    session_start();
    require_once './backend.php';
  ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supermercado Maripepi</title>
</head>
<body>
  <?php if(!empty($_POST)) addToCart($_POST) ?>
  <h1>Supermercado Maripepi</h1>
  <h2>Realiza aqui tu compra</h2>
  <?php echo "<button><a href='./cart.php'>Ver Carrito (".getCartItems().")</a></button>" ?>
  <br><br>
  <form method="post">
    <table>
      <tr>
        <th>Producto</th>
        <th>Precio</th>
        <th>Cantidad deseada</th>
      </tr>
      <?php renderProducts($productos); ?>
    </table>
    <input type="submit" value="Añadir al carrito">
  </form>
</body>
</html>