<?php
/**
 * Classe mère Utilisateur.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 * communs à tous les types d'utilisateurs
 *
 * Nom :         Utilisateur
 * Catégorie :   Classe
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-09-27
 */
  require_once "Compte.php";
class Utilisateur{


  private $id;
  private $idTypeUtilisateur;
  //private $fkCompteUtilisateur;
  //private $idTypeEtatDispo;
  //private $idDisonibilite;
  private $nom;
  private $prenom;
  //private $telephone;
  //private $dateNaissance;
  private $dateInscription;

  function __construct(){
    $id = $idTypeUtilisateur = $nom = $prenom = $dateInscription = NULL;
  }
  public function init($id, $idTypeUtilisateur, $nom, $prenom, $dateInscription){
    $this->setId($id);
    $this->setIdTypeUtilisateur($idTypeUtilisateur);
    $this->setNom($nom);
    $this->setPrenom($prenom);
    $this->setDateInscription($dateInscription);
  }

  private function setId($id){
    $this->id = $id;
  }
  private function setIdTypeUtilisateur($idTypeUtilisateur){
    $this->idTypeUtilisateur = $idTypeUtilisateur;
  }
  /*private function setFkCompteUtilisateur($fkCompteUtilisateur){
    $this->fkCompteUtilisateur = $fkCompteUtilisateur;
  }
  private function setIdTypeEtatDispo($idTypeEtatDispo){
    $this->idTypeEtatDispo = $idTypeEtatDispo;
  }*/
  private function setNom($nom){
    $this->nom = $nom;
  }
  private function setPrenom($prenom){
    $this->prenom = $prenom;
  }
  private function setDateInscription($dateInscription){
    $this->dateInscription = $dateInscription;
  }

  public function getId(){
    return $this->id;
  }
  public function getIdTypeUtilisateur(){
    return $this->idTypeUtilisateur;
  }
  public function getNom(){
    return $this->nom;
  }
  public function getPrenom(){
    return $this->prenom;
  }
  public function getDateInscription(){
    return $this->dateInscription;
  }
}

 ?>
