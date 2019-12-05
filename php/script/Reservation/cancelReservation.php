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
  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Facilitateur/GestionFacilitateur.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Horaire/GestionHoraire.php";


  $gReservation = new GestionReservation();
  $gHoraire = new GestionHoraire();
  $gFacilitateur = new gestionFacilitateur();

  // if(isset($_POST['id_reservation'])){
  //   $id = $_POST['id_reservation'];

    $id = 10;

    // $gReservation->cancelReservation($_POST['id_reservation']);

    $reservation = $gReservation->getReservation($id);

    $heure_debut = $reservation->getDateRendezVous();
    $heure_fin = $reservation->getHeureFin();


    $facilitateur = $gFacilitateur->getFacilitateur($reservation->getIdFacilitateur());

    $dispo = $facilitateur->getDisponibilite();

    print_r($reservation);

    //Vérifie toutes les dispos du facilitateur pour trouver celui qui concorde avec la dispo de la réservation
    for ($i=0; $i < sizeof($dispo); $i++) {

      if(date("Y-m-d H:i:s", strtotime($heure_debut . "-30 minutes")) == $dispo[$i]->getHeureDebut()){
        // $gHoraire->libererDispo($dispo[$i]->getId());
        echo "Ok avant";
      }

      echo date("Y-m-d H:i:s", strtotime($heure_fin . "+30 minutes")) ." == ". $dispo[$i]->getHeureDebut();
      echo "<br />";

      if(date("Y-m-d H:i:s", strtotime($heure_fin . "+30 minutes")) == $dispo[$i]->getHeureDebut()){
        // $gHoraire->libererDispo($dispo[$i]->getId());
        echo "Ok apres";
      }

      if($dispo[$i]->getHeureDebut() == $heure_debut){
        // $gHoraire->libererDispo($dispo[$i]->getId());
        echo "Ok pendant";
      }
    }


    echo json_encode(true);
  // }

  echo json_encode(false);

?>
