<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/QuestionnaireReservation/questionnaire.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/question.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/ta_questionnaire_reservation_question.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Question/gestionQuestion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/ta_activite_questionnaire_reservation.php";

$gq = new GestionQuestion();
$ta_questionnaire_reservation_question = new Ta_questionnaire_reservation_question( $_POST['id'],
                        $_POST['idQues'],$_POST['ordre']);
$gq->ajouterQuestionQuestionnaire($ta_questionnaire_reservation_question);
 ?>
