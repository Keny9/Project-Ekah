<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/Question.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Question/GestionQuestion.php";

$gq = new GestionQuestion();
$question = new Question( $_POST['id'],
                        $_POST['idType'],
                        $_POST['question'],
                        $_POST['nbLigne'],
                        );
$gq->ajouterQuestion($question)
 ?>
