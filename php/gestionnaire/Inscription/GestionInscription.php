<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Inscription/Inscription.php";


class GestionIncription{

  /*
  Retourne un array des inscriptions relié à un groupe
  */
    public function getInscriptionGroupe($no_groupe){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();
      $inscription = null;

      $requete= "SELECT * FROM inscription
                  WHERE id_groupe = ".$no_groupe."";

      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $inscription[] = new Inscription( $row['id_utilisateur'],
                                    $row['id_groupe'],
                                    $row['date_inscription']);
        }
      }

      return $inscription;
    }

}
?>
