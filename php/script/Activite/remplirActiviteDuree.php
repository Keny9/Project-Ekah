<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Duree/duree.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Duree/gestionDuree.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/gestionAffichageGestionReservation.php";

$gagr = new GestionAffichageGestionReservation();
print_r(json_encode($gagr->getDureeActivite($_POST['id'])));
 ?>
