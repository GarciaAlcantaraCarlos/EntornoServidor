<?php session_start(); ?>

<?php require '../../services/sessionService.php'; ?>
<?php require '../../models/MovieModel.php'; ?>
<?php require '../components/htmlHead.php'; ?>
<body>
  <?php require '../components/navigation.php'; ?>
  <main>
    <h1>All movies</h1>
    <div class="movie-list">
      
      <?php
        $conn = new MovieModel();
        $movies = $conn->getAll();
      
        foreach ($movies as $movie) {
          $title = $movie->getTitle();
          $genre = $movie->getGenre();
          $releaseYear = $movie->getReleaseYear();
          $id = $movie->getId();
          
          $movieGradient = explode('-', $movie->getMovieGradient());
          $color1 = $movieGradient[0];
          $color2 = $movieGradient[1];
          $tilt = $movieGradient[2] * 40;

          echo "<a href='./detail.php?id=$id'><div class='card'>
            <span class='poster' style='background: linear-gradient($tilt"."deg, $color1, $color2)'></span>
            <h3>$title</h3>
            <p>$genre · $releaseYear</p>
          </div></a>";
        }
      ?>
    </div>
  </main>
</body>
</html>