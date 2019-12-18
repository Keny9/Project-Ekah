<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Duree/Duree.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Duree/GestionDuree.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/GestionAffichageGestionReservation.php";

$gagr = new GestionAffichageGestionReservation();
print_r(json_encode($gagr->getDureeActivite($_POST['id'])));
 ?>
