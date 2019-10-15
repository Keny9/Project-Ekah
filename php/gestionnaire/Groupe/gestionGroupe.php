<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Groupe/Groupe.php";
//include_once '../../class/Activite/activite.php';
//include_once '../../class/Activite/type_activite.php';
class GestionActivite{

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



//   public function getActivite($id){
//     $tempconn = new Connexion();
//     $conn = $tempconn->getConnexion();
//     $activite = null;
//
//     $requete= "SELECT * FROM activite WHERE id = '$id';";
//
//     $result = $conn->query($requete);
//     if(!$result){
//       trigger_error($conn->error);
//     }
//
//     if($result->num_rows > 0){
//       $row = $result->fetch_assoc();
//       $activite = new Activite($row['id'], $row['id_type_activite'], $row['nom'], $row['description_breve'], $row['description_longue']);
//     }
//     return $activite;
//   }
//   public function getAllTypeActivite(){
//     $tempconn = new Connexion();
//     $conn = $tempconn->getConnexion();
//     $activite = null;
//
//     $requete= "SELECT * FROM type_activite";
//
//     $result = $conn->query($requete);
//     if(!$result){
//       trigger_error($conn->error);
//     }
//
//     if ($result->num_rows > 0) {
//       while($row = $result->fetch_assoc()) {
//         $type_activite[] = new Type_activite( $row['id'],
//                                   $row['nom'],);
//       }
//     }
//
//     return $type_activite;
//   }
//
// /*
// Ajoute un employe à la BD ainsi que son adresse
// */
//   public function ajouterActivite($activite){
//       $tempconn = new Connexion();
//       $conn = $tempconn->getConnexion();
//
//       //Crée l'employé
//       $requete= "INSERT INTO activite VALUES(
//                   '".$activite->getIdentifiant()."',
//                   '".$activite->getId_type()."',
//                   '".$activite->getNom()."',
//                   '".$activite->getDescriptionC()."',
//                   '".$activite->getDescriptionL()."');";
//       $result = $conn->query($requete);
//       if(!$result){
//         trigger_error($conn->error);
//     }
//   }
//   public function ajouterActiviteDuree($ta_activite_duree){
//       $tempconn = new Connexion();
//       $conn = $tempconn->getConnexion();
//
//       //Crée l'employé
//       $requete= "INSERT INTO ta_duree_activite VALUES(
//                   '".$ta_activite_duree->getIdDuree()."',
//                   '".$ta_activite_duree->getIdActivite()."');";
//       $result = $conn->query($requete);
//       if(!$result){
//         trigger_error($conn->error);
//     }
//   }
//
//   /*
//       Modifie un activite dans la BD
//       Le paramètre oldId contient l'identifiant de l'employe avant la modification,
//       puisque l'identifiant peut être modifié et qu'il est la clé primaire
//   */
//   public function modifierActivite($activite, $oldId){
//       $tempconn = new Connexion();
//       $conn = $tempconn->getConnexion();
//       //$requete1="SET FOREIGN_KEY_CHECKS=0";
//       //$result1 = $conn->query($requete1);
//
//       $requete= "UPDATE activite
//                 SET id = '".$activite->getIdentifiant()."',
//                 id_type_activite = '".$activite->getId_type()."',
//                 nom = '".$activite->getNom()."',
//                 description_breve = '".$activite->getDescriptionC()."',
//                 description_longue = '".$activite->getDescriptionL()."'
//                 WHERE id = '$oldId';";
//       $result = $conn->query($requete);
//       if(!$result){
//         trigger_error($conn->error);
//       }
//       //$requete2="SET FOREIGN_KEY_CHECKS=1";
//       //$result2 = $conn->query($requete2);
//
//   }
//
// /*
//   Supprime un activite dans la BD en prenant son identifiant en paramètre
// */
//   public function supprimerActivite($idActivite){
//     $tempconn = new Connexion();
//     $conn = $tempconn->getConnexion();
//
//     $requete= "DELETE FROM activite
//               WHERE id = '$idActivite';";
//     $result = $conn->query($requete);
//     if(!$result){
//       trigger_error($conn->error);
//     }
//   }
//
//   public function supprimerActiviteDuree($idActivite,$idDuree){
//     $tempconn = new Connexion();
//     $conn = $tempconn->getConnexion();
//
//     $requete= "DELETE FROM ta_duree_activite
//               WHERE id_duree = '$idDuree' AND id_activite = '$idActivite';";
//     $result = $conn->query($requete);
//     if(!$result){
//       trigger_error($conn->error);
//     }
//   }
}
?>
