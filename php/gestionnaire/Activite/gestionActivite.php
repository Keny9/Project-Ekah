<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/activite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/type_activite.php";
//include_once '../../class/Activite/activite.php';
//include_once '../../class/Activite/type_activite.php';
class GestionActivite{
/*
  Retourne un tableau contenant tous les activite contenus dans la BD
  Prend des critères de recherche en paramètres.
  Le paramètre doit être 'null' s'il ne contient pas de critère de recherche
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

/*
Ajoute un employe à la BD ainsi que son adresse
*/
  public function ajouterActivite($activite){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();

      //Crée l'employé
      $requete= "INSERT INTO activite VALUES(
                  '".$activite->getIdentifiant()."',
                  '".$activite->getId_type()."',
                  '".$activite->getNom()."',
                  '".$activite->getDescriptionC()."',
                  '".$activite->getDescriptionL()."');";
      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
    }
  }

  /*
      Modifie un activite dans la BD
      Le paramètre oldId contient l'identifiant de l'employe avant la modification,
      puisque l'identifiant peut être modifié et qu'il est la clé primaire
  */
  public function modifierActivite($activite, $oldId){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();
      //$requete1="SET FOREIGN_KEY_CHECKS=0";
      //$result1 = $conn->query($requete1);

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
      //$requete2="SET FOREIGN_KEY_CHECKS=1";
      //$result2 = $conn->query($requete2);

  }

/*
  Supprime un activite dans la BD en prenant son identifiant en paramètre
*/
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
}
?>
