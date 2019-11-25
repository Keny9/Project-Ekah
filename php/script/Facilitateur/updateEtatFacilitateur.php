<?php
/**
 * Mettre a jour l'etat d'un facilitateur dans la base de donnee
 *
 *
 * Nom :         updateEtatFacilitateur.php
 * Catégorie :   script
 * Auteur :      Karl Boutin
 * Version :     1.1
 * Date de la dernière modification : 2019-11-22
 */

 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Facilitateur/gestionFacilitateur.php";

 $idEtat = $_POST['idEtat'];
 $idFacilitateur = $_POST['idFacilitateur'];

 $gestionFacilitateur = new GestionFacilitateur();
 $gestionFacilitateur->updateEtatFacilitateur($idFacilitateur, $idEtat);


?>
