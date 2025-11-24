<?php

class Comment {

  private $ID_comment;
  private $ID_user;
  private $ID_movie;
  private $userDisplayName;
  private $commentBody;
  private $date;

  public function __construct($ID_user, $ID_movie, $userDisplayName, $commentBody) {
    $this->ID_user = $ID_user;
    $this->ID_movie = $ID_movie;
    $this->userDisplayName = $userDisplayName;
    $this->commentBody = $commentBody;
    $this->date = date("Y-m-d H:i:s");
  }

  public function getId() { return $this->ID_comment; }
  public function setId($id) { $this->ID_comment = $id; }

  public function getUserId() { return $this->ID_user; }
  public function setUserId($id) { $this->ID_user = $id; }

  public function getMovieId() { return $this->ID_movie; }
  public function setMovieId($id) { $this->ID_movie = $id; }

  public function getUserDisplayName() { return $this->userDisplayName; }
  public function setUserDisplayName($displayName) { $this->userDisplayName = $displayName; }

  public function getCommentBody() { return $this->commentBody; }
  public function setCommentBody($body) { $this->commentBody = $body; }

  public function getDate() { return $this->date; }
  public function setDate($date) { $this->date = $date; }

}