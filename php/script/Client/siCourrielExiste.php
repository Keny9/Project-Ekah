<?php
/**
 * Retourne vrai si $_POST['courriel'] existe dans la BD,
 * retourne faux sinon.
 *
 * Nom :         siCourrielExiste
 * Catégorie :   scriptPhp
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-03
 */

$path = $_SERVER['DOCUMENT_ROOT']."/project_ekah_git/Project-Ekah/php/gestionnaire/Client/GestionClientAjout.php";
include_once $path;

$gestion = new GestionClientAjout();
$courriel = "test@client.ca";//$_POST['courriel'];

if($gestion->courrielExisteDeja($courriel)){
  echo "true";
}
else{
  echo "false";
}
?>
