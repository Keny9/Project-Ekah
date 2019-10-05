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
 * Version :     1.1
 * Date de la dernière modification : 2019-10-03
 */

 $path = $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Utilisateur.php";
 include_once $path;

 class Client extends Utilisateur{
   private $rue;
   private $codePostal;
   private $noCivique;
   private $ville;
   private $province;
   private $idProvince;
   private $pays;

   function __construct($id, $nom, $prenom, $dateInscription,
                        $courriel, $dateNaissance, $telephone,
                        $rue, $codePostal, $noCivique, $ville,
                        $province, $idProvince, $pays){
     parent::__construct($id, $nom, $prenom, $dateInscription,
                        $courriel, $dateNaissance, $telephone);
    $this->setRue($rue);
    $this->setCodePostal($codePostal);
    $this->setNoCivique($noCivique);
    $this->setVille($ville);
    $this->setProvince($province);
    $this->setIdProvince($idProvince);
    $this->setPays($pays);
  }

   public function print(){
     parent::print();

     echo "Rue : ".$this->getRue()."<br>
     Code Postal : ".$this->getCodePostal()."<br>
     Numéro civique : ".$this->getNoCivique()."<br>
     Ville : ".$this->getVille()."<br>
     Province : ".$this->getProvince()."<br>
     Id Province : ".$this->getIdProvince()."<br>
     Pays : ".$this->getPays()."<br>";
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
   private function setVille($val){
     $this->ville = $val;
   }
   private function setProvince($val){
     $this->province = $val;
   }
   private function setIdProvince($val){
     $this->idProvince = $val;
   }
   private function setPays($val){
     $this->pays = $val;
   }

   public function getRue(){
     return $this->rue;
   }
   public function getNoCivique(){
     return $this->noCivique;
   }
   public function getCodePostal(){
     return $this->codePostal;
   }
   public function getVille(){
     return $this->ville;
   }
   public function getProvince(){
     return $this->province;
   }
   public function getIdProvince(){
     return $this->idProvince;
   }
   public function getPays(){
     return $this->pays;
   }
 }

 ?>
