<?php
  require_once '../../controllers/AccountController.php';
  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: ../movies/index.php');
    exit;
  }

  if (isset($_POST['userName'])) {
    $aCtrl = new AccountController();

    $isAdmin = isset($_POST['isAdmin']) ? true : false;
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($aCtrl->register($isAdmin, $userName, $password, $email)) {
      header('Location: ../account/profile.php');
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
    <h1>Create an accoumt</h1>
    <hr>
    <form action="" method="POST">
      <label class="toggle">Admin account: <input type="checkbox" name="isAdmin"></label>
      <label><span>Username:</span><input type="text" name="userName" required></label>
      <label><span>Email:</span><input type="email" name="email" required></label>
      <label><span>Password:</span><input type="password" name="password" required></label>
      <input type="submit" value="Create account">
    </form>
    <p>Already have an account? <a href="./login.php">Login to an existing account.</a></p>
  </div>
</body>
</html>