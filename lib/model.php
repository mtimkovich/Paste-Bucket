<?php

class Database {
  public $link;

  public function __construct() {
    $this->link = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);

    return true;
  }

  public function query($query, $vars = array()) {
    $query = $this->link->prepare($query);
    $query->execute($vars);

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public function __destruct() {
    $this->link = null;
  }
}

?>
