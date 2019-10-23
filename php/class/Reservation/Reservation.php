<?php
/**
 * Classe Reservation.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 * de la table Reservation
 *
 * Nom :         Reservation
 * Catégorie :   Classe
 * Auteur :      Maxime Lussier
 * Version :     1.1
 * Date de la dernière modification : 2019-10-12
 */

class Reservation{
  private $id;
  private $id_paiement;
  private $id_emplacement;
  private $id_suivi;
  private $id_activite;
  private $id_groupe;
  private $id_facilitateur;
  private $date_rendez_vous;
  private $heure_debut;
  private $heure_fin;

  function __construct($id, $id_paiement, $id_emplacement, $id_suivi,
                       $id_activite, $id_groupe, $date_rendez_vous, $heure_debut, $heure_fin, $id_facilitateur = null){
    $this->setId($id);
    $this->setIdPaiement($id_paiement);
    $this->setIdEmplacement($id_emplacement);
    $this->setIdSuivi($id_suivi);
    $this->setIdActivite($id_activite);
    $this->setIdGroupe($id_groupe);
    $this->setDateRendezVous($date_rendez_vous);
    $this->setHeureDebut($heure_debut);
    $this->setHeureFin($heure_fin);
  }

  /*
  * Méthode print
  * echo le contenu des variables de la classe
  */
  public function print(){
    echo "
    Id :               ".$this->getId()."<br>
    id_paiement :      ".$this->getIdPaiement()."<br>
    id_emplacement :   ".$this->getIdEmplacement()."<br>
    id_suivi :         ".$this->getIdSuivi()."<br>
    id_activite :      ".$this->getIdActivite()."<br>
    id_groupe :        ".$this->getIdGroupe()."<br>
    date_rendez_vous : ".$this->getDateRendezVous()."<br>
    heure_debut :      ".$this->getHeureDebut()."<br>
    heure_fin :        ".$this->getHeureFin()."<br>";
  }

  /*
  * SETTEUR
  */
  public function setId($id){
    $this->id = $id;
  }
  public function setIdPaiement($val){
    $this->id_paiement = $val;
  }
  public function setIdEmplacement($val){
    $this->id_emplacement = $val;
  }
  public function setIdSuivi($val){
    $this->id_suivi = $val;
  }
  public function setIdActivite($val){
    $this->id_activite = $val;
  }
  public function setDateRendezVous($val){
    $this->date_rendez_vous = $val;
  }
  public function setHeureDebut($val){
    $this->heure_debut = $val;
  }
  public function setHeureFin($val){
    $this->heure_fin = $val;
  }
  public function setIdGroupe($val){
    $this->id_groupe = $val;
  }
  public function setIdFacilitateur($val){
    $this->id_facilitateur = $val;
  }

  /*
  * GETTEUR
  */
  public function getId(){
    return $this->id;
  }
  public function getIdPaiement(){
    return $this->id_paiement;
  }
  public function getIdEmplacement(){
    return $this->id_emplacement;
  }
  public function getIdSuivi(){
    return $this->id_suivi;
  }
  public function getIdActivite(){
    return $this->id_activite;
  }
  public function getDateRendezVous(){
    return $this->date_rendez_vous;
  }
  public function getHeureDebut(){
    return $this->heure_debut;
  }
  public function getHeureFin(){
    return $this->heure_fin;
  }
  public function getIdGroupe(){
    return $this->id_groupe;
  }
  public function getIdFacilitateur(){
    return $this->id_facilitateur;
  }
}

 ?>
