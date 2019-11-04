<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/QuestionnaireReservation/questionnaire.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Question/gestionQuestion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/ta_activite_questionnaire_reservation.php";

$gq = new GestionQuestion();
$ta_activite_questionnaire_reservation = new Ta_activite_questionnaire_reservation( $_POST['id'],
                        $_POST['id']
                      );
$gq->ajouterActiviteQuestionnaire($ta_activite_questionnaire_reservation);
 ?>
