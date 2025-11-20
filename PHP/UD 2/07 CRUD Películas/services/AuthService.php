<?php

class AuthService {
    
  public static function createSalt() {
    return bin2hex(random_bytes(16));
  }

  public static function hashPassword($plain, $salt) { 
    return hash('sha256', $salt . $plain);
  }

  public static function verifyPassword($plain, $salt, $hash) { 
    return self::hashPassword($plain, $salt) === $hash;
  }
}