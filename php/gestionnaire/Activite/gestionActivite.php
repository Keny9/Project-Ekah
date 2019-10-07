<?php
/****************************************
Fichier : gestionEmploye.php
Auteur : Maxime Lussier
Fonctionnalité : Gestionnaire de communication entre l'affichage et la base de donnée
                 en ce qui concerne les employés
Date : 2019-04-15
Vérification :
Date Nom Approuvé
2019-05-03            Guillaume                  Approuvé
2019-05-03            Karl                       Approuvé
2019-05-03            William                    Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
****************************************/
include_once '../../../utils/connexion.php';
include_once '../../class/Activite/activite.php';
include_once '../../class/Activite/type_activite.php';
class GestionEmploye{
  /*
    Retourne l'employé dans la BD avec l'identifiant passé en paramètre
  */
  public function getEmploye($identifiant){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();
    $employe = null;

    $requete= "SELECT * FROM employe WHERE identifiant = '".$identifiant."';";
    $result = $conn->query($requete);
    if(!$result){
      trigger_error($conn->error);
    }

    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $employe = new Employe( $row['identifiant'],
                                $row['nom'],
                                $row['prenom'],
                                $row['courriel'],
                                $row['date_naissance'],
                                $row['date_embauche'],
                                $row['telephone'],
                                $row['nas'],
                                $row['mot_passe'],
                                $row['ville'],
                                $row['nom_rue'],
                                $row['no_porte'],
                                $row['id_poste'],
                                $row['id_etat']);


  }
  return $employe;
}

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
        $activite[] = new Activite( $row['identifiant'],
                                  $row['id_type_activite'],
                                  $row['nom'],
                                  $row['description_breve'],
                                  $row['description_longue']);
      }
    }

    return $activite;
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

      $requete= "UPDATE activite
                SET identifiant = '".$activite->getIdentifiant()."',
                id_type_activite = '".$activite->getId_type()."',
                nom = '".$activite->getNom()."',
                description_breve = '".$activite->getDescriptionC()."',
                description_longue = '".$activite->getDescriptionL()."'
                WHERE identifiant = '$oldId';";
      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }

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
