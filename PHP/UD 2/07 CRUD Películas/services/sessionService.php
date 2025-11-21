<?php

session_start();

if (!isset($_SESSION['user_displayName'])) {
  $location = __DIR__ . '../../index.php';
  header("location: $location");
}