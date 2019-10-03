<?php
/**
 * Classe Individu.
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

include_once "Utilisateur/Utilisateur.php";

class Individu{
  private $id;
  private $nom;
  private $prenom;
  private $dateInscription;

  function __construct($id, $nom, $prenom, $dateInscription){
    $this->setId($id);
    $this->setNom($nom);
    $this->setPrenom($prenom);
    $this->setDateInscription($dateInscription);
  }

  /*
  * Méthode print
  * echo le contenu des variables de la classe
  */
  public function print(){
    echo "
    Id : ".$this->getId()."<br>
    Nom : ".$this->getNom()."<br>
    Prenom : ".$this->getPrenom()."<br>
    Date inscription : ".$this->getDateInscription()."<br>";
  }

  /*
  * SETTEUR
  */
  protected function setId($id){
    $this->id = $id;
  }
  protected function setNom($nom){
    $this->nom = $nom;
  }
  protected function setPrenom($prenom){
    $this->prenom = $prenom;
  }
  protected function setDateInscription($dateInscription){
    $this->dateInscription = $dateInscription;
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
  public function getPrenom(){
    return $this->prenom;
  }
  public function getDateInscription(){
    return $this->dateInscription;
  }
}

 ?>
