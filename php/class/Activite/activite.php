<?php
/**
 * Classe Activite.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 *
 * Nom :         activite.php
 * Catégorie :   Classe
 * Auteur :      William Gonin
 * Version :     1.1
 * Date de la dernière modification : 2019-10-03
 */
  class Activite{
    private $identifiant;
    private $idType;
    private $nom;
    private $descriptionC;
    private $descriptionL;

    function __construct( $identifiant,$idType,$nom,$descriptionC,$descriptionL){
      $this->setIdentifiant($identifiant);
      $this->setId_type($idType);
      $this->setNom($nom);
      $this->setDescriptionC($descriptionC);
      $this->setDescriptionL($descriptionL);
    }

    /*
    * Méthode print
    * echo le contenu des variables de la classe
    */
    public function print(){
      echo "
      Id :               ".$this->getIdentifiant()."<br>
      id_type_activite : ".$this->getId_type()."<br>
      nom_lieu :   ".$this->getNom()."<br>
      description_breve : ".$this->getDescriptionC()."<br>
      description_longue : ".$this->getDescriptionL()."<br>";
    }

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

    public function getNom(){
      return $this->nom;
    }

    public function setNom($nom){
      $this->nom = $nom;
    }

    public function getDescriptionC(){
      return $this->descriptionC;
    }

    public function setDescriptionC($descriptionC){
      $this->descriptionC = $descriptionC;
    }

    public function getDescriptionL(){
      return $this->descriptionL;
    }

    public function setDescriptionL($descriptionL){
      $this->descriptionL = $descriptionL;
    }

  }
 ?>
