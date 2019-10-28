<?php
  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php";

  $gestion = new GestionReservation();
  $reservations = $gestion->getAllReservationData();

  echo json_encode($reservations);
?>
