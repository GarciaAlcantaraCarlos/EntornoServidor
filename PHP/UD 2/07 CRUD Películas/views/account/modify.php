<?php session_start(); ?>

<?php require '../../services/sessionService.php'; ?>
<?php require '../../models/userModel.php'; ?>
<?php require '../components/htmlHead.php'; ?>

<?php 
  if (isset($_POST['userName'])) {
    $id = $_SESSION['user_id'];

    $conn = new UserModel();
    $user = $conn->getById($id);

    $userColor = ltrim($_POST['userColor'], '#');

    $user->setUserName($_POST['userName']);
    $user->setDisplayName($_POST['displayName']);
    $user->setUserColor($userColor);
    $user->setEmail($_POST['email']);

    if ($conn->updateUser($user)) {
      $_SESSION['user_displayName'] = $_POST['displayName'];
      $_SESSION['user_color'] = $userColor;
      header('location: ./profile.php');
      exit;
    } else {
      echo "Unknown error";
    }
  } 
?>

<body>
  <?php require '../components/navigation.php'; ?>
  <main>
    <h1>Editar perfil</h1>
    <form class="form-grid" action="" method="POST">
      <?php
        $id = $_SESSION['user_id'];

        $conn = new UserModel();
        $user = $conn->getById($id);

        $userName = $user->getUserName();
        $displayName = $user->getDisplayName();
        $userColor = $user->getUserColor();
        $email = $user->getEmail();

        echo "<label for='userName'>Username:</label>
          <input type='text' name='userName' id='userName' value='$userName'>
          <label for='displayName'>Display name:</label>
          <input type='text' name='displayName' id='displayName' value='$displayName'>
          <label for='email'>Email:</label>
          <input type='email' name='email' id='email' value='$email'>
          <label for='userColor'>Profile color:</label>
          <input type='color' name='userColor' id='userColor' value='#$userColor'>
          <input type='submit' value='Guardar cambios'>
          ";
      ?>
    </form>
  </main>