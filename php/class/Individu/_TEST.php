<?php
include_once "Individu.php";
include_once "Utilisateur/Utilisateur.php";
include_once "Utilisateur/Client/Client.php";
include_once "Utilisateur/Facilitateur/Facilitateur.php";

//Test Individu
$individu = new Individu(1, "Indivi", "Dudu", "2019-01-01");

echo "Individu<br>";
$individu->print();
echo "<br>";

//Test Utilisateur
$user = new Utilisateur(1, "Test", "Max", "2019-01-01",
 "Utilisateur@test.ca", "1996-09-01", 1231231234);

echo "Utilisateur<br>";
$user->print();
echo "<br>";


//Test Client
$client = new Client(2, "Test", "Client", "2019-01-03",
 "client@test.ca", "1996-09-01", 2341237869,
"Boukina", "j1n-2u5", "123", "Sherbrooke", "Québec", "1", "Canada");

echo "Client<br>";
$client->print();
echo "<br>";

 ?>
