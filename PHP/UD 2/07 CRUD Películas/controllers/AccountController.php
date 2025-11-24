<?php

  require_once __DIR__ . '/../models/UserModel.php';
  require_once __DIR__ . '/../services/AuthService.php';

  class AccountController {

    private $model;

    public function __construct() {
      $this->model = new UserModel (); 
    }

    public function login($userName, $password) {
      
      $success = false;
      $id = $this->model->getByUserName($userName)->getId();
      $authData = $this->model->getUserForAuth($id);

      if (!empty($authData)) {
        $success = AuthService::verifyPassword(
          $password, $authData['salt'], $authData['pwdHash']);
      }

      if($success) {
        session_start();

        $user = $this->model->getByID($authData['id']);
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_isAdmin'] = $user->getIsAdmin();
        $_SESSION['user_displayName'] = $user->getDisplayName();
        $_SESSION['user_color'] = $user->getUserColor();

        return true;
      }
    }

    public function register($isAdmin, $userName, $password, $email) {

      $salt = AuthService::createSalt();
      $pwdHash = AuthService::hashPassword($password, $salt);

      $user = new User($isAdmin, $userName, $email);
      $user->setSalt($salt);
      $user->setPwdHash($pwdHash);

      $user = $this->model->insertUser( $user );
      if ( $user ) {
        
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_isAdmin'] = $user->getIsAdmin();
        $_SESSION['user_displayName'] = $user->getDisplayName();
        $_SESSION['user_color'] = $user->getUserColor();

      } else {
        echo "Registration failed";
        $user = null;
      }

      return $user;
    }

    // public function updateDetails() {}
    // public function updatePassword() {}
  }