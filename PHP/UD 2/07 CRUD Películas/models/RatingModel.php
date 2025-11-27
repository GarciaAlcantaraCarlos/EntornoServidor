<?php

require_once __DIR__ . '/Connector.php';
require_once __DIR__ . '/Rating.php';

class RatingModel {

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
				"SELECT * FROM ratings WHERE ID_rating = :id"
			);
			$query->bindValue( ':id', $id );
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
				"SELECT * FROM ratings"
			);
			$query->execute();

			$queryResult = $query->fetchAll();

			$ratings = [];

			foreach ( $queryResult as $row ) {
				$ratings[] = $this->rowToRating( $row );
			}

		} catch (PDOException $exception) {
			$ratings = null;
		}

		return $ratings;
	}

	public function insertRating( $rating ) {
    try {
      $connection = $this->connector->connect();

      $query = $connection->prepare(
        "INSERT 
        INTO ratings(ID_user, ID_movie, value, date) 
        VALUES (:ID_user, :ID_movie, :value, :date)"
      );

      $query->bindValue( ':ID_user', $rating->getUserId() );
      $query->bindValue( ':ID_movie', $rating->getMovieId() );
      $query->bindValue( ':value', $rating->getValue() );
      $query->bindValue( ':date', $rating->getDate() );

      $query->execute();

      $rating->setId($connection->lastInsertId());

    } catch (PDOException $exception) {
      $rating = null;
    }

    return $rating;
	}

  public function updateRating ( $rating ) {
    $connection = $this->connector->connect();

    $query = $connection->prepare(
      "UPDATE ratings
			SET ID_user = :ID_user, ID_movie = :ID_movie, value = :value, date = :date
      WHERE ID_comment = :id"
    );

    $query->bindValue( ':ID_user', $rating->getUserId() );
    $query->bindValue( ':ID_movie', $rating->getMovieId() );
    $query->bindValue( ':value', $rating->getValue() );
    $query->bindValue( ':date', $rating->getDate() );
    $query->bindValue( ':id', $rating->getId() );

    return $query->execute();
  }


  public function removeById ( $id ) {
    $connection = $this->connector->connect();

    $query = $connection->prepare( "DELETE FROM ratings WHERE ID_rating = :id" );

    $query->bindValue( ':id', $id );

    return $query->execute();
  }
}