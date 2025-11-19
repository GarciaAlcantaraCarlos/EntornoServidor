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
    $this->ID_movie = null;
    $this->title = $title;
    $this->releaseYear = $releaseYear;
    $this->director = $director;
    $this->genre = $genre;
    $this->duration = $duration;
    $this->description = $description;
    $this->movieGradient = "#808080";
  }

  public function getId() { return $this->ID_movie; }
  public function setId($id) { $this->ID_movie = $id; }

  public function getTitle() { return $this->title; }
  public function setTitle($title) { $this->title = $title; }

  public function getMovieGradient() { return $this->movieGradient; }
  public function setMovieGradient($gradient) { $this->movieGradient = $gradient; }

  public function getReleaseYear() { return $this->releaseYear; }
  public function setReleaseYear($year) { $this->releaseYear = $year; }

  public function getDirector() { return $this->director; }
  public function setDirector($director) { $this->director = $director; }

  public function getGenre() { return $this->genre; }
  public function setGenre($genre) { $this->genre = $genre; }

  public function getDuration() { return $this->duration; }
  public function setDuration($duration) { $this->duration = $duration; }

  public function getDescription() { return $this->description; }
  public function setDescription($description) { $this->description = $description; }

}