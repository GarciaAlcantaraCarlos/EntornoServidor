<?php session_start(); ?>

<?php require '../../services/sessionService.php'; ?>
<?php require '../../models/MovieModel.php'; ?>
<?php require '../components/htmlHead.php'; ?>
<body>
  <?php require '../components/navigation.php'; ?>
  <?php
    $conn = new MovieModel();
    $movies = $conn->getAll();
    var_dump($movies);
  ?>
</body>
</html>