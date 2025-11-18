<?php

class User {

  private $ID_user;
  private $isAdmin;
  private $displayName;
  private $userName;
  private $userColor;
  private $email;
  private $salt;
  private $pwdHash;

  public function __construct($isAdmin, $userName, $email, $pwd) {
    $this->isAdmin = $isAdmin;
    $this->userName = $userName;
    $this->email = $email;
    $this->pwdHash = $pwd;
    // To do, perform salt and hash
  }

  public function getId() { return $ID_user; }
  public function setId($id) { $this->$ID_user = $id; }

  public function getIsAdmin() { return $isAdmin; }
  public function setIsAdmin($bool) { $this->$isAdmin = $bool; }

  public function getDisplayName() { return $displayName; }
  public function setDisplayName($name) { $this->$displayName = $name; }

  public function getUserName() { return $userName; }
  public function setUserName($name) { $this->$userName = $name; }

  public function getUserColor() { return $userColor; }
  public function setUserColor($hex) { $this->$userColor = $hex; }

  public function getEmail() { return $email; }
  public function setEmail($email) { $this->$email = $email; }

  public function getSalt() { return $salt; }
  public function setSalt($salt) { $this->$salt = $salt; }

  public function getPwdHash() { return $pwdHash; }
  public function setPwdHash($hash) { $this->$pwdHash = $hash; }
  
  // TODO: tostring method
  
}