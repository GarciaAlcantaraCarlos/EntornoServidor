<?php session_start(); ?>

<?php require '../../services/adminSessionService.php'; ?>
<?php require '../../models/movieModel.php'; ?>
<?php require '../components/htmlHead.php'; ?>

<?php 
  if (isset($_POST['title'])) {
    $title = htmlspecialchars($_POST['title']);
    $releaseYear = htmlspecialchars($_POST['releaseYear']);
    $director = htmlspecialchars($_POST['director']);
    $genre = htmlspecialchars($_POST['genre']);
    $duration = htmlspecialchars($_POST['duration']);
    $description = htmlspecialchars($_POST['description']);

    $colors[] = htmlspecialchars($_POST['startColor']);
    $colors[] = htmlspecialchars($_POST['endColor']);
    $colors[] = htmlspecialchars($_POST['colorTilt']);

    $movieGradient = implode('-', $colors);

    $movie = new Movie ($title, $releaseYear, $director, $genre, $duration, $description);
    $movie->setMovieGradient($movieGradient);

    $conn = new MovieModel();
    $conn->insertMovie($movie);
  }
?>

<body>
  <?php require '../components/navigation.php'; ?>
  <main>
    <h1>Add a new movie</h1>

    <form action="" method="POST">
      <div class="cols-preview">
        <div class="form-grid">
          <label for="title">Movie title:</label><input type="text" id="movie_title" name="title" maxlength="100" oninput="updateTitlePreview()" required>
          <label for="releaseYear">Release year:</label><input type="number" id="movie_releaseYear" name="releaseYear" min="1800" max="2030" required>
          <label for="director">Director:</label><input type="text" id="movie_director" name="director" maxlength="100" required>
          <label for="genre">Genre:</label><input type="text" id="movie_genre" name="genre" maxlength="50" required>
          <label for="duration">Duration:</label><input type="number" id="movie_duration" name="duration" min="1" max="600" required>
          <label for="description">Description:</label><textarea id="movie_description" name="description" cols="50" rows="10"></textarea>
        </div>
        <div>
          <div class="color-picker">
            <label>Start:<input type="color" id="movie_startColor" name="startColor" value="#dc5f20" oninput="updatePosterPreview()"></label>
            <label>End:<input type="color" id="movie_endColor" name="endColor" value="#f8d31a" oninput="updatePosterPreview()"></label>
            <label>Tilt:<input type="number" id="movie_colorTilt" name="colorTilt" min="0" max="8" value="0" oninput="updatePosterPreview()"></label>
            <button onclick="generateGradient()" type="button">🔄️</button>
          </div>
          <div id="color-preview"></div>
          <p id="title-preview"></p>
        </div>
      </div>
      <input type="submit" value="Add movie to database">
    </form>
  </main> 
</body>
<script>
  const updatePosterPreview = () => {
    const start = document.getElementById('movie_startColor').value;
    const end = document.getElementById('movie_endColor').value;
    const tilt = document.getElementById('movie_colorTilt').value * 40;


    document.getElementById('color-preview').style.background = `linear-gradient(${tilt}deg, ${start}, ${end})`;
  }

  const updateTitlePreview = () => {
    const text = document.getElementById('movie_title').value;
    document.getElementById('title-preview').innerText = text;
  }

  const generateGradient = () => {
    const letters = '0123456789ABCDEF';
    let color1 = '#';
    let color2 = '#';
    for (let i = 0; i < 6; i++) {
      color1 += letters[Math.floor(Math.random() * 16)];
      color2 += letters[Math.floor(Math.random() * 16)];
    }
    document.getElementById('movie_startColor').value = color1;
    document.getElementById('movie_endColor').value = color2;
    document.getElementById('movie_colorTilt').value = Math.floor(Math.random() * 9);
    updatePosterPreview();
  }

  updatePosterPreview();
</script>
</html>