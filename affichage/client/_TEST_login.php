<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Client/GestionLogin.php";

session_start();

$gestionLogin = new GestionLogin();
$courriel = $_POST['courriel'];
$motDePasse = $_POST['motDePasse'];

//TEST
echo "Courriel : ".$courriel."<br>
Mot de passe : ".$motDePasse."<br>
User Id : ".$gestionLogin->getUserId($courriel)."<br>";

$_SESSION['userId'] = $gestionLogin->getUserId($courriel);

echo "\$_SESSION['userId'] : ".$_SESSION['userId']."<br>";
 ?>
