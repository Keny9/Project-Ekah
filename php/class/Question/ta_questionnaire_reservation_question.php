<?php
/**
 * Classe Ta_questionnaire_reservation_question.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 *
 * Nom :         ta_questionnaire_reservation_question.php
 * Catégorie :   Classe
 * Auteur :      William Gonin
 * Version :     1.1
 * Date de la dernière modification : 2019-10-03
 */
class Ta_questionnaire_reservation_question{
  private $idQuestionnaire;
  private $idQuestion;

  function __construct($idQuestionnaire, $idQuestion){
    $this->setIdQuestionnaire($idQuestionnaire);
    $this->setIdQuestion($idQuestion);
  }
  public function getIdQuestionnaire(){
    return $this->idQuestionnaire
    ;}
  public function setIdQuestionnaire($idQuestionnaire){
    $this->idQuestionnaire = $idQuestionnaire
    ;}
    public function getIdQuestion(){
      return $this->idQuestion
      ;}
  public function setIdQuestion($idQuestion){
    $this->idQuestion = $idQuestion
    ;}
} ?>
