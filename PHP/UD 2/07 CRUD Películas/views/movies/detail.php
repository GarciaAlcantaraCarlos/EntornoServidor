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
        $releaseYear = $movie->getReleaseYear();
        
        $movieGradient = explode('-', $movie->getMovieGradient());
        $color1 = $movieGradient[0];
        $color2 = $movieGradient[1];
        $tilt = $movieGradient[2] * 40;
      } else {
        header('location: ./404.php');
        exit;
      }
    ?>
    <h1>Movie title: The name</h1>
    <div class='container'>
      <div class='container-left'>
        <div class='poster'></div>
        <p>Science fiction · 2024</p>
      </div>
      <div class='container-right'>
        <p><strong>Directed by:</strong> A movie director</p>
        <p><strong>Duration:</strong> 2h 24min</p>
        <p><strong>Community rating:</strong> 4.5/5 (214 ratings)</p>
        <p><strong>Description:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia eaque, culpa dignissimos eum recusandae explicabo praesentium obcaecati corrupti adipisci ex repellendus veniam nesciunt omnis eligendi odio similique provident at accusamus.</p>
        <section clas='comments'>
          <h2>Comments</h2>
          <div class='comment'>
            <a href='../account/profile?id=$id'><strong>Comment poster</strong></a>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia eligendi fuga commodi voluptatum unde aliquam odio veniam vel architecto. Totam sapiente modi architecto esse nesciunt nobis placeat neque iste autem!</p>
          </div>
          <div>
            <a href='../account/profile?id=$id'><strong>Comment poster</strong></a>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia eligendi fuga commodi voluptatum unde aliquam odio veniam vel architecto. Totam sapiente modi architecto esse nesciunt nobis placeat neque iste autem!</p>
          </div>
          <form action='' method='POST'>
            <textarea name='commentBody' placeholder='Participate on the conversation...' required></textarea>
            <input type='submit' value='Post comment'>
          </form>
        </section>
      </div>
    </div>
  </main>
</body>
</html>