<?php session_start(); ?>

<?php require '../../services/sessionService.php'; ?>
<?php require '../../models/userModel.php'; ?>
<?php require '../components/htmlHead.php'; ?>
<body>
  <?php require '../components/navigation.php'; ?>
  <main class="profile-details">
    <?php
    if (isset($_GET['pwd'])) echo "<h2>Contraseña cambiada correctamente</h2>";

    $id = $_GET['id'] ?? null;
    $owned = false;

    if ($id == null) {
      $id = $_SESSION['user_id'];
      $owned = true;
    }

    $conn = new UserModel();
    $user = $conn->getById($id);

    if ($user == null) {
      header('location: ./404.php');
      exit;
    } else {

      $userName = $user->getUserName();
      $displayName = $user->getDisplayName();
      $userColor = $user->getUserColor();
      $email = $user->getEmail();
      
      echo "<div class='color-banner' style='background-color: #$userColor;'></div>
        <h1>$displayName</h1>
        <h3>@$userName</h3>
        <p><strong>Email:</strong> $email</p>";

      if ($owned) {
        echo "<a href='./modify.php'><button>Editar perfil</button></a>";
        echo "<a href='./modifyPwd.php'><button>Cambiar contraseña</button></a>";
      }
      # include comments?

      if ($_SESSION['user_isAdmin']) {
        echo "<div class='admin-controls'>
          <h2>Admin controls</h2>
          <button popovertarget='confirmation-modal' popovertargetaction='show'>Ban user</button>
          </div>
          <div class='confirmation-modal' id='confirmation-modal' popover='manual'>
          <h2>Are you sure you want to ban @$userName?</h2>
          <button popovertarget='confirmation-modal' popovertargetaction='hide'>Cancel</button>
          <a href='./banUser.php?id=$id'><button>Ban permanently</button></a>
          </div>";
      }
    }
    ?>
  </main>
</body>
</html>