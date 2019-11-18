<?php
/**
 * Classe Region.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 * de la table Region
 *
 * Nom :         Emplacement
 * Catégorie :   Classe
 * Auteur :      Guillaume Côté
 * Version :     1.0
 * Date de la dernière modification : 2019-11-12
 */

class Region{
  private $id;
  private $nom;

  function __construct($id, $nom){
    $this->setId($id);
    $this->setNom($nom);
  }

  /*
  * SETTEUR
  */
  private function setId($val){
    $this->id = $val;
  }
  private function setNom($val){
    $this->nom = $val;
  }

  /*
  * GETTEUR
  */
  public function getId(){
    return $this->id;
  }
  public function getNom(){
    return $this->nom;
  }
}

 ?>
