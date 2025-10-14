<link rel="stylesheet" href="styles.css">

<?php
require './database.php';
$elementosBasicos = ['modelo', 'motor', 'color', 'llantas', 'equipamiento'];

function validateInput() {
    global $elementosBasicos;
    $pedido = $_POST;

    foreach ($elementosBasicos as $_ => $elemento) {
        if (!isset($pedido[$elemento])) {
            $pedido = null;
        }
    }

    if( $pedido['unidades'] < 1 || $pedido['unidades'] > 5 ) $pedido = null;

    return $pedido;
}

function calculateUnitPrice($pedido) {
    global $componentes;
    global $elementosBasicos;
    $precioCoche = 0;

    foreach ($elementosBasicos as $_ => $elemento) {
        $precioElemento = $componentes[$elemento][$pedido[$elemento]];
        $precioCoche += $precioElemento;
        echo " - $elemento: $pedido[$elemento] - $precioElemento"."€ <br>";
    }

    if(!empty($pedido['accesorios'])) {
        echo " - Accesorios:<br>";
        foreach($pedido['accesorios'] as $_ => $accesorio) {
            $precioAccesorio = $componentes['accesorios'][$accesorio];
            $precioCoche += $precioAccesorio;
            echo " --- $accesorio - $precioAccesorio","€ <br>";
        }    
    }

    return $precioCoche;
}

function testVoucherCode($codigoDescuento) {
    global $codigosDescuento;
    $descuento = 0;

    if (!empty($codigoDescuento)){
        $descuento = -1;
        if (isset($codigosDescuento[$codigoDescuento])) {
            $descuento = $codigosDescuento[$codigoDescuento];
        }
    }

    return $descuento;
}

function renderTicket() {
    $pedido = validateInput();

    if ($pedido !== null) {
        echo "<h1>Ticket: Coche personalizado</h1>";
        $precioUnidad = calculateUnitPrice($pedido);

        $unidades = $pedido['unidades'];
        echo "<br>Cantidad de coches: $unidades <br>";

        $codigoDescuento = $pedido['codigoDescuento'];
        $descuento = testVoucherCode($codigoDescuento);

        if($descuento == 0) $codigoDescuento = '';
        if($descuento == -1) $codigoDescuento = 'CODIGO INVÁLIDO';

        echo "Código de descuento: $codigoDescuento <br><br>";

        echo "Precio por unidad: $precioUnidad"."€ <br>";
        $subTotal = $precioUnidad * $unidades;
        echo "Total sin descuento: $subTotal"."€ <br>";
        
        if($descuento > 0) {
            $descuentoAplicado = $subTotal * ($descuento / 100);
            echo "Descuento aplicado: $descuentoAplicado"."€ <br>";
            $subTotal -= $descuentoAplicado;
            echo "Total con descuento: $subTotal"."€ <br>";
        }

        $iva = $subTotal * TASA_IVA;
        echo "<br>IVA (21%): $iva"."€ <br>";

    } else {
        echo "Solicitud inválida.";
    }
}

renderTicket();