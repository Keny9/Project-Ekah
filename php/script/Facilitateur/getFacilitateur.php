<?php
/**
 * Appeler une methode qui nous permet de recuperer tous les facilitateurs de la base de donnee,
 * ainsi que leurs informations
 *
 *
 * Nom :         getDataFacilitateur.php
 * Catégorie :   script
 * Auteur :      Maxime Lussier
 * Version :     1.1
 * Date de la dernière modification : 2019-11-18
 */

 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Facilitateur/gestionFacilitateur.php";

 $gestionFacilitateur = new GestionFacilitateur();
 $facilitateur = $gestionFacilitateur->getAllFacilitateur();

 echo json_encode($facilitateur);

?>
