<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/QuestionnaireReservation/Questionnaire.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Question/GestionQuestion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/Ta_activite_questionnaire_reservation.php";

$gq = new GestionQuestion();
$questionnaire = new Questionnaire( $_POST['id'],
                        $_POST['nomQuestionnaire']
                        );
$gq->ajouterQuestionnaire($questionnaire);
 ?>
