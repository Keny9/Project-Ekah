<?php
/**
 * Classe Questionnaire.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 *
 * Nom :         questionnaire.php
 * Catégorie :   Classe
 * Auteur :      William Gonin
 * Version :     1.1
 * Date de la dernière modification : 2019-10-03
 */
  class Questionnaire{
    private $identifiant;
    private $nomQuestionnaire;



    function __construct( $identifiant,$nomQuestionnaire){
      $this->setIdentifiant($identifiant);
      $this->setNomQuestionnaire($nomQuestionnaire);


    }

    public function getIdentifiant(){
      return $this->identifiant;
    }

    public function setIdentifiant($identifiant){
      $this->identifiant = $identifiant;
    }

    public function getNomQuestionnaire(){
      return $this->nomQuestionnaire;
    }

    public function setNomQuestionnaire($nomQuestionnaire){
      $this->nomQuestionnaire = $nomQuestionnaire;
    }
  }
 ?>
