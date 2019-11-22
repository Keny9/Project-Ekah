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
 include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Horaire/gestionHoraire.php';
 include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Facilitateur/gestionFacilitateur.php';
 include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/class/QuestionnaireReservation/questionnaire.php';
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Reservation/Reservation.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Groupe/Groupe.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Client/Client.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Emplacement/Emplacement.php";

 if (session_status() === PHP_SESSION_NONE){session_start();}

$paiement_effectue = false;

if($paiement_effectue == true){
  $gReservation = new GestionReservation();
  $gAffichageReservation = new GestionAffichageReservation();
  $gHoraire = new GestionHoraire();
  $gFacilitaeur = new GestionFacilitateur();

  $questionnaireArray = null;
  $questionnaire = null;

  //Créer la réservation
  $groupe = new Groupe(null, 1, null, null, 1);
  $id_activite = $_POST['service'];
  $dateTime = $_GET['date_rendez_vous'];//$_GET['date_rendez_vous'];
  $id_facilitateur = $_GET['facilitateur_id'];//$_GET['facilitateur_id'];
  $id_dispo = $_GET['id_dispo'];
  $no_adresse = $_POST['noAdresse'];
  $rue = $_POST['rue'];
  $ville = $_POST['ville'];
  $duree = $_GET['duree'];

  if($id_facilitateur == -1){ // veut dire pas de facilitateur choisit?? indiquer svp
    $facilitateur = $gFacilitaeur->getDispo($id_dispo);
    $id_facilitateur = $facilitateur->getId(); /*********Ne fonctionne pas si la requete getDispo($id_dispo) retourne rien***************/
  }

 // Set l'id de l'emplacement
  $id_emplacement = null;
  if(isset($no_adresse) && isset($rue) && isset($ville)){ // Champs remplis, donc service 'À domicile'; requiert un emplacement
    $id_emplacement = $gReservation->insertEmplacement($no_adresse, $rue, $ville);
  }

 // Set l'id de la région
 $id_region = null;
 if(isset($_POST['region'])){
   $id_region = $_GET['id_region'];
 }

 //Calculer l'heure_fin de la réservation
 $dispo = $gHoraire->getDispo($id_dispo);
 $heure_fin = date("Y-m-d H:i:s", strtotime($dispo->getHeureDebut() . "+".$duree." minutes"));


  // Créer la réservation
  $reservation = new Reservation(null, null, $id_emplacement, null, $id_activite, null, $dateTime, $id_region, $heure_fin, $id_facilitateur);
  // Insert la reservation et get l'id de son suivi
  $suivi_id = $gReservation->insertReservationIndividuelle($groupe, $reservation, $_SESSION['logged_in_user_id']);

 //Réserver la disponibilité
   $gHoraire->reserverDispo($id_dispo);

 // L'activité ne contient pas de questionnaire
 if(($questionnaireArray = $gReservation->questionnaireSelectAllWithActiviteId($id_activite)) == null){
   echo "Il n'y a pas de questionnaire pour cette activité\n";
   echo "Réservation complétée";
 }

 // L'activité contient un questionnaire
 $questionnaire = $questionnaireArray[0];
 $_SESSION['questionnaire'] = $questionnaire;

 header('Location: /Project-Ekah/affichage/client/questionnaire.php?res_id='.$suivi_id);
}
 ?>
