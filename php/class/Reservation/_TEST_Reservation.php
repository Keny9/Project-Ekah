<?php
include_once 'Reservation.php';

$id = 1;
$id_paiement = 1;
$id_emplacement = 1;
$id_suivi = 1;
$id_activite = 1;
$id_groupe = 2;
$date_rendez_vous = "testdate";
$heure_debut = "testheuredebut";
$heure_fin = "testheurefin";

$reservation = new Reservation($id, $id_paiement, $id_emplacement, $id_suivi,
                               $id_activite, $id_groupe, $date_rendez_vous,
                               $heure_debut, $heure_fin);

$reservation->print();

 ?>
