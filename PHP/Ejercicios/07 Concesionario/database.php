<?php
// Precios de los componentes y accesorios del coche
$componentes = [
    "modelo" => [
        "compacto" => 15000,
        "sedan" => 20000,
        "SUV" => 30000
    ],
    "motor" => [
        "gasolina" => 2000,
        "diesel" => 3000,
        "electrico" => 10000
    ],
    "color" => [
        "blanco" => 0,
        "negro" => 500,
        "azul" => 1000,
        "rojo" => 1500
    ],
    "llantas" => [
        "16" => 500,
        "18" => 1000,
        "20" => 1500
    ],
    "equipamiento" => [
        "basico" => 0,
        "confort" => 2000,
        "premium" => 5000
    ],
    "accesorios" => [
        "techo_panoramico" => 1200,
        "asientos_cuero" => 1500,
        "sonido_premium" => 1000,
        "camara_360" => 800,
        "paquete_deportivo" => 2000,
        "control_crucero" => 1500,
        "sensores_aparcamiento" => 600,
        "maletero_electrico" => 900
    ]
];

// Códigos de descuento válidos
$codigosDescuento = [
    "AUTODESCUENTO5" => 5,   // 5% de descuento
    "CARSALE10" => 10,       // 10% de descuento
    "PROMO15" => 15          // 15% de descuento
];

define('TASA_IVA', 0.21);