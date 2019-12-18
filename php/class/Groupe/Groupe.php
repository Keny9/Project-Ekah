<?php
/**
 * Classe Groupe.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 * d'un groupe
 *
 * Nom :         Groupe
 * Catégorie :   Classe
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-10
 */

class Groupe{
  private $no_groupe;
  private $id_type_groupe;
  private $nom_entreprise; // NULL
  private $nom_organisateur; // NULL
  private $nb_participant; // NULL

  function __construct($no_groupe, $id_type_groupe, $nom_entreprise,
                       $nom_organisateur, $nb_participant){
     $this->setNoGroupe($no_groupe);
     $this->setIdTypeGroupe($id_type_groupe);
     $this->setNomEntreprise($nom_entreprise);
     $this->setNomOrganisateur($nom_organisateur);
     $this->setNbParticipant($nb_participant);
  }

  /*
  * Méthode print
  * echo le contenu des variables de la classe
  */
  public function print(){
    echo "
    No_groupe : ".$this->getNoGroupe()."<br>
    id_type_groupe : ".$this->getIdTypeGroupe()."<br>
    nom_entreprise : ".$this->getNomEntreprise()."<br>
    nom_organisateur : ".$this->getNomOrganisateur()."<br>
    nb_participant : ".$this->getNbParticipant()."<br>";
  }

  /*
  * SETTEUR
  */
  private function setNoGroupe($val){
    $this->no_groupe = $val;
  }
  private function setIdTypeGroupe($val){
    $this->id_type_groupe = $val;
  }
  private function setNomEntreprise($val){
    $this->nom_entreprise = $val;
  }
  private function setNomOrganisateur($val){
    $this->nom_organisateur = $val;
  }
  private function setNbParticipant($val){
    $this->nb_participant = $val;
  }

  /*
  * GETTEUR
  */
  public function getNoGroupe(){
    return $this->no_groupe;
  }
  public function getIdTypeGroupe(){
    return $this->id_type_groupe;
  }
  public function getNomEntreprise(){
    return $this->nom_entreprise;
  }
  public function getNomOrganisateur(){
    return $this->nom_organisateur;
  }
  public function getNbParticipant(){
    return $this->nb_participant;
  }
}

 ?>
