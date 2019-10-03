<?php
/**
 * Classe Client. Enfant de Utilisateur.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 * communs aux clients.
 *
 * Nom :         Client
 * Catégorie :   Classe
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-09-29
 */

 $path = $_SERVER['DOCUMENT_ROOT']."/project_ekah_git/Project-Ekah/php/class/Individu/Utilisateur/Utilisateur.php";
 include_once $path;

 class Client extends Utilisateur{
   private $codePostal;
   private $rue;
   private $noCivique;
   private $ville;
   private $province;
   private $idProvince;
   
   function __construct($id, $nom, $prenom, $dateInscription,
                       $courriel, $dateNaissance, $telephone){
     parent::__construct($id, $nom, $prenom, $dateInscription,
                        $courriel, $dateNaissance, $telephone);
   }

   public function print(){
     parent::print();
   }

   private function setRue($val){
     $this->rue = $val;
   }
   private function setNoCivique($val){
     $this->noCivique = $val;
   }
   private function setCodePostal($val){
     $this->codePostal = $val;
   }
   private function setCodePostal($val){
     $this->codePostal = $val;
   }
   private function setCodePostal($val){
     $this->codePostal = $val;
   }
   private function setCodePostal($val){
     $this->codePostal = $val;
   }
 }

 ?>
