<?php

require_once __DIR__ . '/Connector.php';
require_once __DIR__ . '/Comment.php';

class CommentModel {

	private $connector;

	public function __construct() {
		$this->connector = new Connector();
	}

	private function rowToComment( $row ) {

		// TO-DO: if the row is empty, the function should return null
		$id = $row["ID_comment"];
		$id_movie = $row["ID_movie"];
		$id_user = $row["ID_user"];
		$userDisplayName = $row["userDisplayName"];
		$commentBody = $row["commentBody"];
		$date = $row["date"];

		$comment = new Comment( $id_user, $id_movie, $userDisplayName, $commentBody);
		$comment->setId( $id );
		$comment->setDate( $date );

		return $comment;
	}

	public function getById( $id ) {
		try {
			$connection = $this->connector->connect();

			$query = $connection->prepare(
				"SELECT * FROM comments WHERE ID_comment = :id"
			);
			$query->bindValue( ':id', $id );
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
				"SELECT * FROM comments"
			);
			$query->execute();

			$queryResult = $query->fetchAll();

			$comments = [];

			foreach ( $queryResult as $row ) {
				$comments[] = $this->rowToComment( $row );
			}

		} catch (PDOException $exception) {
			$comments = null;
		}

		return $comments;
	}

	public function getByMovie ( $movie_id ) {
		try {
			$connection = $this->connector->connect();

			$query = $connection->prepare(
				"SELECT * FROM comments WHERE ID_movie = :id"
			);
			$query->bindValue( ':id', $movie_id );
			$query->execute();

			$queryResult = $query->fetchAll();

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
        INTO comments(ID_user, ID_movie, userDisplayName, commentBody, date) 
        VALUES (:ID_user, :ID_movie, :userDisplayName, :commentBody, :date)"
      );

      $query->bindValue( ':ID_user', $comment->getUserId() );
      $query->bindValue( ':ID_movie', $comment->getMovieId() );
      $query->bindValue( ':userDisplayName', $comment->getUserDisplayName() );
      $query->bindValue( ':commentBody', $comment->getCommentBody() );
      $query->bindValue( ':date', $comment->getDate() );

      $query->execute();

			$comment->setId($connection->lastInsertId());
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

    $query->bindValue( ':ID_user', $comment->getUserId() );
    $query->bindValue( ':ID_movie', $comment->getMovieId() );
    $query->bindValue( ':commentBody', $comment->getCommentBody() );
    $query->bindValue( ':date', $comment->getDate() );
    $query->bindValue( ':id', $comment->getId() );

    return $query->execute();
  }


  public function removeById ( $id ) {
    $connection = $this->connector->connect();

    $query = $connection->prepare( "DELETE FROM comments WHERE ID_comment = :id" );

    $query->bindValue( ':id', $id );

    return $query->execute();
  }
}