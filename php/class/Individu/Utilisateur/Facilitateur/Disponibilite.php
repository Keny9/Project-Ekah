<?php
/**
 * Classe disponibilite.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 * de la table disponibilité
 *
 * Nom :         disponibilite
 * Catégorie :   Classe
 * Auteur :      Guillaume Côté
 * Version :     1.0
 * Date de la dernière modification : 2019-10-10
 */

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Region/Region.php";

class Disponibilite{
  private $id;
  private $heure_debut;
  private $heure_fin;
  private $etat;
  private $region;

  function __construct($id, $heure_debut, $heure_fin, $etat){
    $this->setId($id);
    $this->setHeureDebut($heure_debut);
    $this->setHeureFin($heure_fin);
    $this->setEtat($etat);
  }

  /*
  * SETTEUR
  */
  public function setId($id){
    $this->id = $id;
  }
  public function setHeureDebut($heure_debut){
    $this->heure_debut = $heure_debut;
  }
  public function setHeureFin($heure_fin){
    $this->heure_fin = $heure_fin;
  }
  public function setEtat($etat){
    $this->etat = $etat;
  }
  public function setRegion($region){
    $this->region = $region;
  }

/*
* GETTEUR
*/
  public function getId(){
    return $this->id;
  }
  public function getHeureDebut(){
    return $this->heure_debut;
  }
  public function getHeureFin(){
    return $this->heure_fin;
  }
  public function getEtat(){
    return $this->etat;
  }
  public function getRegion(){
    return $this->region;
  }
}
 ?>
