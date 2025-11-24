<?php session_start(); ?>

<?php require '../../services/adminSessionService.php'; ?>
<?php require '../../services/AuthService.php'; ?>
<?php require '../../models/userModel.php'; ?>
<?php require '../components/htmlHead.php'; ?>
<body>
  <?php require '../components/navigation.php'; ?>

  <?php
    if ($_SESSION['user_isAdmin']) {
      $id = $_GET['id'] ?? $_SESSION['user_id'];

      $conn = new UserModel();
      $user = $conn->getById($id);

      if ($user == null) {
        header('location: ./404.php');
        exit;
      } else {
        $user->setUserName('user'.rand(100000, 999999));
        $user->setDisplayName('Banned user');
        
        $salt = $user->getSalt();
        $user->setPwdHash(AuthService::hashPassword(bin2hex(random_bytes(30)), $salt));

        $conn->updateUser($user);
        $conn->updatePwdHash($user);
      }
    } else {
      header('location: ./403.php');
      exit;
    }
  ?>
  <main>
    <h1>User banned.</h1>
  </main>
</body>
</html>