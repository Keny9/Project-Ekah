<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/QuestionnaireReservation/questionnaire.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Question/gestionQuestion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/ta_activite_questionnaire_reservation.php";

$gq = new GestionQuestion();
$questionnaire = new Questionnaire( $_POST['id'],
                        $_POST['nomQuestionnaire']
                        );

$ta_activite_questionnaire = new Ta_activite_questionnaire_reservation( $_POST['id'],
                        $_POST['id']
                        );
$gq->ajouterQuestionnaire($questionnaire);
//$gq->ajouterActiviteQuestionnaire($ta_activite_questionnaire)
 ?>
