<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/Question.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/Type_question.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/Ta_questionnaire_reservation_question.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/QuestionnaireReservation/Questionnaire.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Question/GestionQuestion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/GestionAffichageGestionReservation.php";

//$gd = new GestionDuree();
//print_r(json_encode($gd->getActivite($_POST['id'])->getId_type()));

$gagr = new GestionAffichageGestionReservation();
print_r(json_encode($gagr->getQuestionActivite($_POST['id'])));
 ?>
