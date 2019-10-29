<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/gestionSuivi.php";

$g = new GestionSuivi;

var_dump($g->getSuiviData(1));
 ?>
