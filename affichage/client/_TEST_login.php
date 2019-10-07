<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Client/GestionLogin.php";

session_start();

$gestionLogin = new GestionLogin();
$courriel = $_POST['courriel'];
$motDePasse = $_POST['motDePasse'];
$tempArray = $gestionLogin->getUserIdAndUserTypeId($courriel);
$userId = $tempArray[0];
$userTypeId = $tempArray[1];
//TEST
echo "Courriel : ".$courriel."<br>
Mot de passe : ".$motDePasse."<br>
User Id : ".$userId."<br>
type user Id : ".$userTypeId."<br>";

$_SESSION['userId'] = $userId;

echo "\$_SESSION['userId'] : ".$_SESSION['userId']."<br>";

//Vérification du type d'utilisateur
switch ($userTypeId) {
    case '1': // Si c'est un client
        header("Location: /Project-Ekah/affichage/client/_TEMP_accueil_client.php");
        break;
    case '2': // Si c'est un admin
        header("Location: /Project-Ekah/affichage/admin/_TEMP_accueil_admin.php");
        break;
    default: // Sinon (ne devrais pas se produire, mais doit quand même être géré)
        echo "Une erreur est survenue : type d'utilisateur.";
        break;
}
 ?>
