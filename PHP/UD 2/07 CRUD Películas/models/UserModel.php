<?php

require_once __DIR__ . '/Connector.php';
require_once __DIR__ . '/User.php';

class UserModel {

	private $connector;

	public function __construct() {
		$this->connector = new Connector();
	}

	private function rowToUser( $row ) {

		// TO-DO: if the row is empty, the function should return null
		$id = $row["ID_user"];
		$isAdmin = $row["isAdmin"];
		$displayName = $row["displayName"];
		$userName = $row["userName"];
		$userColor = $row["userColor"];
		$email = $row["email"];

		$user = new User( $isAdmin, $userName, $email );
		$user->setId( $id );
		$user->setUserColor( $userColor );
		$user->setDisplayName( $displayName );

		return $user;
	}

	public function getByID( $id ) {
		try {
			$connection = $this->connector->connect();

			$query = $connection->prepare(
				"SELECT ID_user, isAdmin, displayName, userName, userColor, email FROM users WHERE ID_user = :id"
			);
			$query->bindValue( ':id', $id );
			$query->execute();

			$queryResult = $query->fetch();

			if ( ! $queryResult ) {
				return null;
			}

			$user = $this->rowToUser( $queryResult );
		} catch (PDOException $exception) {
			$user = null;
		}

		return $user;
	}

	public function getByUserName( $userName ) {
		try {
			$connection = $this->connector->connect();

			$query = $connection->prepare(
				"SELECT ID_user, isAdmin, displayName, userName, userColor, email FROM users WHERE userName = :userName"
			);
			$query->bindValue( ':userName', $userName );
			$query->execute();

			$queryResult = $query->fetch();

			if ( ! $queryResult ) {
				return null;
			}

			$user = $this->rowToUser( $queryResult );
		} catch (PDOException $exception) {
			$user = null;
		}

		return $user;
	}

	public function getUserForAuth( $userName ) {
		try {
			$connection = $this->connector->connect();

			// Notice we're ONLY selecting the fields needed for authentication
			$query = $connection->prepare(
				"SELECT ID_user, userName, salt, pwdHash FROM users WHERE userName = :userName"
			);
			$query->bindValue( ':userName', $userName );
			$query->execute();

			$row = $query->fetch();

			if ( ! $row ) {
				return null;
			}

			return [
				'id' => $row['ID_user'],
				'userName' => $row['userName'],
				'salt' => $row['salt'],
				'pwdHash' => $row['pwdHash']
			];

		} catch (PDOException $exception) {
			// error_log( "Authentication query failed: " . $exception->getMessage() );
			return null;
		}
	}

	public function getAllUsers() {
		try {
			$connection = $this->connector->connect();

			$query = $connection->prepare(
				"SELECT ID_user, isAdmin, displayName, userName, userColor, email FROM users"
			);
			$query->execute();

			$queryResult = $query->fetchAll();

			$users = [];

			foreach ( $queryResult as $row ) {
				$users[] = $this->rowToUser( $row );
			}

		} catch (PDOException $exception) {
			$user = null;
		}
		
		return $users;
	}

	public function insertUser( $user ) {
    try {
      $connection = $this->connector->connect();

      $query = $connection->prepare(
        "INSERT 
        INTO users(isAdmin, displayName, userName, userColor, email, salt, pwdHash) 
        VALUES (:isAdmin, :displayName, :userName, :userColor, :email, :salt, :pwdHash)"
      );

      $query->bindValue( ':isAdmin', $user->getIsAdmin() );
      $query->bindValue( ':displayName', $user->getDisplayName() );
      $query->bindValue( ':userName', $user->getUserName() );
      $query->bindValue( ':userColor', $user->getUserColor() );
      $query->bindValue( ':email', $user->getEmail() );
      $query->bindValue( ':salt', $user->getSalt() );
      $query->bindValue( ':pwdHash', $user->getPwdHash() );

      $query->execute();

      $user->setId($connection->lastInsertId());
    } catch (PDOException $exception) {
      $user = null;
    }

    return $user;
	}

  public function updateUser ( $user ) {
    $connection = $this->connector->connect();

    $query = $connection->prepare(
      "UPDATE users 
      SET isAdmin = :isAdmin, displayName = :displayName, userName = :userName, userColor = :userColor, email = :email,
      WHERE ID_user = :id"
    );

    $query->bindValue( ':isAdmin', $user->getIsAdmin() );
    $query->bindValue( ':displayName', $user->getDisplayName() );
    $query->bindValue( ':userName', $user->getUserName() );
    $query->bindValue( ':userColor', $user->getUserColor() );
    $query->bindValue( ':email', $user->getEmail() );
    $query->bindValue( ':id', $user->getId() );

    return $query->execute();
  }

  public function updatePwdHash ( $user ) {
    $connection = $this->connector->connect();

    $query = $connection->prepare( "UPDATE users SET pwdHash = :pwdHash WHERE ID_user = :id" );

    $query->bindValue( ':pwdHash', $user->getPwdHash() );
    $query->bindValue( ':id', $user->getId() );

    return $query->execute();

  }
}
// $user = new User(false, 'eskaigarcia', 'yosoyeskai@gmial.com');
// $user->setSalt('abcdef');
// $user->setPwdHash('abcdef');

// $model = new UserModel();
// $model->insertUser( $user );
// print_r($model->getByUserName('eskaigarcia'));