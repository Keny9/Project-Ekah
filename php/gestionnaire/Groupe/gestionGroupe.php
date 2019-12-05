<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Groupe/Groupe.php";
//include_once '../../class/Activite/Activite.php';
//include_once '../../class/Activite/Type_activite.php';
class GestionGroupe{

/*
Retourne un array de tous les sous-groupes
*/
  public function getAllSousGroupe(){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();
    $groupe = null;

    $requete= "SELECT * FROM groupe
    INNER JOIN type_groupe ON id_type_groupe = id
                WHERE id_type_groupe = 3";

    $result = $conn->query($requete);
    if(!$result){
      trigger_error($conn->error);
    }

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $groupe[] = new Groupe( $row['no_groupe'],
                                  $row['id_type_groupe'],
                                  $row['nom_entreprise'],
                                  $row['nom_organisateur'],
                                  $row['nb_participant']);
      }
    }

    return $groupe;
  }

  /*
  Retourne un array de tous les sous-groupes
  */
    public function getAllGroupe(){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();
      $groupe = null;

      $requete= "SELECT * FROM groupe
                  INNER JOIN type_groupe ON id_type_groupe = id
                  WHERE id_type_groupe = 2";

      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $groupe[] = new Groupe( $row['no_groupe'],
                                    $row['id_type_groupe'],
                                    $row['nom_entreprise'],
                                    $row['nom_organisateur'],
                                    $row['nb_participant']);
        }
      }

      return $groupe;
    }

/*
  Retourne le groupe d'une réservation
*/
  public function getGroupeReservation($id){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();

    $requete= "SELECT * FROM groupe
                INNER JOIN reservation ON no_groupe = id_groupe
               WHERE id = ".$id."
              ";

    $result = $conn->query($requete);
    if(!$result){
      trigger_error($conn->error);
    }

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $groupe = new Groupe($row['no_groupe'],
                            $row['id_type_groupe'],
                            $row['nom_entreprise'],
                            $row['nom_organisateur'],
                            $row['nb_participant']);
      }
    }
    return $groupe;
  }

}
?>
