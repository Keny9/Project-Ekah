<?php
class Connexion{
  private $conn;
  private $dbHost = "localhost";
  private $dbUser = "root";
  private $dbPass = "";
  private $dbName = "ekah";
  function __construct() {
    $this->conn = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
    if ($this->conn->connect_error){
      $this->closeConnexion();
      die("Connection failed: " . $this->conn->connect_error);
    }
  }
  function __destruct() {
    $this->closeConnexion();
  }
  public function getConnexion(){
    return $this->conn;
  }
  public function closeConnexion(){
    $this->conn->close();
  }
}
?>
