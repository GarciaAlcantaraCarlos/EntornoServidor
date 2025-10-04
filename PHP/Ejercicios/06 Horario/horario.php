<style>
  * {font-family: 'JetBrains Mono'; }
  .graphicSchedule { display: grid; grid-template-columns: 80px repeat(5, 1fr); grid-template-rows: repeat(16, 1fr); margin-right: 1rem; margin-bottom: 4rem; }
  .dayLabel { text-align: center; font-weight: bold; display: flex; align-items: end; justify-content: center; margin-bottom: 8px;}
  .timeLabel { text-align: right; padding-right: 6px; border-top: 1px solid black; }
  .scheduleItem { 
    display: flex; align-items: center; justify-content: center; padding: 1rem; text-align: center;
    border: 1px solid black; border-collapse: collapse; margin: 2px; border-radius: 4px;
    &.servidor { background-color: #fcffa0; }
    &.cliente { background-color: #f6c794; }
    &.ingles { background-color: #f1a2d2; }
    &.interfaz { background-color: #92fcb4  ; }
    &.wordpress { background-color: #c5b9f9; }
    &.despliegue { background-color: #d1fd96; }
    &.ipe { background-color: #cde4fc; }
    &.proyecto { background-color: #c8d0df; }
  }
</style>

<?php
  define('HORARIO', [
    'servidor' => [
      'M' => [8, 10],
      '+' => [11.5, 12.5],
      'X' => [13, 14.5],
      'J' => [8, 10.5]
    ],
    'cliente' => [
      'L' => [8, 10.5],
      'M' => [12.5, 14.5],
      'X' => [11.5, 13]
    ],
    'ingles' => [
      'L' => [13.5, 15.5]
    ],
    'wordpress' => [
      'X' => [8, 11]
    ],
    'interfaz' => [
      'L' => [11, 12.5],
      'M' => [10, 11],
      'J' => [13, 14.5],
      'V' => [12.5, 13.5]
    ],
    'despliegue' => [
      'L' => [12.5, 13.5],
      'J' => [12, 13]
    ],
    'ipe' => [
      'J' => [11, 12],
      'V' => [8, 10]
    ],
    'proyecto' => [
      'V' => [10, 12]
    ],
  ]);

  define('SUBJECTS', [
    'servidor' => 'Desarrollo Entorno Servidor',
    'cliente' => 'Desarrollo Entorno Cliente',
    'ingles' => 'Inglés Profesional',
    'wordpress' => 'Libre Configuración',
    'interfaz' => 'Diseño Interfaces Web',
    'despliegue' => 'Despliegue de Aplicaciones Web',
    'ipe' => 'Itinerario para la Empleabilidad',
    'proyecto' => 'Proyecto interdisciplinar'
  ]);

  define ('DAY_EQUIVALENTS', [
    'L' => 2,
    'M' => 3,
    '+' => 3,
    'X' => 4,
    'J' => 5,
    'V' => 6
  ]);

  define('DAYS', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes']);



  function renderSchedule($inscription) {
    $totalTime = 0;
    echo "<details> <summary>Horario desglosado</summary>";
    foreach ($inscription as $subject => $bool) {
      echo "<h2>".SUBJECTS[$subject]."</h2>";
      foreach (HORARIO[$subject] as $day => $time) {
        if($day == '+') $day = 'M';
        echo "<strong>$day:</strong> de $time[0] a $time[1]<br>";
        $totalTime += $time[1] - $time[0];
      }
    }
    echo "<h2>El total de horas en el que te has insrito es: $totalTime</h2>";
    echo "</details>";
  }

  function renderGraphicSchedule($inscription) {
    echo "<h1>Horario</h1>";
    echo "<div class='graphicSchedule'>";
    for ($i=0; $i < 5; $i++) { 
      $colStart = $i + 2;
      $colEnd = $colStart + 1;
      echo "<div class='dayLabel' style='grid-area: 1/$colStart/2/$colEnd'>".DAYS[$i]."</div>";
    }
    for ($i = 16; $i < 32; $i++) { 
      $hour = $i/2;
      $rowStart = $i - 14;
      $rowEnd = $rowStart + 1;
      $time = ($hour != floor($hour)) ? floor($hour).':30' : $hour.':00';
      echo "<div class='timeLabel' style='grid-area: $rowStart/1/$rowEnd/2;'>$time</div>";
    }
    foreach ($inscription as $subject => $bool) {
      foreach (HORARIO[$subject] as $day => $time) {
        $colStart = DAY_EQUIVALENTS[$day];
        $colEnd = $colStart + 1;
        $rowStart = $time[0] * 2 - 14;
        $rowEnd = $time[1] * 2 - 14;
        echo "<div class='scheduleItem $subject' style='grid-area: $rowStart/$colStart/$rowEnd/$colEnd;'>"
          .SUBJECTS[$subject].
        "</div>";
      }
    }
    echo "</div>";
  }

  $inscription = $_POST;
  if(empty($inscription)) echo 'Inscripción inválida.';
  else {
    renderSchedule($inscription);
    renderGraphicSchedule($inscription);
  }