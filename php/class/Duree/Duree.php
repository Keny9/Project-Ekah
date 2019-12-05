<?php
/**
 * Classe Duree.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 *
 * Nom :         duree.php
 * Catégorie :   Classe
 * Auteur :      William Gonin
 * Version :     1.1
 * Date de la dernière modification : 2019-10-03
 */

  class Duree{
    private $identifiant;
    private $temps;

    function __construct( $identifiant,$temps){
      $this->setIdentifiant($identifiant);
      $this->setTemps($temps);
    }

    public function getIdentifiant(){
      return $this->identifiant;
    }

    public function setIdentifiant($identifiant){
      $this->identifiant = $identifiant;
    }

    public function getTemps(){
      return $this->temps;
    }

    public function setTemps($temps){
      $this->temps = $temps;
    }


  }
 ?>
