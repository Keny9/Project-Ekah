<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/Question.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Question/GestionQuestion.php";

$gq = new GestionQuestion();
$gq->supprimerQuestionQuestionnaire($_POST['idQuestionnaire'],$_POST['id']);
//$gq->supprimerQuestion($_POST['id']);
 ?>
