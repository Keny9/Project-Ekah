<?php
/**
 * Classe Utilisateur.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 * communs à tous les types d'utilisateurs
 *
 * Nom :         Utilisateur
 * Catégorie :   Classe
 * Auteur :      Maxime Lussier
 * Version :     1.1
 * Date de la dernière modification : 2019-09-29
 */

include_once "Client/Client.php";
include_once "Facilitateur/Facilitateur.php";

class Utilisateur extends Individu{
  private $courriel;
  private $dateNaissance;
  private $telephone;

  function __construct($id, $nom, $prenom, $dateInscription,
                      $courriel, $dateNaissance, $telephone){
    parent::__construct($id, $nom, $prenom, $dateInscription);
    $this->setCourriel($courriel);
    $this->setDateNaissance($dateNaissance);
    $this->setTelephone($telephone);
  }

  public function print(){
    parent::print();
    echo "
    Courriel : ".$this->getCourriel()."<br>
    dateNaissance : ".$this->getDateNaissance()."<br>
    Telephone : ".$this->getTelephone()."<br>";
  }

  /*
  * SETTEUR
  */
  private function setCourriel($courriel){
    $this->courriel = $courriel;
  }
  private function setDateNaissance($dateNaissance){
    $this->dateNaissance = $dateNaissance;
  }
  private function setTelephone($telephone){
    $this->telephone = $telephone;
  }

  /*
  * GETTEUR
  */
  public function getCourriel(){
    return $this->courriel;
  }
  public function getDateNaissance(){
    return $this->dateNaissance;
  }
  public function getTelephone(){
    return $this->telephone;
  }
}

 ?>
