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
}
?>
