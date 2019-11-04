<?php
/**
 * Retourne un array contenant les infos du client
 *
 * Nom :         getMonProfil.php
 * Catégorie :   script
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-11-03
 */

 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Client/GestionClient.php";

 $gestionClient = new GestionClient();
 $client = $gestionClient->getClient($_SESSION['logged_in_user_id']);

 $client_json = json_encode($client);

?>
