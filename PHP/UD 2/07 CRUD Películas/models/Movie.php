<?php

class Movie {

  private $ID_movie;
  private $title;
  private $movieGradient;
  private $releaseYear;
  private $director;
  private $genre;
  private $duration;
  private $description;

  public function __construct($title, $releaseYear, $director, $genre, $duration, $description) {
    $this->title = $title;
    $this->releaseYear = $releaseYear;
    $this->director = $director;
    $this->genre = $genre;
    $this->duration = $duration;
    $this->description = $description;
  }

  public function getId() { return $ID_movie; }
  public function setId($id) { $this->$ID_movie = $id; }

  public function getTitle() { return $title; }
  public function setTitle($title) { $this->$title = $title; }

  public function getMovieGradient() { return $movieGradient; }
  public function setMovieGradient($gradient) { $this->$movieGradient = $gradient; }

  public function getReleaseYear() { return $releaseYear; }
  public function setReleaseYear($year) { $this->$releaseYear = $year; }

  public function getDirector() { return $director; }
  public function setDirector($director) { $this->$director = $director; }

  public function getGenre() { return $genre; }
  public function setGenre($genre) { $this->$genre = $genre; }

  public function getDuration() { return $duration; }
  public function setDuration($duration) { $this->$duration = $duration; }

  public function getDescription() { return $description; }
  public function setDescription($description) { $this->$description = $description; }

}