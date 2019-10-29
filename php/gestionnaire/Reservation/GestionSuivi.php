<?php
/**
* Gestionnaire de suivi
*
* Nom :         GestionSuivi
* Catégorie :   Classe
* Auteur :      Maxime Lussier
* Version :     1.0
* Date de la dernière modification : 2019-10-29
*/
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";

class GestionSuivi{
  /**
  * Retourne les données d'un suivi
  *
  */
  public function getSuiviData($id_suivi){
    $conn = ($connexion = new Connexion())->do();

    $requete = "SELECT * FROM suivi WHERE id = ?";
    $stmt = $conn->prepare($requete);
    $stmt->bind_param('i', $id_suivi);
    $stmt->execute();
    $result = $stmt->get_result();
    $suivi = null;

    if ($row = $result->fetch_assoc()){
      $suivi = $row;//array('fait' => $row['fait'], 'commentaire' => $row['commentaire']);
    }

    return $suivi;
  }


  /**
  * Update les données d'un suivi
  *
  */
  public function updateSuivi($fait, $commentaire, $id_suivi){
    try{


      $conn = ($connexion = new Connexion())->do();

      $requete = "UPDATE suivi SET fait = ?, commentaire = ? WHERE id = ?";
      $stmt = $conn->prepare($requete);
      $stmt->bind_param('ssi', $fait, $commentaire, $id_suivi);
      $stmt->execute();
      $result = $stmt->get_result();

      echo var_dump($conn);
      if ($conn->affected_rows >= 1) {
        echo '<br/>record updated!<br/>';
      }
      else {
        echo '<br/>record NOT updated!<br/>';
      }
    }
    catch(Exception $e)
    {
      echo $sql . "<br>" . $e->getMessage();
    }
  }
}
?>
