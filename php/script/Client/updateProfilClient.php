<?php
/**
* Script qui update les infos d'un client dans la BD
*
*
* Nom :         updateProfilClient.php
* Catégorie :   script
* Auteur :      Maxime Lussier
* Version :     1.0
* Date de la dernière modification : 2019-10-30
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Client/GestionClient.php";

$g = new GestionClient();
$dataJson = $_GET['data'];
$data = json_decode($dataJson, true);

$g->updateClient($data);

?>
