<?php

class Conector {
  private $conexion;

  public function conectar() {
    try {
      // Crear una nueva conexión PDO
      $conexion = new PDO("mysql:host=localhost;dbname=db_productos", "root", "");
      
      // Establecer el modo de error a excepciones
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Capturar y manejar los errores de conexión
        echo "Error en la conexión: " . $e->getMessage();
    }

    return $conexion;
  }
}