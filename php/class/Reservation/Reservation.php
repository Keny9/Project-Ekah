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
 * Version :     1.0
 * Date de la dernière modification : 2019-10-08
 */

class Reservation{
  private $id;
  private $id_paiement;
  private $id_emplacement;
  private $id_suivi;
  private $id_activite;
  private $id_groupe;
  private $date_rendez_vous;
  private $heure_debut;
  private $heure_fin;

  function __construct($id, $id_paiement, $id_emplacement, $id_suivi,
                       $id_activite, $id_groupe, $date_rendez_vous, $heure_debut, $heure_fin){
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
  private function setId($id){
    $this->id = $id;
  }
  private function setIdPaiement($val){
    $this->id_paiement = $val;
  }
  private function setIdEmplacement($val){
    $this->id_emplacement = $val;
  }
  private function setIdSuivi($val){
    $this->id_suivi = $val;
  }
  private function setIdActivite($val){
    $this->id_activite = $val;
  }
  private function setDateRendezVous($val){
    $this->date_rendez_vous = $val;
  }
  private function setHeureDebut($val){
    $this->heure_debut = $val;
  }
  private function setHeureFin($val){
    $this->heure_fin = $val;
  }
  private function setIdGroupe($val){
    $this->id_groupe = $val;
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
}

 ?>