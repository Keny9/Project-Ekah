<?php
/**
 * Gestionnaire Duree.
 * Contient la methode getAllDuree
 * pour ramasser tout les durees de la BD
 *
 * Nom :         gestionDuree.php
 * Catégorie :   Gestionnaire
 * Auteur :      William Gonin
 * Version :     1.1
 * Date de la dernière modification : 2019-10-03
 */
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Duree/duree.php";
class GestionDuree{

/*
  Retourne un tableau contenant tous les durees contenus dans la BD
*/
  public function getAllDuree(){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();
    $duree = null;

    $requete= "SELECT * FROM duree";

    $result = $conn->query($requete);
    if(!$result){
      trigger_error($conn->error);
    }

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $duree[] = new Duree( $row['id'],
                                  $row['temps']);
      }
    }
    return $duree;
  }

  public function getDureesOfActivite($idActivite){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();

      $requete = "SELECT tda.id_activite, d.id, d.temps FROM ta_duree_activite AS tda
                INNER JOIN activite AS a ON tda.id_activite = a.id
                INNER JOIN duree AS d ON tda.id_duree = d.id
                WHERE tda.id_activite = $idActivite;";

      $result = $conn->query($requete);

      if(!$result){
          trigger_error($conn->error);
      }

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $duree[] = new Duree( $row['id'],$row['temps']);
        }
      }
      return $duree;
    }
  }
?>
