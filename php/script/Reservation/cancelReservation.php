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
  $gFacilitateur = new GestionFacilitateur();

   if(isset($_POST['id_reservation'])){
    $id = $_POST['id_reservation'];

    $gReservation->cancelReservation($_POST['id_reservation']);

    $reservation = $gReservation->getReservation($id);

    $heure_debut = $reservation->getDateRendezVous();
    $heure_fin = $reservation->getHeureFin();

    $heure_fin_time = strtotime($heure_fin);
    $heure_debut_time = strtotime($heure_debut);

    $duree = ($heure_fin_time - $heure_debut_time)/60;    //Calcul la durée

    $facilitateur = $gFacilitateur->getFacilitateur($reservation->getIdFacilitateur());

    $dispo = $facilitateur->getDisponibilite();

    //Vérifie toutes les dispos du facilitateur pour trouver celui qui concorde avec la dispo de la réservation
    for ($i=0; $i < sizeof($dispo); $i++) {

      if(date("Y-m-d H:i:s", strtotime($heure_debut . "-30 minutes")) == $dispo[$i]->getHeureDebut()){  //Cancel dispo avant
        $gHoraire->libererDispo($dispo[$i]->getId());
        // echo "Ok avant " . $dispo[$i]->getId();
        // echo "<br />";
      }

      if(date("Y-m-d H:i:s", strtotime($heure_fin . "+0 minutes")) == $dispo[$i]->getHeureDebut()){     //Cancel dispo après
        $gHoraire->libererDispo($dispo[$i]->getId());
        // echo "Ok apres " . $dispo[$i]->getId();
        // echo "<br />";
      }

      if($dispo[$i]->getHeureDebut() == $heure_debut){                                                  //cancel la dispo
        $gHoraire->libererDispo($dispo[$i]->getId());
        // echo "Ok pendant " . $dispo[$i]->getId();
        // echo "<br />";
      }

      if($duree == 60){
        if($dispo[$i]->getHeureDebut() == date("Y-m-d H:i:s", strtotime($heure_debut . "+30 minutes"))){
          $gHoraire->libererDispo($dispo[$i]->getId());
        }
      }else if($duree == 90){
        if($dispo[$i]->getHeureDebut() == date("Y-m-d H:i:s", strtotime($heure_debut . "+30 minutes"))){
          $gHoraire->libererDispo($dispo[$i]->getId());
        }
        if($dispo[$i]->getHeureDebut() == date("Y-m-d H:i:s", strtotime($heure_debut . "+60 minutes"))){
          $gHoraire->libererDispo($dispo[$i]->getId());
        }
      }

    }
    echo json_encode(true);
  }
  else{
    echo json_encode(false);
  }
?>
