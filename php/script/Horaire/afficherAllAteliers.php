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

  print_r($reservation);


  date_default_timezone_set('America/Toronto');

  $out = null;

  for ($i=0; $i < sizeof($reservation); $i++) {
    $start = date("Y-m-d H:i:s", strtotime($reservation[$i]->getDateRendezVous()));
    $end = date("Y-m-d H:i:s", strtotime($reservation[$i]->getHeureFin()));

    $out[] = array(
      'id' => $reservation[$i]->getId(),
      'title' => $reservation[$i]->getId(),
      'url' => "URL",
      'start' => strtotime($start) . '000',
      'end' => strtotime($end) .'000'
    );
  }


  echo json_encode(array('success' => 1, 'result' => $out));
  exit;

?>
