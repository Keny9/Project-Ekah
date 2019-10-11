<?php
/**
 * Classe Inscription.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 * d'une inscription.
 * Sert à relier un Individu ou Utilisateur à un groupe
 *
 * Nom :         Inscription
 * Catégorie :   Classe
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-10
 */

class Inscription{
  private $id_utilisateur;
  private $id_groupe;
  private $date_inscription;

  function __construct($id_utilisateur, $id_groupe, $date_inscription){
     $this->setIdUtilisateur($id_utilisateur);
     $this->setIdGroupe($id_groupe);
     $this->setDateInscription($date_inscription);
  }

  /*
  * Méthode print
  * echo le contenu des variables de la classe
  */
  public function print(){
    echo "
    id_utilisateur : ".$this->getIdUtilisateur()."<br>
    id_groupe : ".$this->getIdGroupe()."<br>
    date_inscription : ".$this->getDateInscription()."<br>";
  }

  /*
  * SETTEUR
  */
  private function setIdUtilisateur($val){
    $this->id_utilisateur = $val;
  }
  private function setIdGroupe($val){
    $this->id_groupe = $val;
  }
  private function setDateInscription($val){
    $this->date_inscription = $val;
  }

  /*
  * GETTEUR
  */
  public function getIdUtilisateur(){
    return $this->id_utilisateur;
  }
  public function getIdGroupe(){
    return $this->id_groupe;
  }
  public function getDateInscription(){
    return $this->date_inscription;
  }

}

 ?>
