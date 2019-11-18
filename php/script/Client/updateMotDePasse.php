<?php
/**
* Script qui update le mot de passe d'un utilisateur
*
*
* Nom :         updateMotDePasse.php
* Catégorie :   script
* Auteur :      Maxime Lussier
* Version :     1.0
* Date de la dernière modification : 2019-11-15
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Client/GestionClient.php";

$g = new GestionClient();
$dataJson = $_GET['data'];
$data = json_decode($dataJson, true);

$g->updateMotDePasse($data['id'], $data['password']);

?>
