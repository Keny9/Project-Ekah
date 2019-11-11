<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php";

if(!isset($_GET['id'])){
  $val = $_SESSION['logged_in_user_id'];
}
else{
  $val = $_GET['id'];
}

  $gestion = new GestionReservation();
  $reservations = $gestion->getAllReservationData($val);

  echo json_encode($reservations);
?>
