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
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/ta_questionnaire_reservation_question.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/QuestionnaireReservation/questionnaire.php";

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
    public function ajouterQuestionnaire($questionnaire){
        $tempconn = new Connexion();
        $conn = $tempconn->getConnexion();
        //$requete1="SET FOREIGN_KEY_CHECKS=0";
        //$result1 = $conn->query($requete1);

        $requete= "INSERT INTO questionnaire VALUES(
                    '".$questionnaire->getIdentifiant()."',
                    '".$questionnaire->getNomQuestionnaire()."');";
        $result = $conn->query($requete);

        //$requete2="SET FOREIGN_KEY_CHECKS=1";
        //$result2 = $conn->query($requete2);
      }

      public function ajouterActiviteQuestionnaire($ta_activite_questionnaire){
          $tempconn = new Connexion();
          $conn = $tempconn->getConnexion();

          //Crée l'employé
          $requete= "INSERT INTO ta_activite_questionnaire_reservation VALUES(
                      '".$ta_activite_questionnaire->getIdActivite()."',
                      '".$ta_activite_questionnaire->getIdQuestionnaire()."');";
          $result = $conn->query($requete);
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

  public function getQuestionsOfActivite($idActivite){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();

      $requete = "SELECT taqr.id_activite, q.id, q.nom_questionnaire FROM ta_activite_questionnaire_reservation AS taqr
                INNER JOIN activite AS a ON taqr.id_activite = a.id
                INNER JOIN questionnaire_reservation AS q ON taqr.id_questionnaire_res = q.id
                WHERE taqr.id_activite = $idActivite;";

      $result = $conn->query($requete);

      if(!$result){
          trigger_error($conn->error);
      }

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $questionnaire[] = new Questionnaire( $row['id'],$row['nom_questionnaire']);

          $requete1 = "SELECT tqrq.id_questionnaire_res, q.id, q.id_type_question, q.question, q.nb_ligne FROM ta_questionnaire_reservation_question AS tqrq
                    INNER JOIN question AS q ON tqrq.id_question = q.id
                    INNER JOIN questionnaire_reservation AS qr ON tqrq.id_questionnaire_res = qr.id
                    WHERE tqrq.id_questionnaire_res = '".$row['id']."';";

          $result1 = $conn->query($requete1);
          if(!$result1){
              trigger_error($conn->error);
          }

          if ($result1->num_rows > 0) {
            while($row = $result1->fetch_assoc()) {
              $question[] = new Question( $row['id'],$row['id_type_question'],$row['question'],$row['nb_ligne']);
            }
        }
      }

      return $question;
    }
}
}

?>
