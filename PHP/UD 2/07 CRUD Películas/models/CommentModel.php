<?php

require_once './Connector.php';
require_once './Comment.php';

class MovieModel {

	private $connector;

	public function __construct() {
		$this->connector = new Connector();
	}

	private function rowToComment( $row ) {

		// TO-DO: if the row is empty, the function should return null
		$id = $row["ID_comment"];
		$id_movie = $row["ID_movie"];
		$id_user = $row["ID_user"];
		$commentBody = $row["commentBody"];
		$date = $row["date"];

		$comment = new Comment( $id_user, $id_movie, $commentBody);
		$comment->setId( $id );
		$comment->setDate( $date );

		return $comment;
	}

	public function getById( $id ) {
		try {
			$connection = $this->connector->connect();

			$query = $connection->prepare(
				"SELECT * FROM comments WHERE id = :id"
			);
			$query->bindParam( ':id', $id );
			$query->execute();

			$queryResult = $query->fetch();

			if ( ! $queryResult ) {
				return null;
			}

			$comment = $this->rowToComment( $queryResult );
		} catch (PDOException $exception) {
			$comment = null;
		}

		return $comment;
	}

	public function getAll() {
		try {
			$connection = $this->connector->connect();

			$query = $connection->prepare(
				"SELECT * FROM movies"
			);
			$query->execute();

			$queryResult = $query->fetch();

			$comments = [];

			foreach ( $queryResult as $row ) {
				$comments[] = $this->rowToComment( $row );
			}

		} catch (PDOException $exception) {
			$comments = null;
		}

		return $comments;
	}

	public function insertComment( $comment ) {
    try {
      $connection = $this->connector->connect();

      $query = $connection->prepare(
        "INSERT 
        INTO movies(ID_user, ID_movie, commentBody, date) 
        VALUES (:ID_user, :ID_movie, :commentBody, :date)"
      );

      $query->bindParam( ':ID_user', $comment->getUserId() );
      $query->bindParam( ':ID_movie', $comment->getMovieId() );
      $query->bindParam( ':commentBody', $comment->getCommentBody() );
      $query->bindParam( ':date', $comment->getDate() );

      $query->execute();
      $id = $this->getLastID();

      $comment->setId($id);
    } catch (PDOException $exception) {
      $comment = null;
    }

    return $comment;
	}

  public function getLastId() {

    $connection = $this->connector->connect();
    $query = $connection->prepare( "SELECT MAX(ID_user) FROM comments" );
    $query->execute();

    $queryResult = $query->fetch();

    $id = $queryResult[0];

    return $id; 
  }

  public function updateComment ( $comment ) {
    $connection = $this->connector->connect();

    $query = $connection->prepare(
      "UPDATE comments
			SET ID_user = :ID_user, ID_movie = :ID_movie, commentBody = :commentBody, date = :date
      WHERE ID_comment = :id"
    );

    $query->bindParam( ':ID_user', $comment->getUserId() );
    $query->bindParam( ':ID_movie', $comment->getMovieId() );
    $query->bindParam( ':commentBody', $comment->getCommentBody() );
    $query->bindParam( ':date', $comment->getDate() );
    $query->bindParam( ':id', $comment->getId() );

    return $query->execute();
  }


  public function removeById ( $id ) {
    $connection = $this->connector->connect();

    $query = $connection->prepare( "DELETE FROM comments WHERE ID_comment = :id" );

    $query->bindParam( ':id', $id );

    return $query->execute();
  }
}