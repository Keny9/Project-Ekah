<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/activite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/type_activite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/ta_duree_activite.php";

class GestionActivite{
/*
  Retourne un tableau contenant tous les activite contenus dans la BD
*/
  public function getAllActivite(){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();
    $activite = null;

    $requete= "SELECT * FROM activite";

    $result = $conn->query($requete);
    if(!$result){
      trigger_error($conn->error);
    }

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $activite[] = new Activite( $row['id'],
                                  $row['id_type_activite'],
                                  $row['nom'],
                                  $row['description_breve'],
                                  $row['description_longue']);
      }
    }

    return $activite;
  }
  public function getActivite($id){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();
    $activite = null;
    $requete1="SET NAMES 'utf8';";
    $result1 = $conn->query($requete1);

    $requete= "SELECT * FROM activite WHERE id = '$id';";

    $result = $conn->query($requete);
    if(!$result){
      trigger_error($conn->error);
    }

    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $activite = new Activite($row['id'], $row['id_type_activite'], $row['nom'], $row['description_breve'], $row['description_longue']);
    }
    return $activite;
  }
  public function getAllTypeActivite(){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();
    $activite = null;

    $requete= "SELECT * FROM type_activite";

    $result = $conn->query($requete);
    if(!$result){
      trigger_error($conn->error);
    }

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $type_activite[] = new Type_activite( $row['id'],
                                  $row['nom'],);
      }
    }

    return $type_activite;
  }


  public function ajouterActivite($activite){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();

      //Crée l'employé
      $requete= "INSERT INTO activite VALUES(
                  '".$activite->getIdentifiant()."',
                  '".$activite->getId_type()."',
                  '".$activite->getNom()."',
                  '".$activite->getDescriptionC()."',
                  '".$activite->getDescriptionL()."',
                '".$activite->getCout()."');";
      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
    }
  }
  public function ajouterActiviteDuree($ta_activite_duree){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();

      //Crée l'employé
      $requete= "INSERT INTO ta_duree_activite VALUES(
                  '".$ta_activite_duree->getIdDuree()."',
                  '".$ta_activite_duree->getIdActivite()."');";
      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
    }
  }

  /*
      Modifie un activite dans la BD
      Le paramètre oldId contient l'identifiant de l'activite avant la modification,
      puisque l'identifiant peut être modifié et qu'il est la clé primaire
  */
  public function modifierActivite($activite, $oldId){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();

      $requete= "UPDATE activite
                SET id = '".$activite->getIdentifiant()."',
                id_type_activite = '".$activite->getId_type()."',
                nom = '".$activite->getNom()."',
                description_breve = '".$activite->getDescriptionC()."',
                description_longue = '".$activite->getDescriptionL()."'
                WHERE id = '$oldId';";
      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }
  }

  public function supprimerActivite($idActivite){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();

    $requete= "DELETE FROM activite
              WHERE id = '$idActivite';";
    $result = $conn->query($requete);
    if(!$result){
      trigger_error($conn->error);
    }
  }

  public function supprimerActiviteDuree($idActivite,$idDuree){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();

    $requete= "DELETE FROM ta_duree_activite
              WHERE id_duree = '$idDuree' AND id_activite = '$idActivite';";
    $result = $conn->query($requete);
    if(!$result){
      trigger_error($conn->error);
    }
  }

}
?>
