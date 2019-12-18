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

//Ajoute l'Achat d'une video dans la BD
  public function acheterVideo($videos_id, $utilisateur_id){
    $conn = new Connexion();

    try {
      $conn = ($connexion = new Connexion())->do();

      $req = "INSERT INTO videos_client (utilisateur_id, videos_id) VALUES (?, ?);";
      $stmt = $conn->prepare($req);
      $stmt->bind_param('ii', $utilisateur_id, $videos_id);
      $stmt->execute();

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

  public function ajouterVideo($nom, $fichier, $poster, $prix){
    $conn = new Connexion();

    try {
      $conn = ($connexion = new Connexion())->do();

      $req = "INSERT INTO videos (nom, fichier, poster, prix) VALUES (?, ?, ?, ?);";
      $stmt = $conn->prepare($req);
      $stmt->bind_param('sssi', $nom, $fichier, $poster, $prix);
      $stmt->execute();

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

}
?>
