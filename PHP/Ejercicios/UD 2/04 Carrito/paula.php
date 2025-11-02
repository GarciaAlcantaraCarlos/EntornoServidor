<?php

require_once "productos.php";

function guardarCookies($carrito)
{  // Guardar la cookie desde ahora hasta 600 segundos (10 min)

    setcookie("carrito", json_encode($carrito), time() + 600);
}

function leerCookies($cadenaJSON)
{
    $productoDecodificado = json_decode($cadenaJSON, true);
    return $productoDecodificado;
}

function mostrarProductos($carrito)
{
    global $productos;

    foreach ($productos as $codigo => $producto) {
        $nombre = $producto['nombre'];
        $precio = $producto['precio'];

        $cantidadActual = isset($carrito[$codigo]) ? $carrito[$codigo]['cantidad'] : '';

        echo "<br>$nombre ---- $precio €........... 
                <input type='number' name='cantidad[$codigo]' value='$cantidadActual' min='0' max='100' placeholder='Cantidad'><br>";
    }
}    

print_r($_POST);

$carrito = [];

if (isset($_COOKIE['carrito'])) {
    $carrito = leerCookies($_COOKIE['carrito']);

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['vaciarCarrito'])) {
        setcookie("carrito", "", time() - 1);

    } elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['añadirAlCarrito'])) {
        foreach ($productos as $codigo => $producto) {
            if (isset($_POST['cantidad'][$codigo]) && $_POST['cantidad'][$codigo] > 0) {
                $cantidad = $_POST['cantidad'][$codigo];
                $carrito[$codigo] = [
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio'],
                    'cantidad' => $cantidad
                ];
            }
        }
        guardarCookies($carrito);
    }
}



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
</head>

<body>
    <h1>PRODUCTO -- PRECIO -- CANTIDAD</h1>
    <form method="POST">
        <?php mostrarProductos($carrito); ?>
        <br>
        <input name="añadirAlCarrito" type="submit" value="Añadir al Carrito">
    </form><br>
    <form method="POST">
        <input name="vaciarCarrito" type="submit" value="Vaciar Carrito">
    </form><br>

</body>

</html>