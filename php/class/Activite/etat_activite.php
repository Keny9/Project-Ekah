<?php
/**
 * Classe Type_activite.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 *
 * Nom :         etat_activite.php
 * Catégorie :   Classe
 * Auteur :      William Gonin
 * Version :     1.1
 * Date de la dernière modification : 2019-11-21
 */
class Etat_activite{
  private $id;
  private $nom;

  function __construct($id, $nom){
    $this->setId($id);
    $this->setNom($nom);
  }
  public function getId(){
    return $this->id
    ;}
  public function setId($id){
    $this->id = $id
    ;}
    public function getNom(){
      return $this->nom
      ;}
  public function setNom($nom){
    $this->nom = $nom
    ;}
} ?>
