<?php 
  session_start();

  if(isset($_SESSION['user_id'])){
    header("location: ./views/movies/");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Watchlist · Review movies</title>
  <link rel="icon" type="image/png" href="./views/images/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="./views/images/favicon.svg" />
  <link rel="shortcut icon" href="./views/images/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="./views/images/apple-touch-icon.png" />
  <meta name="apple-mobile-web-app-title" content="Watchlist" />
  <link rel="manifest" href="./views/images/site.webmanifest" />

  <link rel="stylesheet" href="./views/styles/baseline.css">
  <link rel="stylesheet" href="./views/styles/components.css">
  <link rel="stylesheet" href="./views/styles/onboarding.css">

  <style>
    html{ 
      height: 100dvh;
      background-image: url('./views/images/index-background-mix.webp');
      background-size: cover;
      background-position: center;
    }
  </style>
</head>
<body>
  <header>
    <nav>
      <a href="#"><img src="./views/images/logo.png" alt="Website logo"></a>
    </nav>
    <a href="./views/auth/login.php">
      <button class="cta">Log in</button>
    </a>
  </header>
  <div id="onboarding">
    <div id="gradient"></div>
    <h1>Welcome to Watchlist</h1>
    <p>Watchlist is a private service, in order to access the movie catalog you must <a href="./views/auth/login.php">log in to your account</a> or <a href="./views/auth/register.php">sign up for a new one</a></p>
  </div>
</body>
</html>