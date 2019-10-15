<?php
include_once 'Inscription.php';

$id_utilisateur = 1;
$id_groupe = 1;
$date_inscription = "2019-01-01";

$inscription = new Inscription($id_utilisateur, $id_groupe, $date_inscription);

$inscription->print();


 ?>
