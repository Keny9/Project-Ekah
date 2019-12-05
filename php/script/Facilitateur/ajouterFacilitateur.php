<?php
/**
 * Script qui appelle la méthode ajoutFacilitateur. Permet de Créer
 * un nouveau facilitateur dans la base de donnée
 *
 * Nom :         ajouterFacilitateur.php
 * Catégorie :   scriptPhp
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-11-18
 */
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Facilitateur/GestionFacilitateur.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";

$gestionFacilitateur = new GestionFacilitateur();

/*
  Les $_POST çi-dessous DOIVENT être set.
  Sinon, die();
*/

if (isset($_POST['prenom'])) {$prenom = $_POST['prenom'];}
else {die($preMessageErreur."Le prenom est vide");}

if (isset($_POST['nom'])) {$nom = $_POST['nom'];}
else {die($preMessageErreur."Le nom est vide");}

if (isset($_POST['courriel'])) {$courriel = $_POST['courriel'];}
else {die($preMessageErreur."Le courriel est vide");}

if (isset($_POST['motDePasse'])) {$motDePasse = $_POST['motDePasse'];}
else {die($preMessageErreur."Le mot de passe est vide");}

if (isset($_POST['telephone'])) {$telephone = $_POST['telephone'];}
else {die($preMessageErreur."Le telephone est vide");}

$facilitateur = new Facilitateur(NULL, $nom, $prenom, NULL, $courriel,
NULL, $telephone, NULL, NULL, NULL,
NULL, NULL, NULL, NULL);

$gestionFacilitateur->addFacilitateur($facilitateur, $motDePasse);
header('Location: /Project-Ekah/affichage/admin/gestion-facilitateur.php');
?>
