<?php
/**
 * Classe Facilitateur. Enfant de Utilisateur.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 * communs aux Facilitateur.
 *
 * Nom :         Facilitateur
 * Catégorie :   Classe
 * Auteur :      Guillaume Côté
 * Version :     1.1
 * Date de la dernière modification : 2019-10-13
 */

$path = $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Utilisateur.php";
include_once $path;


class Facilitateur extends Utilisateur{
  private $etat;
  private $disponibilite;
  private $photo;


  function __construct($id, $nom, $prenom, $dateInscription,
                       $courriel, $dateNaissance, $telephone,
                       $etat, $disponibilite){
    parent::__construct($id, $nom, $prenom, $dateInscription,
                       $courriel, $dateNaissance, $telephone);
   $this->setEtat($etat);
   $this->setDisponibilite($disponibilite);
 }

  private function setEtat($val){
    $this->etat = $val;
  }
  public function setDisponibilite($val){
    $this->disponibilite = $val;
  }
  public function setPhoto($val){
    $this->photo = $val;
  }

  public function getRue(){
    return $this->etat;
  }
  public function getDisponibilite(){
    return $this->disponibilite;
  }
  public function getPhoto(){
    return $this->photo;
  }

}



 ?>
