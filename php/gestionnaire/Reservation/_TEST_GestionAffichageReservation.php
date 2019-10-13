<?php
include_once 'GestionAffichageReservation.php';
include_once 'GestionReservation.php';
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/question.php";

$gReservation = new GestionReservation();
$gAffichage = new GestionAffichageReservation();

$arrayQuestion = $gReservation->questionSelectAllWithQuestionnaireId(2);
$gAffichage->printQuestionArray($arrayQuestion);


 ?>
