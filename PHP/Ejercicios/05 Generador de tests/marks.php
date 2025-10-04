<style>
  * { font-family: 'JetBrains Mono'; }
  html { display: flex; flex-direction: column; align-items: center; text-align: center; justify-content: center; height: 100dvh; }
  table { border-collapse: collapse; margin-inline: auto; }
  table td { border: 1px solid black; padding: 8px 12px; }
  h2 { background-color: black; color: white; padding-block: 4px; margin-inline: 5rem; }
</style>

<?php
  define('ANSWERS', [
    "des1" => "b",
    "des2" => "b",
    "des3" => "a",
    "des4" => "a",
    "des5" => "c",
    "des6" => "a",
    "des7" => "b",
    "des8" => "a",
    "des9" => "a",
    "des10" => "a",
    "dep1" => "a",
    "dep2" => "a",
    "dep3" => "c",
    "dep4" => "b",
    "dep5" => "b",
    "dep6" => "d",
    "dep7" => "a",
    "dep8" => "a",
    "dep9" => "b",
    "dep10" => "c",
    "cli1" => "a",
    "cli2" => "a",
    "cli3" => "b",
    "cli4" => "b",
    "cli5" => "c",
    "cli6" => "c",
    "cli7" => "d",
    "cli8" => "d",
    "cli9" => "a",
    "cli10" => "c",
    "ser1" => "b",
    "ser2" => "a",
    "ser3" => "a",
    "ser4" => "b",
    "ser5" => "c",
    "ser6" => "c",
    "ser7" => "d",
    "ser8" => "d",
    "ser9" => "a",
    "ser10" => "c",
  ]);

  function checkResults($answers, $amt) {
    $totalCorrect = 0;
    $totalWrong = 0;

    foreach ($answers as $key => $answer) {
      if($answer == ANSWERS[$key]) $totalCorrect++;
      else $totalWrong++;
    }

    $unanswered = $amt - ($totalCorrect + $totalWrong);

    return ['correct' => $totalCorrect, 'wrong' => $totalWrong, 'empty' => $unanswered];
  };

  function getVerbalMark($mark) {
    $text = '';

    if ($mark < 5) $text = 'Suspenso';
    elseif ($mark < 7) $text = 'Aprobado';
    elseif ($mark < 9) $text = 'Notable';
    else $text = 'Sobresaliente';

    return $text;
  };

  function renderResults($results, $amt, $subjectName) {
    $mark = ($results['correct'] / $amt) * 10;
    $verbalMark = getVerbalMark($mark);

    echo "
      <h1>Resultados del examen de $subjectName</h1>
      <table>
        <tr>
          <td>💚</td><td>Aciertos</td><td>$results[correct]/$amt</td>
        </tr>
        <tr>
          <td>❌</td><td>Errores</td><td>$results[wrong]/$amt</td>
        </tr>
        <tr>
          <td>⬜</td><td>En blanco</td><td>$results[empty]/$amt</td>
        </tr>
      </table>
    ";
    echo "<h2>Resultado: $mark/10 - $verbalMark</h2>";
  }

  // Obtain user input
  $answers = $_POST;
  $amt = $_POST['amt'];
  $subjectName = $_POST['subjectName'];
  
  // Clean post array from hidden inputs
  unset($answers['amt']);
  unset($answers['subjectName']);

  $results = checkResults($answers, $amt);
  renderResults($results, $amt, $subjectName);


