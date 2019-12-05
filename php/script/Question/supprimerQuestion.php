<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/question.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Question/gestionQuestion.php";

$gq = new GestionQuestion();
$gq->supprimerQuestionQuestionnaire($_POST['idQuestionnaire'],$_POST['id']);
//$gq->supprimerQuestion($_POST['id']);
 ?>
