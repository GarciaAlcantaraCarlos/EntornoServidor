<style>
  * { font-family: 'JetBrains Mono', monospace; }
  body { 
    display: flex; flex-direction: column; align-items: center; 
    justify-content: center; height: 100dvh; margin: 0;
  }
  .card { width: 30rem; background-color: white; border-radius: 6px; overflow: hidden; box-shadow: 0 0 24px lightgray; }
  .strip { display: flex; padding: 8px 32px; align-items: center; background-color: #eef9ff; }
  .strip.warn { background-color: #ffdbc5ff; }
  .data { padding: 0 2rem; }
  img { width: 4rem; margin-right: 2rem; }
  span { font-weight: 200; }
  .chin { width: 100%; background-color: #31b5ff; height: 16px; }
  .chin.warn { background-color: #ff6431ff; }
</style>

<?php

  $error = validateData();


  if (!$error) {
    $name = htmlspecialchars($_GET["name"]);
    $age = htmlspecialchars($_GET["age"]);
    $weight = htmlspecialchars($_GET["weight"]);
    $height = htmlspecialchars($_GET["height"]);

    $imc = round($weight / (($height / 100) ** 2), 2);
    $max_bpm = round(208 - (0.7 * $age));

    echo "
      <div class='card'>
        <div class='strip'>
          <img src='./user.png'>
          <h1>$name<span>, $age</span></h1>
        </div>
        <div class='data'>
          <p><strong>Peso: </strong>$weight"."kg</p>
          <p><strong>Altura: </strong>$height"."cm</p>
          <hr>
          <p><strong>Tu imc: </strong>$imc</p>
          <p><strong>Tus bpms max: </strong>$max_bpm bpm</p>
        </div>
        <div class='chin'></div>
      </div>
    ";
  } else {
    echo "
      <div class='card'>
        <div class='strip warn'>
          <h1>Error.</h1>
        </div>
        <div class='data'>
          $error
        </div>
        <div class='chin warn'></div>
      </div>
    ";
  }

  function validateData() {
    $error = false;

    if (empty($_GET)) return '<p>500: Error interno del servidor.</p>';

    $name = htmlspecialchars($_GET["name"]);
    $age = htmlspecialchars($_GET["age"]);
    $weight = htmlspecialchars($_GET["weight"]);
    $height = htmlspecialchars($_GET["height"]);

    if (empty($name) || empty($age) || empty($weight) || empty($height) ) {
      $error = '<p>Debes rellenar todos los campos.</p>';
    }

    if ($height < 100 || $height > 300) {
      if ($error) $error .= '<p>Debes introducir una altura válida en cm.</p>';
      else $error = '<p>Debes introducir una altura válida en cm.</p>';
    }

    if ($weight < 20 || $weight > 300) {
      if ($error) $error .= '<p>Debes introducir un peso válido en kg.</p>';
      else $error = '<p>Debes introducir un peso válido en kg.</p>';
    }

    if ($age < 0 || $age > 130) {
      if ($error) $error .= '<p>Debes introducir una edad válida.</p>';
      else $error = '<p>Debes introducir una edad válida.</p>';
    }

    return $error;
  }