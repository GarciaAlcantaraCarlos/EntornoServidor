<?php session_start(); ?>

<?php require '../../services/sessionService.php'; ?>
<?php require '../../models/CommentModel.php'; ?>

<?php 
  if(isset($_POST['id'])) {
    $user_id = $_SESSION['user_id'];
    $movie_id = $_POST['id'];
    $userDisplayName = $_SESSION['user_displayName'];
    $commentBody = $_POST['commentBody'];
    
    $comment = new Comment($user_id, $movie_id, $userDisplayName, $commentBody);

    $conn = new CommentModel();
    if ($conn->insertComment($comment)) {
      header ("location: ./detail.php?id=$movie_id");
      exit;
    } else {
      echo "Unknown error.";
    }

  } else {
    header('location: ./404.php');
    exit;
  }
?>