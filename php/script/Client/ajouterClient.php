<?php
/**
 * Fait appel à la méthode ajouterClient de la classe GestionClientAjout.
 * // TODO: retourne...
 *
 *
 * Nom :         ajouterClient
 * Catégorie :   scriptPhp
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-04
 */
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Client/GestionClientAjout.php";

$gestion = new GestionClientAjout();
$client;
$pays = $_POST['pays'];
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$jourNaissance = $_POST['jour'];
$moisNaissance = $_POST['mois'];
$anneeNaissance = $_POST['annee'];
$codePostal = $_POST['codePostal'];
$numeroAdresse = $_POST['noAdresse'];
$rue = $_POST['rue'];
$ville = $_POST['ville'];
$telephone = $_POST['telephone'];
$courriel = $_POST['courriel'];
// TODO: Hash le mot de passe ici?
$motDePasse = $_POST['motDePasse'];


if($gestion->courrielExisteDeja($courriel)){
  echo "true";
}
else{
  echo "false";
}
?>
