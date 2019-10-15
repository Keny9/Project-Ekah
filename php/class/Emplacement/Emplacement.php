<?php
/**
 * Classe Emplacement.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 * de la table Emplacement
 *
 * Nom :         Emplacement
 * Catégorie :   Classe
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-10
 */

class Emplacement{
  private $id;
  private $id_type_emplacement;
  private $nom_lieu;

  function __construct($id, $id_type_emplacement, $nom_lieu){
    $this->setId($id);
    $this->setIdTypeEmplacement($id_type_emplacement);
    $this->setNomLieu($nom_lieu);
  }

  /*
  * Méthode print
  * echo le contenu des variables de la classe
  */
  public function print(){
    echo "
    Id :               ".$this->getId()."<br>
    id_type_emplacement : ".$this->getIdTypeEmplacement()."<br>
    nom_lieu :   ".$this->getNomLieu()."<br>";
  }

  /*
  * SETTEUR
  */
  private function setId($val){
    $this->id = $val;
  }
  private function setIdTypeEmplacement($val){
    $this->id_type_emplacement = $val;
  }
  private function setNomLieu($val){
    $this->nom_lieu = $val;
  }

  /*
  * GETTEUR
  */
  public function getId(){
    return $this->id;
  }
  public function getIdTypeEmplacement(){
    return $this->id_type_emplacement;
  }
  public function getNomLieu(){
    return $this->nom_lieu;
  }
}

 ?>
