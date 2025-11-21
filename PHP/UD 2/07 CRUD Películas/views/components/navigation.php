<?php session_start(); ?>

<header>
    <nav>
      <a href="../../index.php"><img src="../images/logo.png" alt="Website logo"></a>
        <?php
          if (isset($_SESSION['user_id'])) {
            echo "<a href='#'>Movies</a>";
          }
          if (($_SESSION['user_isAdmin'] ?? false) == true) {
            echo "<a href='#'>Dashboard</a>";
          }
        ?>
    </nav>
    <?php
      if (isset($_SESSION['user_displayName'])) {
        $name = $_SESSION['user_displayName'];
        $color = $_SESSION['user_color'];
        $admin = $_SESSION['user_isAdmin'];

        if ($admin) {
          echo "<button class='account-controls'>$name<span class='admin'>Admin priviledges</span></button>";
        } else {
          echo "<button class='account-controls'>$name<span style='background-color: #$color;' class='color'></span></button>";
        }
      } else {
        echo "<a href='../auth/login.php'><button class='cta'>Log in</button></a>";
      }

      // Añadir cerrar sesión
    ?>
  </header>