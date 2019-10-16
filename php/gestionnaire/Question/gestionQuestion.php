<?php
/**
* Gestionnaire Question.
* Contient les methode d'ajout, supprimer des questions
 *
 * Nom :         gestionQuestion.php
 * Catégorie :   Gestionnaire
 * Auteur :      William Gonin
 * Version :     1.1
 * Date de la dernière modification : 2019-10-03
 */
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/question.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/type_question.php";
class GestionQuestion{

/*
  Retourne un tableau contenant tous les employés contenus dans la BD
  Prend des critères de recherche en paramètres.
  Le paramètre doit être 'null' s'il ne contient pas de critère de recherche
*/
  /*public function getAllEmploye( $column, $critere){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();
    $employe = null;

    $requete= "SELECT * FROM employe";

    if($critere != ""){
      $requete .= " WHERE ".$column." LIKE '%{$critere}%';";
    }

    $result = $conn->query($requete);
    if(!$result){
      trigger_error($conn->error);
    }

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $employe[] = new Employe( $row['identifiant'],
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
    }

    return $employe;
  }*/

/*
Ajoute un employe à la BD ainsi que son adresse
*/
  public function ajouterQuestion($question){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();
      $requete1="SET FOREIGN_KEY_CHECKS=0";
      $result1 = $conn->query($requete1);
      //Crée l'employé
      $requete= "INSERT INTO question VALUES(
                  '".$question->getIdentifiant()."',
                  '".$question->getId_type()."',
                  '".$question->getQuestion()."',
                  '".$question->getNb_ligne()."');";
      $result = $conn->query($requete);

      $requete2="SET FOREIGN_KEY_CHECKS=1";
      $result2 = $conn->query($requete2);
      if(!$result){
        trigger_error($conn->error);
      }
    }


  /*
      Modifie un employe dans la BD
      Le paramètre oldId contient l'identifiant de l'employe avant la modification,
      puisque l'identifiant peut être modifié et qu'il est la clé primaire
  */
  /*public function modifierEmploye($employe, $oldId){
    if (!is_a($employe, 'Employe')){
      echo "L'objet en paramètre doit être un employé";
      return;
    }
    else{
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();

      $requete= "UPDATE employe
                SET identifiant = '".$employe->getIdentifiant()."',
                nom = '".$employe->getNom()."',
                prenom = '".$employe->getPrenom()."',
                courriel = '".$employe->getCourriel()."',
                date_naissance = '".$employe->getDateNaissance()."',
                date_embauche = '".$employe->getDateEmbauche()."',
                telephone = '".$employe->getTelephone()."',
                nas = '".$employe->getNas()."',
                mot_passe = '".$employe->getMotDePasse()."',
                ville = '".$employe->getVille()."',
                nom_rue = '".$employe->getRue()."',
                no_porte = '".$employe->getNo()."',
                id_poste = '".$employe->getPoste()."',
                id_etat = '".$employe->getEtat()."'
                WHERE identifiant = '$oldId';";
      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }
    }
  }*/

/*
  Supprime une question dans la BD en prenant son identifiant en paramètre
*/
  public function supprimerQuestion($idQuestion){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();

    $requete= "DELETE FROM question
              WHERE id = '$idQuestion';";
    $result = $conn->query($requete);
    if(!$result){
      trigger_error($conn->error);
    }
  }

/*
  Retourne un tableau de tous les postes d'employé
*/
  /*public function getAllPoste(){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();
    $poste = null;

    $requete= "SELECT * FROM poste_employe;";
    $result = $conn->query($requete);
    if(!$result){
      trigger_error($conn->error);
    }
    else{
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $poste[] = new Poste($row['id'], $row['nom'], $row['description']);
        }
      }
    }
    return $poste;
  }*/
}
?>
