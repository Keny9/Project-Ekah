<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Client/GestionClientAjout.php";

$gestionClientAjout = new GestionClientAjout();
$courriel = "test@client.ca";
$fauxCourriel = "kikikoko@mickey.mouse";
echo "TEST courrielExisteDeja()<br>";
echo $courriel." = ";
if($gestionClientAjout->courrielExisteDeja($courriel)){
  echo "true<br>";
}
else{
  echo "false<br>";
}
echo $fauxCourriel." = ";
if($gestionClientAjout->courrielExisteDeja($fauxCourriel)){
  echo "true<br>";
}
else{
  echo "false<br>";
}


$client = new Client(2, "Test", "Client", "2019-01-03",
 "client@test.cem", "1996-09-01", 2341237869,
"Boukina", "j1n-2u5", "123", "Sherbrooke", "Québec", "1", "Canada");
$motDePasse = "kokokiki";
echo "<br>TEST ajouter()<br>";
$gestionClientAjout->ajouterClient($client, $motDePasse);

 ?>
