<?php

require_once __DIR__ . '/Connector.php';
require_once __DIR__ . '/Movie.php';

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
				"SELECT * FROM movies WHERE ID_movie = :id"
			);
			$query->bindValue( ':id', $id );
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

			$queryResult = $query->fetchAll();

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

      $query->bindValue( ':title', $movie->getTitle() );
      $query->bindValue( ':movieGradient', $movie->getMovieGradient() );
      $query->bindValue( ':releaseYear', $movie->getReleaseYear() );
      $query->bindValue( ':director', $movie->getDirector() );
      $query->bindValue( ':genre', $movie->getGenre() );
      $query->bindValue( ':duration', $movie->getDuration() );
      $query->bindValue( ':description', $movie->getDescription() );

      $query->execute();

      $movie->setId($connection->lastInsertId());
    } catch (PDOException $exception) {
      $movie = null;
    }

    return $movie;
	}

  public function updateMovie ( $movie ) {
    $connection = $this->connector->connect();

    $query = $connection->prepare(
      "UPDATE movies 
      SET title = :title, movieGradient = :movieGradient, releaseYear = :releaseYear, director = :director, genre = :genre, duration = :duration, description = :description
      WHERE ID_movie = :id"
    );

    $query->bindValue( ':title', $movie->getTitle() );
    $query->bindValue( ':movieGradient', $movie->getMovieGradient() );
    $query->bindValue( ':releaseYear', $movie->getReleaseYear() );
    $query->bindValue( ':director', $movie->getDirector() );
    $query->bindValue( ':genre', $movie->getGenre() );
    $query->bindValue( ':duration', $movie->getDuration() );
    $query->bindValue( ':description', $movie->getDescription() );
    $query->bindValue( ':id', $movie->getId() );

    return $query->execute();
  }


  public function removeById ( $id ) {
    $connection = $this->connector->connect();

    $query = $connection->prepare( "DELETE FROM movies WHERE ID_movie = :id" );

    $query->bindValue( ':id', $id );

    return $query->execute();
  }
}