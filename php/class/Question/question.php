<?php
/**
 * Classe Question.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 *
 * Nom :         question.php
 * Catégorie :   Classe
 * Auteur :      William Gonin
 * Version :     1.1
 * Date de la dernière modification : 2019-10-03
 */
  class Question{
    private $identifiant;
    private $idType;
    private $question;
    private $nbLigne;
    //private $ordre;


    function __construct( $identifiant,$idType,$question,$nbLigne, $ordre = null){
      $this->setIdentifiant($identifiant);
      $this->setId_type($idType);
      $this->setQuestion($question);
      $this->setNb_ligne($nbLigne);
      //$this->setOrdre($ordre);
    }

    /*
    * Méthode print
    * echo le contenu des variables de la classe
    */
    public function print(){
      echo "
      identifiant : ".$this->getIdentifiant()."<br>
      id_type_question : ".$this->getId_Type()."<br>
      question : ".$this->getQuestion()."<br>
      nb_ligne : ".$this->getNb_ligne()."<br>";

    }
    //ordre : ".$this->getOrdre()."<br>";

    public function getIdentifiant(){
      return $this->identifiant;
    }

    public function setIdentifiant($identifiant){
      $this->identifiant = $identifiant;
    }

    public function getId_type(){
      return $this->idType;
    }

    public function setId_Type($idType){
      $this->idType = $idType;
    }

    public function getQuestion(){
      return $this->question;
    }

    public function setQuestion($question){
      $this->question = $question;
    }

    public function getNb_ligne(){
      return $this->nbLigne;
    }

    public function setNb_ligne($nbLigne){
      $this->nbLigne = $nbLigne;
    }

    /*public function setOrdre($val){
      $this->ordre = $val;
    }
    public function getOrdre(){
      return $this->ordre;
    }*/
  }
 ?>
