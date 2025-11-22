<?php
  require_once '../../controllers/AccountController.php';
  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: ../movies/index.php');
    exit;
  }

  if (isset($_POST['userName'])) {
    $aCtrl = new AccountController();
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    if ($aCtrl->login($userName, $password)) {
      header('Location: ../movies/');
      exit;
    }
  }
?>

<?php require '../components/htmlHead.php'; ?>
<style>
  html{ 
    height: 100dvh;
    background-image: url('../images/index-background-mix.webp');
    background-size: cover;
    background-position: center;
  }
</style>
<body>
  <?php require '../components/navigation.php'; ?>
  <div id="onboarding">
    <h1>Welcome back</h1>
    <hr>
    <form action="" method="POST">
      <label><span>Username:</span><input type="text" name="userName" required></label>
      <label><span>Password:</span><input type="password" name="password" required></label>
      <input type="submit" value="Log in">
    </form>
    <p>Don't have an account? <a href="./register.php">Sign up instead.</a></p>
  </div>
</body>
</html>