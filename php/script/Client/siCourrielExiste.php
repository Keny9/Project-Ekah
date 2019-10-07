<?php
/**
 * Fait appel à la méthode courrielExisteDeja de la classe GestionClientAjout.
 * Retourne vrai si $_POST['courriel'] existe dans la BD,
 * retourne faux sinon.
 *
 * Nom :         siCourrielExiste
 * Catégorie :   scriptPhp
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-03
 */
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Client/GestionClientAjout.php";

$gestion = new GestionClientAjout();
$courriel = $_POST['courriel'];

if($gestion->courrielExisteDeja($courriel)){
  echo "true";
}
else{
  echo "false";
}
?>
