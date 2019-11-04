<?php
/**
 * Appeler une methode qui nous permet de recuperer tous les clients de la base de donnee,
 * ainsi que leurs informations
 *
 *
 * Nom :         getDataClient.php
 * Catégorie :   script
 * Auteur :      Karl Boutin
 * Version :     1.1
 * Date de la dernière modification : 2019-10-28
 */

 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Client/GestionClient.php";

 $gestionClient = new GestionClient();
 $clients = $gestionClient->getAllClient();

 echo json_encode($clients);

?>
