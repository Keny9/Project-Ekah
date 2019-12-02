<?php
/**
* Script qui cancel une réservation
*
* Nom :         cancelReservation
* Catégorie :   ScriptPhp
* Auteur :      Karl Boutin
* Version :     1.0
* Date de la dernière modification : 2019-11-14
*/
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Facilitateur/gestionFacilitateur.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Horaire/gestionHoraire.php";


  $gReservation = new GestionReservation();
  $gHoraire = new GestionHoraire();
  $gFacilitateur = new gestionFacilitateur();


  // $id = 16;

  if(isset($_POST['id_reservation'])){
    $id = $_POST['id_reservation'];

    $gReservation->cancelReservation($_POST['id_reservation']);

    $reservation = $gReservation->getReservation($id);
    // print_r($reservation);

    $heure_debut = $reservation->getDateRendezVous();

    $facilitateur = $gFacilitateur->getFacilitateur($reservation->getIdFacilitateur());
    // print_r($facilitateur);

    $dispo = $facilitateur->getDisponibilite();
    for ($i=0; $i < sizeof($dispo); $i++) {
      // echo $dispo[$i]->getHeureDebut() . " = " . $heure_debut;
      // echo "<br />";

      if($dispo[$i]->getHeureDebut() == $heure_debut){
        echo "Etat dispo";
        $gHoraire->libererDispo($dispo[$i]->getId());
      }
    }


    echo json_encode(true);
  }

  echo json_encode(false);

?>
