<?php session_start(); ?>

<?php require '../../services/sessionService.php'; ?>
<?php require '../../models/MovieModel.php'; ?>
<?php require '../../models/CommentModel.php'; ?>
<?php require '../../models/RatingModel.php'; ?>
<?php require '../components/htmlHead.php'; ?>
<body>
  <?php require '../components/navigation.php'; ?>
  <main class="movie-details">
    <?php
      if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $conn = new MovieModel();
        $movie = $conn->getById($id);
        
        $title = $movie->getTitle();
        $director = $movie->getDirector();
        $genre = $movie->getGenre();
        $releaseYear = $movie->getReleaseYear();
        $description = $movie->getDescription();

        $duration = $movie->getDuration();
        $hours = (intdiv($duration, 60)) . 'h';
        $minutes = ($duration % 60) . 'min';
        
        $movieGradient = explode('-', $movie->getMovieGradient());
        $color1 = $movieGradient[0];
        $color2 = $movieGradient[1];
        $tilt = $movieGradient[2] * 40;

        # Getting comments
        $connComments = new CommentModel();
        $comments = $connComments->getByMovie($id);

        echo "<h1>$title</h1>
          <div class='container'>
            <div class='container-left'>
              <div class='poster' style='background: linear-gradient($tilt"."deg, $color1, $color2);'></div>
              <p>$genre · $releaseYear</p>";

        if ($_SESSION['user_isAdmin']) {
          echo "<div class='admin-controls'>
            <h2>Admin controls</h2>
            <a href='./modify.php?id=$id'><button>Edit film</button></a>
            <button popovertarget='confirmation-modal' popovertargetaction='show'>Delete film</button>
            </div>
            <div class='confirmation-modal' id='confirmation-modal' popover='manual'>
            <h2>Are you sure you want to delete '$title'?</h2>
            <button popovertarget='confirmation-modal' popovertargetaction='hide'>Cancel</button>
            <a href='./delete.php?id=$id'><button>Delete</button></a>
            </div>";
        }

        echo "</div>
            <div class='container-right'>
              <p><strong>Director:</strong> $director</p>
              <p><strong>Duration:</strong> $hours $minutes</p>
              <p><strong>Community rating:</strong> Feature pending</p>
              <p><strong>Description:</strong> $description</p>";

        if ($comments != null) {
          echo "<section class='comments'> <hr> <h2>Comments</h2>";
          foreach ($comments as $comment) {
            $user_id = $comment->getUserId();
            $user = $comment->getUserDisplayName();
            $commentBody = $comment->getCommentBody();

            echo "<div class='comment'>
              <a href='../account/profile?id=$user_id'><strong>$user</strong></a>
              <p>$commentBody</p>
              </div>";
          }
        }

        echo "<form class='comment-box' action='./postComment.php' method='POST'>
            <h3>Post a comment</h3>
            <input type='hidden' name='id' value='$id'>
            <textarea name='commentBody' placeholder='Participate on the conversation...' required></textarea>
            <input type='submit' value='Post comment'>
          </form>
          </section>
          </div>
          </div>";
      } else {
        header('location: ./404.php');
        exit;
      }
    ?>
  </main>
</body>
</html>