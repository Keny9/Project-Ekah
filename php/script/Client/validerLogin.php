<?php
/**
 * Valide le login de l'utilisateur
 *
 * Nom :         validerLogin
 * Catégorie :   scriptPhp
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-06
 */
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Client/GestionLogin.php";

$gestion = new GestionLogin();
$courriel = $_POST['courriel'];
$motDePasse = $_POST['motDePasse'];

echo $gestion->utilisateurExiste($courriel, $motDePasse);
?>
