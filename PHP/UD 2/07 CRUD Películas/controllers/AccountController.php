<?php

  require_once '../models/UserModel.php';
  require_once '../services/AuthService.php';

  class AccountController {

    private $model;

    public function __construct() {
      $this->model = new UserModel (); 
    }

    public function login() {
      $username = $_POST['userName'];
      $password = $_POST['password'];

      $authData = $this->model->getUserForAuth($username);

      if (!empty($authData)) {
        $success = AuthService::verifyPassword(
          $password, $authData['salt'], $authData['pwdHash']);
      }

      if($success) {
        $user = $this->model->getByID($authData['id']);
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_name'] = $user->getDisplayName();
        $_SESSION['user_color'] = $user->getUserColor();

        header('Location: /views/movies/');
      } else {
        echo "Login failed";
      }
    }

    public function register() {
      $userName = $_POST['userName'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $isAdmin = $_POST['isAdmin'];
      $salt = AuthService::createSalt();
      $pwdHash = AuthService::hashPassword($password, $salt);

      $user = new User($isAdmin, $userName, $email);
      $user->setSalt($salt);
      $user->setPwdHash($pwdHash);

      if ( $this->model->insertUser( $user ) ) {
        $id = $this->model->getLastId();
        $user = $this->model->getByID($id);
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_name'] = $user->getDisplayName();
        $_SESSION['user_color'] = $user->getUserColor();

        header('Location: /views/account/profile.php');
      } else {
        echo "Registration failed";
      }
    }

    // public function updateDetails() {}
    // public function updatePassword() {}
  }