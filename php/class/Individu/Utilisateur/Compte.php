<?php
/**
 * Classe Compte.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 * de la table compte_utilisateur
 *
 * Nom :         Compte
 * Catégorie :   Classe
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-09-27
 */

 class Compte{
   private $courriel;
   private $motDePasse;

   function __construct($courriel, $motDePasse){
     $this->setCourriel($courriel);
     $this->setMotDePasse($motDePasse);
   }

   private function setCourriel($courriel){
     $this->courriel = $courriel;
   }
   private function setMotDePasse($motDePasse){
     $this->motDePasse = $motDePasse;
   }

   public function getCourriel(){
     return $this->courriel;
   }
   public function getMotDePasse(){
     return $this->motDePasse;
   }
 }
 ?>
