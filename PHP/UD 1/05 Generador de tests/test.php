<style>
  * { font-family: 'JetBrains Mono'; }
  html { display: flex; flex-direction: column; align-items: center; justify-content: center; }
  table { width: 100%; border-collapse: collapse; }
  table td { border: 1px solid black; padding: 4px 6px; }
  table tr td:last-child { width: 2px; }
  input[type=submit] { margin-top: 8px; display: block; margin-inline: auto; }
  input[type=radio] { display: none; }
  input.hidden { display: none; visibility: hidden; opacity: 0; color: transparent; background-color: transparent; outline: none; }
  label { cursor: pointer; display: block; }
  table tr:has(input:checked) { background-color: #ffe9b0; }
  h1 { background-color: black; color: white; padding-block: 8px; text-align: center; }
  h2 { margin-bottom: 8px; max-width: 35em; }
</style>

<?php
  define("QUESTIONS", [
    "design" => [
      "des1" => [
        "question" => "¿Qué hace la propiedad CSS 'display: flex'?",
        "options" => [
          "a" => "Crea un diseño de tabla",
          "b" => "Permite un diseño de caja flexible",
          "c" => "Agrega un borde automático",
          "d" => "Oculta un elemento"
        ]
      ],
      "des2" => [
        "question" => "¿Cómo centras un div horizontalmente usando CSS?",
        "options" => [
          "a" => "text-align: center",
          "b" => "margin: auto",
          "c" => "display: inline-block",
          "d" => "float: left"
        ]
      ],
      "des3" => [
        "question" => "¿Cuál es la diferencia entre 'margin' y 'padding' en CSS?",
        "options" => [
          "a" => "Margin es espacio externo, padding es espacio interno",
          "b" => "Margin agrega color, padding agrega tamaño",
          "c" => "Margin se aplica solo a texto, padding solo a imágenes",
          "d" => "No hay diferencia"
        ]
      ],
      "des4" => [
        "question" => "¿Cómo aplicas una imagen de fondo en CSS?",
        "options" => [
          "a" => "background-image: url('imagen.jpg');",
          "b" => "img-background: url('imagen.jpg');",
          "c" => "set-background: imagen.jpg;",
          "d" => "background: imagen;"
        ]
      ],
      "des5" => [
        "question" => "¿Qué controla la propiedad 'z-index'?",
        "options" => [
          "a" => "El color de un elemento",
          "b" => "El tamaño de fuente",
          "c" => "El orden de apilamiento de los elementos",
          "d" => "La transparencia"
        ]
      ],
      "des6" => [
        "question" => "¿Cómo haces un diseño responsivo en CSS?",
        "options" => [
          "a" => "Usando media queries",
          "b" => "Con tablas",
          "c" => "Solo con z-index",
          "d" => "Mediante colores adaptativos"
        ]
      ],
      "des7" => [
        "question" => "¿Qué es un selector en CSS?",
        "options" => [
          "a" => "Una función de JavaScript",
          "b" => "Una forma de elegir qué elementos aplicar estilos",
          "c" => "Un tipo de variable",
          "d" => "Un archivo CSS externo"
        ]
      ],
      "des8" => [
        "question" => "¿Cómo importas una fuente de Google en CSS?",
        "options" => [
          "a" => "@import url('https://fonts.googleapis.com/...');",
          "b" => "import-font: google;",
          "c" => "font-google: url(...);",
          "d" => "add-font('google');"
        ]
      ],
      "des9" => [
        "question" => "¿Cuál es la diferencia entre las unidades 'em' y 'rem'?",
        "options" => [
          "a" => "em depende del tamaño de fuente del padre, rem de la raíz",
          "b" => "rem depende del padre, em de la raíz",
          "c" => "Son exactamente iguales",
          "d" => "Solo se usan en bordes"
        ]
      ],
      "des10" => [
        "question" => "¿Cómo creas una transición CSS para un efecto hover?",
        "options" => [
          "a" => "transition: all 0.3s;",
          "b" => "hover-transition: 0.3s;",
          "c" => "animate-hover: fast;",
          "d" => "hover: smooth;"
        ]
      ]
    ],

    "deploy" => [
      "dep1" => [
        "question" => "¿Para qué sirve 'git clone'?",
        "options" => [
          "a" => "Descargar un repositorio remoto",
          "b" => "Eliminar un repositorio local",
          "c" => "Actualizar un repositorio existente",
          "d" => "Fusionar ramas"
        ]
      ],
      "dep2" => [
        "question" => "¿Cómo añades archivos al área de preparación (staging) en Git?",
        "options" => [
          "a" => "git add",
          "b" => "git stage",
          "c" => "git push",
          "d" => "git commit"
        ]
      ],
      "dep3" => [
        "question" => "¿Qué hace 'git pull'?",
        "options" => [
          "a" => "Solo descarga cambios",
          "b" => "Sube los cambios al remoto",
          "c" => "Descarga y fusiona cambios desde el remoto",
          "d" => "Crea una nueva rama"
        ]
      ],
      "dep4" => [
        "question" => "¿Cómo resuelves un conflicto de fusión (merge conflict) en Git?",
        "options" => [
          "a" => "Usando git delete",
          "b" => "Editando los archivos en conflicto y confirmando",
          "c" => "Con git fix-conflict",
          "d" => "No se puede resolver"
        ]
      ],
      "dep5" => [
        "question" => "¿Qué es una rama (branch) en Git?",
        "options" => [
          "a" => "Una copia de seguridad",
          "b" => "Un historial alterno de desarrollo",
          "c" => "Un archivo oculto",
          "d" => "Un tipo de commit"
        ]
      ],
      "dep6" => [
        "question" => "¿Cómo ves el historial de commits en Git?",
        "options" => [
          "a" => "git show-all",
          "b" => "git history",
          "c" => "git commits",
          "d" => "git log"
        ]
      ],
      "dep7" => [
        "question" => "¿Cuál es la diferencia entre 'git fetch' y 'git pull'?",
        "options" => [
          "a" => "fetch descarga sin fusionar, pull descarga y fusiona",
          "b" => "fetch elimina ramas, pull crea ramas",
          "c" => "Son idénticos",
          "d" => "fetch sube cambios, pull los baja"
        ]
      ],
      "dep8" => [
        "question" => "¿Cómo deshaces el último commit en Git?",
        "options" => [
          "a" => "git reset --hard HEAD~1",
          "b" => "git undo",
          "c" => "git delete last",
          "d" => "git revert HEAD~1"
        ]
      ],
      "dep9" => [
        "question" => "¿Qué hace 'git push'?",
        "options" => [
          "a" => "Descarga cambios desde remoto",
          "b" => "Sube cambios locales al repositorio remoto",
          "c" => "Fusiona ramas automáticamente",
          "d" => "Crea un repositorio"
        ]
      ],
      "dep10" => [
        "question" => "¿Cómo creas una nueva rama en Git?",
        "options" => [
          "a" => "git new-branch nombre",
          "b" => "git create rama",
          "c" => "git branch nombre-rama",
          "d" => "git add-branch"
        ]
      ]
    ],

    "client" => [
      "cli1" => [
        "question" => "¿Qué es un componente en React?",
        "options" => [
          "a" => "Una función o clase que retorna JSX",
          "b" => "Una etiqueta HTML estándar",
          "c" => "Un archivo CSS",
          "d" => "Un servidor de Node.js"
        ]
      ],
      "cli2" => [
        "question" => "¿Cómo pasas props a un componente de React?",
        "options" => [
          "a" => "Usando atributos en el JSX",
          "b" => "Declarando variables globales",
          "c" => "Con useState",
          "d" => "Desde el archivo CSS"
        ]
      ],
      "cli3" => [
        "question" => "¿Para qué sirve 'useState' en React?",
        "options" => [
          "a" => "Para conectar con una API",
          "b" => "Para crear y manejar estado en un componente",
          "c" => "Para aplicar estilos",
          "d" => "Para definir rutas"
        ]
      ],
      "cli4" => [
        "question" => "¿Cómo manejas eventos en React?",
        "options" => [
          "a" => "Usando addEventListener directamente",
          "b" => "Agregando atributos como onClick al JSX",
          "c" => "Con archivos JSON",
          "d" => "No se pueden manejar"
        ]
      ],
      "cli5" => [
        "question" => "¿Qué es JSX?",
        "options" => [
          "a" => "Un tipo de CSS",
          "b" => "Un lenguaje de plantillas externo",
          "c" => "Una extensión de JavaScript que permite escribir HTML dentro de JS",
          "d" => "Un sistema de bases de datos"
        ]
      ],
      "cli6" => [
        "question" => "¿Cómo renderizas elementos condicionalmente en React?",
        "options" => [
          "a" => "Con CSS",
          "b" => "Con if directamente dentro del return",
          "c" => "Usando operadores lógicos (&& o ? :) en JSX",
          "d" => "No es posible"
        ]
      ],
      "cli7" => [
        "question" => "¿Qué es el DOM virtual en React?",
        "options" => [
          "a" => "Una API de Node.js",
          "b" => "Un navegador diferente",
          "c" => "Un archivo de configuración",
          "d" => "Una representación ligera del DOM real en memoria"
        ]
      ],
      "cli8" => [
        "question" => "¿Cómo obtienes datos de una API en React?",
        "options" => [
          "a" => "No se pueden obtener",
          "b" => "Con una etiqueta HTML",
          "c" => "Directamente desde CSS",
          "d" => "Usando fetch o Axios en useEffect"
        ]
      ],
      "cli9" => [
        "question" => "¿Qué es un hook en React?",
        "options" => [
          "a" => "Una función especial para manejar estado o ciclo de vida",
          "b" => "Un tipo de componente",
          "c" => "Un archivo de estilos",
          "d" => "Un servidor de React"
        ]
      ],
      "cli10" => [
        "question" => "¿Cómo elevas el estado (lift state up) en React?",
        "options" => [
          "a" => "Creando un nuevo hook",
          "b" => "Usando CSS global",
          "a" => "Pasando el estado a un componente padre y compartiéndolo vía props",
          "d" => "Con variables locales"
        ]
      ]
    ],

    "server" => [
      "ser1" => [
        "question" => "¿Qué es PHP?",
        "options" => [
          "a" => "Un sistema operativo",
          "b" => "Un lenguaje de programación de servidor",
          "c" => "Una librería de JavaScript",
          "d" => "Un motor de base de datos"
        ]
      ],
      "ser2" => [
        "question" => "¿Cómo declaras una variable en PHP?",
        "options" => [
          "a" => "\$nombre = 'valor';",
          "b" => "var nombre = 'valor';",
          "c" => "let nombre = 'valor';",
          "d" => "const nombre = 'valor';"
        ]
      ],
      "ser3" => [
        "question" => "¿Cómo conectas a una base de datos MySQL en PHP?",
        "options" => [
          "a" => "mysqli_connect('host','user','pass','db');",
          "b" => "mysql.connect('db');",
          "c" => "connect_db('mysql');",
          "d" => "db.connect('php');"
        ]
      ],
      "ser4" => [
        "question" => "¿Cuál es la diferencia entre 'echo' y 'print' en PHP?",
        "options" => [
          "a" => "echo es más lento que print",
          "b" => "echo no retorna valor, print retorna 1",
          "c" => "print es exclusivo para arrays",
          "d" => "Son idénticos en todo"
        ]
      ],
      "ser5" => [
        "question" => "¿Cómo manejas datos de un formulario en PHP?",
        "options" => [
          "a" => "Usando console.log",
          "b" => "Con fetch()",
          "c" => "Con \$_GET o \$_POST",
          "d" => "Con HTML puro"
        ]
      ],
      "ser6" => [
        "question" => "¿Qué es una sesión en PHP?",
        "options" => [
          "a" => "Un tipo de variable global",
          "b" => "Un archivo CSS",
          "c" => "Un mecanismo para almacenar información entre peticiones",
          "d" => "Un servidor web"
        ]
      ],
      "ser7" => [
        "question" => "¿Cómo incluyes un archivo PHP en otro?",
        "options" => [
          "a" => "include 'archivo.php';",
          "b" => "import 'archivo.php';",
          "c" => "require_once();",
          "d" => "include() o require()"
        ]
      ],
      "ser8" => [
        "question" => "¿Cómo defines una función en PHP?",
        "options" => [
          "a" => "func nombre() { ... }",
          "b" => "def nombre() { ... }",
          "c" => "fn nombre() => { ... }",
          "d" => "function nombre() { ... }"
        ]
      ],
      "ser9" => [
        "question" => "¿Para qué sirven 'require' e 'include' en PHP?",
        "options" => [
          "a" => "Para insertar y ejecutar archivos externos",
          "b" => "Para crear nuevas variables",
          "c" => "Para conectarse a bases de datos",
          "d" => "Para iniciar sesiones"
        ]
      ],
      "ser10" => [
        "question" => "¿Cómo envías un correo electrónico usando PHP?",
        "options" => [
          "a" => "Con email.send()",
          "b" => "Con sendMail()",
          "c" => "Con la función mail()",
          "d" => "Con correo.php()"
        ]
      ]
    ]
  ]);

  function validateSubject($subject) {
    if ($subject !== 'design' && $subject !== 'deploy' &&
        $subject !== 'client' && $subject !== 'server') {
          $subject = 0;
    };
    return $subject;
  };

  function validateAmount($amt) {
    if ($amt < 1 || $amt > 5) {
          $amt = 0;
    };
    return $amt;
  };

  function getSubjectName($subject) {
    $subjectName = '';
    if ($subject == 'design') $subjectName = 'Diseño de interfaces';
    if ($subject == 'deploy') $subjectName = 'Despliegue de aplicaciones';
    if ($subject == 'client') $subjectName = 'Desarrollo entorno cliente';
    if ($subject == 'server') $subjectName = 'Desarrollo entorno servidor';
    return $subjectName;
  }

  function renderExam($subject, $amt) {
    // Generate random numbers, as many as requested, never repeating
    $rngSet = [];
    for ($i = 0; $i < $amt; $i++) {
      do { $randomInt = random_int(1, 10); }
      while (in_array($randomInt, $rngSet));
      $rngSet[] = $randomInt;
    }

    $subjectName = getSubjectName($subject);
    
    // Render website
    echo "<h1>Examen de $subjectName</h1>";
    echo "<form action='./marks.php' method='POST'>";
    echo "<input class='hidden' type='hidden' name='subjectName' value='$subjectName'>";
    echo "<input class='hidden' type='hidden' name='amt' value='$amt'>";

    // Render each question
    $subjectShorthand = substr($subject, 0, 3);
    foreach ($rngSet as $key => $questionNumber) {
      echo "
        <h2>". QUESTIONS[$subject][$subjectShorthand.$questionNumber]['question']."</h2>
        <table>";
      
      foreach (QUESTIONS[$subject][$subjectShorthand.$questionNumber]['options'] as $opt => $text) {
        echo "
        <tr>
          <td>
            <label for='$subjectShorthand$questionNumber$opt'>$opt) $text</label>
            <input type='radio' id='$subjectShorthand$questionNumber$opt' 
              name='$subjectShorthand$questionNumber' value='$opt'>
            </td>
        </tr>";
      }
      echo "</table>";
    }
    echo "<input type='submit' value='Entregar examen'>";
    echo "</form>";
  };

  // Get the user selection
  $subject = htmlspecialchars($_POST['subject']) ?? '';
  $amt = htmlspecialchars($_POST['amt']) ?? '';

  // Perform validations
  $subject = validateSubject($subject);
  $amt = validateAmount($amt);

  // Output content
  if ($subject == 0 || $amt == 0){
    echo "Invalid inputs."; 
  } else {
    renderExam($subject, $amt);
  };