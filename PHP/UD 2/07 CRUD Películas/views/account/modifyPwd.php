<?php session_start(); ?>

<?php require '../../services/sessionService.php'; ?>
<?php require '../../services/AuthService.php'; ?>
<?php require '../../models/userModel.php'; ?>
<?php require '../components/htmlHead.php'; ?>

<body>
  <?php require '../components/navigation.php'; ?>
  <main>
    <h1>Editar perfil</h1>
    <?php 
      if (isset($_POST['current'])) {
        $id = $_SESSION['user_id'];

        $conn = new UserModel();
        $user = $conn->getUserForAuth($id);

        $pwdCheck = AuthService::hashPassword($_POST['current'], $user['salt']);

        if ( $pwdCheck == $user['pwdHash'] ) {
          $newPwdHash = AuthService::hashPassword($_POST['new'], $user['salt']);
          if ($conn->updatePwdHash($id, $newPwdHash)) {
            echo "header failed";
            header('location: ./profile.php?pwd=1');
            exit;
          } else {
            echo "Unknown error";
          }
        } else {
          echo "<h3 style='color: lightcoral;'>Contraseña incorrecta.</h3>";
        } 
      } 
    ?>
    <form class="form-grid" action="" method="POST">
      <?php
        $id = $_SESSION['user_id'];

        $conn = new UserModel();
        $user = $conn->getById($id);

        $userName = $user->getUserName();
        $displayName = $user->getDisplayName();
        $userColor = $user->getUserColor();
        $email = $user->getEmail();

        echo "<label for='current'>Current password:</label>
          <input type='password' name='current' id='current'>
          <label for='new'>New password:</label>
          <input type='password' name='new' id='new'>
          <input type='submit' value='Update password'>
          ";
      ?>
    </form>
  </main>