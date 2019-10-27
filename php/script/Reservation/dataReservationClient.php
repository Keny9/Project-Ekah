<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php";

  $gestion = new GestionReservation();
  $reservations = $gestion->getAllReservationData($_SESSION['logged_in_user_id']);

  echo json_encode($reservations);
?>
