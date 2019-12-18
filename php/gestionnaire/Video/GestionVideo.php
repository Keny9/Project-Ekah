<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";

class GestionVideo{
  public function ajouterVideoClient($idVideo, $idClient){
    $conn = new Connexion();

    try {
      $conn = ($connexion = new Connexion())->do();

      // Ajoute une video à un client dans la BD
        $requete = "INSERT INTO videos_client (utilisateur_id, videos_id) VALUES (?, ?)";

        $stmt = $conn->prepare($requete);
        $stmt->bind_param('ii',$idClient, $idVideo);
        $status = $stmt->execute();

        if($status === false){
          trigger_error($stmt->error, E_USER_ERROR);
        }

        // Commit la transaction
        $conn->commit();
        return true;
      } catch (Exception $e) {
        // Rollback la transaction
        $conn->do()->rollback();
        echo "Erreur try-catch : ".$e."<br>";
        return false;
      }
    }

    public function consulterVideosTable(){
      $conn = new Connexion();

      try {
        $conn = ($connexion = new Connexion())->do();

      $videosTable = null;

      $conn = ($temp = new Connexion())->do();
      $req = "SELECT * FROM videos";
      $stmt = $conn->prepare($req);

      if($stmt) {
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()){
          $videosTable[] = $row;
        }

      }
      return $videosTable;
    }
    }
      public function consulterVideos_clientTable(){
        $conn = new Connexion();

        try {
          $conn = ($connexion = new Connexion())->do();

          $videos_clientTable = null;

          $conn = ($temp = new Connexion())->do();
          $req = "SELECT * FROM videos_client";
          $stmt = $conn->prepare($req);

          if($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()){
              $videos_clientTable[] = $row;
            }

          }

          return $videos_clientTable;
        }

}
?>
