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

/*
  TEST insert reservation individuelle
*/
$client = new Client(2, "Test", "Client", "2019-01-03",
 "client@test.ca", "1996-09-01", 2341237869,
"Boukina", "j1n-2u5", "123", "Sherbrooke", "Québec", "1", "Canada");
$emplacement = new Emplacement(null, 1, "4000 rue MickeyBOOM");

$gestionReservation->insertReservationIndividuelle($reservation, $client, $emplacement);

 ?>
