<style>
  * { font-family: 'JetBrains Mono', monospace; }
  p { margin: 8px 0; }
  ul { margin: 0px 0; }
</style>

<?php
  $nombre = htmlspecialchars(trim($_POST['nombre'])) ?? '';
  $apellidos = htmlspecialchars(trim($_POST['apellidos'])) ?? '';
  $edad = htmlspecialchars(trim($_POST['edad'])) ?? '';
  $peso = htmlspecialchars(trim($_POST['peso'])) ?? '';
  $sexo = isset($_POST['sexo']) ? htmlspecialchars(trim($_POST['sexo'])) : '';
  $civil = isset($_POST['civil']) ? htmlspecialchars(trim($_POST['civil'])) : '';
  $aficiones = $_POST['aficiones'] ?? '';

  if(strlen($nombre) > 20) $nombre == '';
  if(strlen($apellidos) > 20) $apellidos == '';
  if(!is_numeric($edad)) $edad = '';
  if(!is_numeric($peso)) $peso = '';

  $paragraphs = ['Edad' => $edad, 'Peso' => $peso, 'Sexo' => $sexo, 'Estado civil' => $civil];

  echo "<h1>$nombre $apellidos</h1>";
  foreach ($paragraphs as $key => $value) {
    if(!empty($value)){
      echo "<p>$key: $value</p>";
    }
  }
  if(!empty($aficiones)) {
    echo "<p>Aficiones:</p><ul>";
    foreach ($aficiones as $key => $value) {
      echo "<li>".htmlspecialchars(trim($value))."</li>";
    }
  }
  echo '</ul>';