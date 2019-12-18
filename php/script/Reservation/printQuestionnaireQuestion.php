<?php
/**
 * Echo dans des balises html toutes les questions du questionnaire dont
 * l'id est passé en POST.
 *
 * Nom :         printQuestionnaireQuestion
 * Catégorie :   scriptPhp
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-13
 */

 include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Reservation/GestionAffichageReservation.php';
 include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php';
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/Question.php";

 $questionnaire_id = 3;//$_POST['questionnaire_id'];

 $gReservation = new GestionReservation();
 $gAffichage = new GestionAffichageReservation();

 $arrayQuestion = $gReservation->questionSelectAllWithQuestionnaireId($questionnaire_id);
 $stringQuestions = $gAffichage->printQuestionArray($arrayQuestion);

 echo $stringQuestions;


 ?>
