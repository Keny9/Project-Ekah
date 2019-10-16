<?php

include_once 'Groupe.php';

$no_groupe = 1;
$id_type_groupe = 1;
$nom_entreprise = "Sherweb";
$nom_organisateur = "Monsieur kokokiki";
$nb_participant = 2;

$groupe = new Groupe($no_groupe, $id_type_groupe, $nom_entreprise,
                     $nom_organisateur, $nb_participant);
$groupe->print();

 ?>
