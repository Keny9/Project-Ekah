<?php
/**
 * Classe Video.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 * de la table Video
 *
 * Nom :         Video
 * Catégorie :   Classe
 * Auteur :      Guillaume Côté
 * Version :     1.1
 * Date de la dernière modification : 2019-12-17
 */

class Video{
  private $id;
  private $nom;
  private $fichier;
  private $poster;
  private $prix;


  function __construct($id, $nom, $fichier, $poster, $prix){
    $this->setId($id);
    $this->setNom($nom);
    $this->setFichier($fichier);
    $this->setPoster($poster);
    $this->setPrix($prix);
  }

  /*
  * Méthode print
  * echo le contenu des variables de la classe
  */
  // public function print(){
  //   echo "
  //   Id :               ".$this->getId()."<br>
  //   id_paiement :      ".$this->getIdPaiement()."<br>
  //   id_emplacement :   ".$this->getIdEmplacement()."<br>
  //   id_suivi :         ".$this->getIdSuivi()."<br>
  //   id_activite :      ".$this->getIdActivite()."<br>
  //   id_groupe :        ".$this->getIdGroupe()."<br>
  //   date_rendez_vous : ".$this->getDateRendezVous()."<br>
  //   heure_debut :      ".$this->getHeureDebut()."<br>
  //   heure_fin :        ".$this->getHeureFin()."<br>";
  // }

  /*
  * SETTEUR
  */
  public function setId($id){
    $this->id = $id;
  }
  public function setNom($val){
    $this->nom = $val;
  }
  public function setFichier($val){
    $this->fichier = $val;
  }
  public function setPoster($val){
    $this->poster = $val;
  }
  public function setPrix($val){
    $this->prix = $val;
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
  public function getFichier(){
    return $this->fichier;
  }
  public function getPoster(){
    return $this->poster;
  }
  public function getPrix(){
    return $this->prix;
  }

}

 ?>
