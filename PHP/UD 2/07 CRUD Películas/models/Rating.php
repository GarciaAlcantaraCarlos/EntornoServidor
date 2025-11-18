<?php

class Rating {
  
  private $ID_rating;
  private $ID_user;
  private $ID_movie;
  private $value;
  private $date;

  public function __construct($ID_user, $ID_movie, $value) {
    $this->ID_user = $ID_user;
    $this->ID_movie = $ID_movie;
    $this->value = $value;
    $this->date = date("Y-m-d H:i:s");
  }

  public function getId() { return $ID_rating; }
  public function setId($id) { $this->$ID_rating = $id; }

  public function getUserId() { return $ID_user; }
  public function setUserId($id) { $this->$ID_user = $id; }

  public function getMovieId() { return $ID_movie; }
  public function setMovieId($id) { $this->$ID_movie = $id; }

  public function getValue() { return $value; }
  public function setValue($value) { $this->$value = $value; }

  public function getDate() { return $date; }
  public function setDate($date) { $this->$date = $date; }

}