<?php
include "Compte.php";
include "Utilisateur.php";

$compte = new Compte("max@test.te", "123qwe");

echo "Courriel : ".$compte->getCourriel()."<br>
      Mot de passe : ".$compte->getMotDePasse()."<br><br>";

$user = new Utilisateur();
$user->init(1, 2, "Test", "Max", "2019-01-01");

echo "Id : ".$user->getId()."<br>
      Id type utilisateur : ".$user->getIdTypeUtilisateur()."<br>
      Nom : ".$user->getNom()."<br>
      Prenom : ".$user->getPrenom()."<br>
      Date inscription : ".$user->getDateInscription()."<br><br>";

 ?>
