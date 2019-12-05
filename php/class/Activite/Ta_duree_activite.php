<?php
/**
 * Classe Ta_duree_activite.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 *
 * Nom :         Ta_duree_activite.php
 * Catégorie :   Classe
 * Auteur :      William Gonin
 * Version :     1.1
 * Date de la dernière modification : 2019-10-03
 */
class Ta_duree_activite{
  private $idDuree;
  private $idActivite;

  function __construct($idDuree, $idActivite){
    $this->setIdDuree($idDuree);
    $this->setIdActivite($idActivite);
  }
  public function getIdDuree(){
    return $this->idDuree
    ;}
  public function setIdDuree($idDuree){
    $this->idDuree = $idDuree
    ;}
    public function getIdActivite(){
      return $this->idActivite
      ;}
  public function setIdActivite($idActivite){
    $this->idActivite = $idActivite
    ;}
} ?>
