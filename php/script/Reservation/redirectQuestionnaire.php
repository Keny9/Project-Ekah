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
 include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/class/QuestionnaireReservation/Questionnaire.php';

 $gReservation = new GestionReservation();
 $gAffichageReservation = new GestionAffichageReservation();

 $id_activite = $_POST['service'];
 $questionnaireArray = null;
 $questionnaire = null;

// Vérifie si l'activité contient un questionnaire
 if(($questionnaireArray = $gReservation->questionnaireSelectAllWithActiviteId($id_activite)) == null){
   echo "Il n'y a pas de questionnaire pour cette activité\n";
   echo "Réservation complétée";
   // TODO: redirect vers page appropriée
   exit();
 }

//Si elle en contient un, ...
session_start();

$questionnaire = $questionnaireArray[0];
$_SESSION['questionnaire'] = $questionnaire;

header('Location: /Project-Ekah/affichage/client/questionnaire.php');
 ?>
