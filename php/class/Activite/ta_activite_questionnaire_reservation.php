<?php
/**
 * Classe Ta_activite_questionnaire_reservation.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 *
 * Nom :         ta_activite_questionnaire_reservation.php
 * Catégorie :   Classe
 * Auteur :      William Gonin
 * Version :     1.1
 * Date de la dernière modification : 2019-10-03
 */
class Ta_activite_questionnaire_reservation{
  private $idActivite;
  private $idQuestionnaire;

  function __construct($idActivite, $idQuestionnaire){
    $this->setIdActivite($idActivite);
    $this->setIdQuestionnaire($idQuestionnaire);
  }
  public function getIdActivite(){
    return $this->idActivite
    ;}
  public function setIdActivite($idActivite){
    $this->idActivite = $idActivite
    ;}
    public function getIdQuestionnaire(){
      return $this->idQuestionnaire
      ;}
  public function setIdQuestionnaire($idQuestionnaire){
    $this->idQuestionnaire = $idQuestionnaire
    ;}
} ?>
