<?php
include_once 'GestionReservation.php';


$gestionReservation = new GestionReservation();

$reservation = $gestionReservation->selectReservation(1);
if(isset($reservation)){
  $reservation->print();
}
else{
  echo "\$reservaton is not set";
}

 ?>
