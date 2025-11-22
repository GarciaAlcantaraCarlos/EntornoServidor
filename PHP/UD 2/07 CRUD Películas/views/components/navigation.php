<header>
    <nav>
      <a href="../../index.php"><img src="../images/logo.png" alt="Website logo"></a>
        <?php
          if (isset($_SESSION['user_id'])) {
            echo "<a href='#'>Movies</a>";
          }
          if (($_SESSION['user_isAdmin'] ?? false) == true) {
            echo "<a href='../movies/create.php'>Create movie</a>";
          }
        ?>
    </nav>
    <?php
      if (isset($_SESSION['user_displayName'])) {
        $name = $_SESSION['user_displayName'];
        $color = $_SESSION['user_color'];
        $admin = $_SESSION['user_isAdmin'];

        if ($admin) {
          echo "<button class='account-controls'>$name<span class='admin'>Admin priviledges</span><span class='dropdown'><a href='../account/profile.php'>View profile</a><a href='../auth/logout.php'>Log out</a></span></button>";
        } else {
          echo "<button class='account-controls'>$name<span style='background-color: #$color;' class='color'></span><span class='dropdown'><a href='../account/profile.php'>View profile</a><a href='../auth/logout.php'>Log out</a></span></button>";
        }
      } else {
        echo "<a href='../auth/login.php'><button class='cta'>Log in</button></a>";
      }
    ?>
  </header>