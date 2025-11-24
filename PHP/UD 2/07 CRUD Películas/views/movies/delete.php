<?php session_start(); ?>

<?php require '../../services/adminSessionService.php'; ?>
<?php require '../../models/movieModel.php'; ?>
<?php require '../components/htmlHead.php'; ?>

<body>
  <?php require '../components/navigation.php'; ?>
  <main>
    <?php 
      if ($_SESSION['user_isAdmin']) {
        $id = $_GET['id'];

        $conn = new MovieModel();
        if ($conn->removeById($id)) {
          echo "<h1>Movie removed from database</h1>";
        } else {
          echo "Unknown error.";
        }
      }
    ?>
  </main>