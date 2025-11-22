<?php
if (!isset($_SESSION['user_id'])) {
  header("location: ../../index.php");
  exit;
} else if (!$_SESSION['user_isAdmin']) {
  header("location: ../auth/forbidden.php");
  exit;
}