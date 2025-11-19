<?php

require_once './Connector.php';
require_once './Movie.php';

class MovieModel {

	private $connector;

	public function __construct() {
		$this->connector = new Connector();
	}

	private function rowToMovie( $row ) {

		// TO-DO: if the row is empty, the function should return null
		$id = $row["ID_movie"];
		$title = $row["title"];
		$movieGradient = $row["movieGradient"];
		$releaseYear = $row["releaseYear"];
		$director = $row["director"];
		$genre = $row["genre"];
		$duration = $row["duration"];
		$description = $row["description"];

		$movie = new Movie( $title, $releaseYear, $director, $genre, $duration, $description);
		$movie->setId( $id );
    $movie->setMovieGradient( $movieGradient );

		return $movie;
	}

	public function getById( $id ) {
		try {
			$connection = $this->connector->connect();

			$query = $connection->prepare(
				"SELECT * FROM movies WHERE id = :id"
			);
			$query->bindParam( ':id', $id );
			$query->execute();

			$queryResult = $query->fetch();

			if ( ! $queryResult ) {
				return null;
			}

			$movie = $this->rowToMovie( $queryResult );
		} catch (PDOException $exception) {
			$movie = null;
		}

		return $movie;
	}

	public function getAll() {
		try {
			$connection = $this->connector->connect();

			$query = $connection->prepare(
				"SELECT * FROM movies"
			);
			$query->execute();

			$queryResult = $query->fetch();

			$movies = [];

			foreach ( $queryResult as $row ) {
				$movies[] = $this->rowToMovie( $row );
			}

		} catch (PDOException $exception) {
      $movies = null;
		}

    return $movies;
	}

	public function insertMovie( $movie ) {
    try {
      $connection = $this->connector->connect();

      $query = $connection->prepare(
        "INSERT 
        INTO movies(title, movieGradient, releaseYear, director, genre, duration, description) 
        VALUES (:title, :movieGradient, :releaseYear, :director, :genre, :duration, :description)"
      );

      $query->bindParam( ':title', $movie->getTitle() );
      $query->bindParam( ':movieGradient', $movie->getMovieGradient() );
      $query->bindParam( ':releaseYear', $movie->getReleaseYear() );
      $query->bindParam( ':director', $movie->getDirector() );
      $query->bindParam( ':genre', $movie->getGenre() );
      $query->bindParam( ':duration', $movie->getDuration() );
      $query->bindParam( ':description', $movie->getDescription() );

      $query->execute();
      $id = $this->getLastID();

      $movie->setId($id);
    } catch (PDOException $exception) {
      $movie = null;
    }

    return $movie;
	}

  public function getLastId() {

    $connection = $this->connector->connect();
    $query = $connection->prepare( "SELECT MAX(ID_user) FROM movies" );
    $query->execute();

    $queryResult = $query->fetch();

    $id = $queryResult[0];

    return $id; 
  }

  public function updateMovie ( $movie ) {
    $connection = $this->connector->connect();

    $query = $connection->prepare(
      "UPDATE movies 
      SET title = :title, movieGradient = :movieGradient, releaseYear = :releaseYear, director = :director, genre = :genre, duration = :duration, description = :description
      WHERE ID_movie = :id"
    );

    $query->bindParam( ':title', $movie->getTitle() );
    $query->bindParam( ':movieGradient', $movie->getMovieGradient() );
    $query->bindParam( ':releaseYear', $movie->getReleaseYear() );
    $query->bindParam( ':director', $movie->getDirector() );
    $query->bindParam( ':genre', $movie->getGenre() );
    $query->bindParam( ':duration', $movie->getDuration() );
    $query->bindParam( ':description', $movie->getDescription() );
    $query->bindParam( ':id', $movie->getId() );

    return $query->execute();
  }


  public function removeById ( $id ) {
    $connection = $this->connector->connect();

    $query = $connection->prepare( "DELETE FROM movies WHERE ID_movie = :id" );

    $query->bindParam( ':id', $id );

    return $query->execute();
  }
}