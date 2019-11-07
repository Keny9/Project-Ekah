<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/question.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/type_question.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/ta_questionnaire_reservation_question.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/QuestionnaireReservation/questionnaire.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Question/gestionQuestion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/affichage/admin/gestionAffichageGestionReservation.php";

//$gd = new GestionDuree();
//print_r(json_encode($gd->getActivite($_POST['id'])->getId_type()));

$gagr = new GestionAffichageGestionReservation();
print_r(json_encode($gagr->getQuestionActivite($_POST['id'])));
 ?>
