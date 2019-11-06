<?php
/**
 * Redirect la page de réservation selon le service choisit
 *
 * Nom :         redirectQuestionnaire
 * Catégorie :   scriptPhp
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-14
 */

 include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Reservation/GestionAffichageReservation.php';
 include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php';
 include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Horaire/GestionHoraire.php';
 include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/class/QuestionnaireReservation/Questionnaire.php';
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Reservation/Reservation.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Groupe/Groupe.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Client/Client.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Emplacement/Emplacement.php";

 if (session_status() === PHP_SESSION_NONE){session_start();}

 $gReservation = new GestionReservation();
 $gAffichageReservation = new GestionAffichageReservation();

 $questionnaireArray = null;
 $questionnaire = null;


 //Créer la réservation
 $groupe = new Groupe(null, 1, null, null, 1);
 $id_activite = $_POST['service'];
 $dateTime = "2018-01-01";//$_GET['date_rendez_vous'];
 $id_facilitateur = 1;//$_GET['facilitateur_id'];
 // TODO: Pourrait créer le suivi ici et pass son id...
 $reservation = new Reservation(null, null, 1, null, $id_activite, null, $dateTime, 1, 1, $id_facilitateur);
 // Insert la reservation et get l'id de son suivi
 $suivi_id = $gReservation->insertReservationIndividuelle($groupe, $reservation, $_SESSION['logged_in_user_id']);


//Réserver la disponibilité
  $id_dispo = $_GET['date_rendez_vous'];
  reserverDispo($id_dispo);


 // L'activité ne contient pas de questionnaire
 if(($questionnaireArray = $gReservation->questionnaireSelectAllWithActiviteId($id_activite)) == null){
   echo "Il n'y a pas de questionnaire pour cette activité\n";
   echo "Réservation complétée";
   // TODO: redirect vers page appropriée
   exit();
 }

// L'activité contient un questionnaire
$questionnaire = $questionnaireArray[0];
$_SESSION['questionnaire'] = $questionnaire;

header('Location: /Project-Ekah/affichage/client/questionnaire.php?res_id='.$suivi_id);
 ?>
