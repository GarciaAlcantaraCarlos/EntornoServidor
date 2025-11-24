<?php session_start(); ?>

<?php require '../../services/adminSessionService.php'; ?>
<?php require '../../models/commentModel.php'; ?>
<?php require '../components/htmlHead.php'; ?>

<body>
  <?php require '../components/navigation.php'; ?>
  <main>
    <?php 
      if ($_SESSION['user_isAdmin']) {
        $comment_id = $_GET['id'];
        $movie_id = $_GET['movie'];

        $conn = new CommentModel();
        if ($conn->removeById($comment_id)) {
          header("location: ./detail.php?id=$movie_id");
        } else {
          echo "Unknown error.";
        }
      }
    ?>
  </main>