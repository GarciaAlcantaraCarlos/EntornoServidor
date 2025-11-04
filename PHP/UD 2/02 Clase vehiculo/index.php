<?php
  require_once './Vehiculo.php';

  $coche = new Vehiculo();

  echo $coche->__toString();