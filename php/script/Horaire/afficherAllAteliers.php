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
  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Groupe/gestionGroupe.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Inscription/GestionInscription.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Reservation/Reservation.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Groupe/Groupe.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Inscription/Inscription.php";


  if (session_status() === PHP_SESSION_NONE){session_start();}


  $gestionReservation = new GestionReservation();
  $gGroupe = new GestionGroupe();
  $gInscription = new GestionIncription();

  $id_client = $_SESSION['logged_in_user_id'];
  $reservation = $gestionReservation->getAllAteliers($id_client);

  date_default_timezone_set('America/Toronto');

  $out = null;

  for ($i=0; $i < sizeof($reservation); $i++) {       //Pour toutes les réservations
    $start = date("Y-m-d H:i:s", strtotime($reservation[$i]->getDateRendezVous()));
    $end = date("Y-m-d H:i:s", strtotime($reservation[$i]->getHeureFin()));

    $groupe = $gGroupe->getGroupeReservation($reservation[$i]->getId());
    $inscription = $gInscription->getInscriptionGroupe($groupe->getNoGroupe());

    $afficher = true;

    if(isset($inscription)){                                    //Si y'a un inscription
      for ($j=0; $j < sizeof($inscription); $j++) {             //Check si client est deja inscrit
        if($inscription[$j]->getIdUtilisateur() == $id_client){
          $afficher = false;
        }
      }
    }

    if($afficher == true){                            //Si le client n'Est pas deja inscript
      $out[] = array(                                 //Affiche dans le calendrier
        'id' => $reservation[$i]->getId(),
        'title' => $reservation[$i]->getId(),
        'url' => "URL",
        'start' => strtotime($start) . '000',
        'end' => strtotime($end) .'000'
      );
    }
  }


  echo json_encode(array('success' => 1, 'result' => $out));
  exit;

?>
