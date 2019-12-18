<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/QuestionnaireReservation/Questionnaire.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Question/GestionQuestion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/Ta_activite_questionnaire_reservation.php";

$gq = new GestionQuestion();
$ta_activite_questionnaire_reservation = new Ta_activite_questionnaire_reservation( $_POST['id'],
                        $_POST['id']
                      );
$gq->ajouterActiviteQuestionnaire($ta_activite_questionnaire_reservation);
 ?>
