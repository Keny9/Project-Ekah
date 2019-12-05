<?php
  include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php';

  $id = $_POST['id'];
  // $id = 13;

  $gestionReservation = new GestionReservation();

  $reservation = $gestionReservation->getAtelier($id);

  // print_r($reservation);

  $emplacement = $gestionReservation->getEmplacementAtelier($reservation->getId());
  // print_r($emplacement);

  $activite = $gestionReservation->getActiviteReservation($reservation->getId());
  // print_r($activite);

  $out = null;

  $start = $reservation->getDateRendezVous();

  //Transformer l'heure en 00h00
  $start = explode(" ", $start);
  $start = explode(":", $start[1]);
  $start = $start[0] . "h" . $start[1];
  // $start = print_r($start);

  //Avoir la durée
  $datetime1 = strtotime($reservation->getDateRendezVous());
  $datetime2 = strtotime($reservation->getHeureFin());
  $mins = ($datetime2 - $datetime1) / 60;
  // echo $mins;

  $date = date("d-m-Y", strtotime($reservation->getDateRendezVous()));
  // echo $date;


  $out = array(
    'id' => $reservation->getId(),
    'title' => $activite->getNom(),
    'description' => $activite->getDescriptionC(),
    'emplacement' => $emplacement->getNomLieu(),
    'date' => $date,
    'heure' => $start,
    'duree' =>$mins,
    'prix'=>$activite->getCout()
  );


  echo json_encode($out);
  exit;



?>
