<?php

require_once './Connector.php';
require_once './Rating.php';

class MovieModel {

	private $connector;

	public function __construct() {
		$this->connector = new Connector();
	}

	private function rowToRating( $row ) {

		// TO-DO: if the row is empty, the function should return null
		$id = $row["ID_rating"];
		$id_movie = $row["ID_movie"];
		$id_user = $row["ID_user"];
		$value = $row["value"];
		$date = $row["date"];

		$rating = new Rating( $id_user, $id_movie, $value);
		$rating->setId( $id );
		$rating->setDate( $date );

		return $rating;
	}

	public function getById( $id ) {
		try {
			$connection = $this->connector->connect();

			$query = $connection->prepare(
				"SELECT * FROM rating WHERE id = :id"
			);
			$query->bindParam( ':id', $id );
			$query->execute();

			$queryResult = $query->fetch();

			if ( ! $queryResult ) {
				return null;
			}

			$rating = $this->rowToRating( $queryResult );
		} catch (PDOException $exception) {
			$rating = null;
		}

		return $rating;
	}

	public function getAll() {
		try {
			$connection = $this->connector->connect();

			$query = $connection->prepare(
				"SELECT * FROM rating"
			);
			$query->execute();

			$queryResult = $query->fetch();

			$ratings = [];

			foreach ( $queryResult as $row ) {
				$ratings[] = $this->rowToRating( $row );
			}

		} catch (PDOException $exception) {
			$ratings = null;
		}

		return $ratings;
	}

	public function insertComment( $rating ) {
    try {
      $connection = $this->connector->connect();

      $query = $connection->prepare(
        "INSERT 
        INTO movies(ID_user, ID_movie, value, date) 
        VALUES (:ID_user, :ID_movie, :value, :date)"
      );

      $query->bindParam( ':ID_user', $rating->getUserId() );
      $query->bindParam( ':ID_movie', $rating->getMovieId() );
      $query->bindParam( ':value', $rating->getValue() );
      $query->bindParam( ':date', $rating->getDate() );

      $query->execute();
      $id = $this->getLastID();

      $rating->setId($id);
    } catch (PDOException $exception) {
      $rating = null;
    }

    return $rating;
	}

  public function getLastId() {

    $connection = $this->connector->connect();
    $query = $connection->prepare( "SELECT MAX(ID_user) FROM rating" );
    $query->execute();

    $queryResult = $query->fetch();

    $id = $queryResult[0];

    return $id; 
  }

  public function updateRating ( $rating ) {
    $connection = $this->connector->connect();

    $query = $connection->prepare(
      "UPDATE comments
			SET ID_user = :ID_user, ID_movie = :ID_movie, value = :value, date = :date
      WHERE ID_comment = :id"
    );

    $query->bindParam( ':ID_user', $rating->getUserId() );
    $query->bindParam( ':ID_movie', $rating->getMovieId() );
    $query->bindParam( ':value', $rating->getValue() );
    $query->bindParam( ':date', $rating->getDate() );
    $query->bindParam( ':id', $rating->getId() );

    return $query->execute();
  }


  public function removeById ( $id ) {
    $connection = $this->connector->connect();

    $query = $connection->prepare( "DELETE FROM rating WHERE ID_rating = :id" );

    $query->bindParam( ':id', $id );

    return $query->execute();
  }
}