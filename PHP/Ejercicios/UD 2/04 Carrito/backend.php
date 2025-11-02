<?php 

  /* ============= CART MANAGEMENT ============= */

  function addToCart ($petition) {
    // Get the current cookie
    $cart = json_decode($_COOKIE['cart'] ?? '[]', true);

    // Add requested items to cart
    foreach ($petition as $key => $value) {
      if ($value > 0) {
        if (isset($cart[$key])) {
          $cart[$key] += $petition[$key];
        } else {
          $cart[$key] = $petition[$key];
        }
      }
    }
    
    // DEV tools ======================
    // echo "<br><br><b>REQUEST</b>: ";
    // print_r($petition);
    // echo "<br><br><b>CART</b>: ";
    // print_r($cart);

    // Store the cart into a cookie
    setcookie('cart', json_encode($cart), time() + 86400, "/");
  }

  function processCart($request) {
    if(isset($request['clearCart']) && $request['clearCart'] === 'clear') {
      setcookie('cart', '', time() - 1, "/");
    } else {
      foreach ($request as $item => $amt) {
        if ($amt == 0) {
          unset($request[$item]);
        }
      }
      setcookie('cart', json_encode($request), time() + 86400, "/");
    }
  }

  function getCartItems () {
    $items = 0;
    if (isset($_COOKIE['cart'])) {
      // TODO: Fix delayed update of cart count
      $items = count(json_decode($_COOKIE['cart'] ?? '[]', true));
    }
    return $items;
  }


  /* ============= RENDERERS ============= */

  function renderProducts($productos) {
    foreach ($productos as $key => $producto) {
      echo "<tr>
        <td><label for='$key'>$producto[nombre]</label></td>
        <td>$producto[precio] €</td>
        <td><input id='$key' name='$key' type='number' min='0' value='0'></td>
      <tr>";
    }
  }

  function renderCartSection() {
    $cart = json_decode($_COOKIE['cart'] ?? '[]', true);

    if(empty($cart)) {
      echo "Tu carrito está vacío<br><button><a href='./index.php'>Seguir comprando</a></button>";
    } else {
      echo "<form method='POST'><table>
          <tr>
            <th>Producto</th>
            <th>Cantidad solicitada</th>
            <th>Precio total</th>
          </tr>
          ".renderCart($cart)."
        </table>
        <input type='submit' value='Actualizar cantidades'>
      </form>
      <form method='POST'>
        <input type='hidden' name='clearCart' value='clear'><input type='submit' value='Vaciar carrito'>
      </form>";
    }
  }

  function renderCart($cart) {
    global $productos;
    $tableContent = '';
    $ticketPrice = 0;

    // Print cart items
    foreach ($cart as $key => $amt) {
      $name = $productos[$key]['nombre'];
      $price = $productos[$key]['precio'] * $amt;
      $ticketPrice += $price;

      $tableContent .= "<tr>
        <td>$name</td>
        <td><input type='number' name='$key' value='$amt'></td>
        <td>$price</td>
      </tr>";
    }

    $postage = ($ticketPrice * 0.02) < 5 ? 5 : $ticketPrice * 0.02;
    $totalPrice = $ticketPrice + $postage;

    // Print cart totals
    $tableContent .= "<tr>
      <td></td>
      <th>Gastos de envío:</th>
      <td>$postage</td>
    </tr><tr>
      <td></td>
      <th>Precio total:</th>
      <td>$totalPrice</td>
    </tr>";

    return $tableContent;
  }
