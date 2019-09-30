<?php
include_once "Individu.php";


//Test Individu
$individu = new Individu(1, "Indivi", "Dudu", "2019-01-01");

echo "Individu<br>";
$individu->print();
echo "<br>";

//Test Utilisateur
$user = new Utilisateur(1, "Test", "Max", "2019-01-01", "max@test.ca", "1996-09-01", 1231231234);

echo "Utilisateur<br>";
$user->print();
"<br>";


//Test Client
/*$client = new Client(2, "Test", "Client", "2019-01-03");

echo "
Id : ".$client->getId()."<br>
Nom : ".$client->getNom()."<br>
Prenom : ".$client->getPrenom()."<br>
Date inscription : ".$client->getDateInscription()."<br><br>";*/

 ?>
