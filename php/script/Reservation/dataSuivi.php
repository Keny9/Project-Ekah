<?php
/**
* Script dataSuivi qui retourne en JSON les données d'un suivi
*
* Nom :         dataSuivi
* Catégorie :   ScriptPhp
* Auteur :      Maxime Lussier
* Version :     1.0
* Date de la dernière modification : 2019-10-29
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/GestionSuivi.php";

$g = new GestionSuivi();
$id_suivi = $_GET['id_suivi'];

echo json_encode($g->getSuiviData($id_suivi));
?>
