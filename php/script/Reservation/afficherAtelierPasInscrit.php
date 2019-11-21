<?php
/**
 * Fait appel à la méthode getDisponibiliteFacilitateur
 *
 * Nom :         AfficherAllAteliers.php
 * Catégorie :   scriptPhp
 * Auteur :      Guillaume Côté
 * Version :     1.0
 * Date de la dernière modification : 2019-11-14
 */

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Reservation/Reservation.php";


$gestionReservation = new GestionReservation();

$reservation = $gestionReservation->getAllAteliers();

$gestionReservation->

$out = null;

for ($i=0; $i < sizeof($reservation); $i++) {

  $out[] = array(
    'id' => $reservation[$i]->getId(),
  );
}

  echo json_encode(array('success' => 1, 'result' => $out));

?>
