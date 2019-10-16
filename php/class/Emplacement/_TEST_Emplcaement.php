<?php

include_once 'Emplacement.php';

$id = 1;
$id_type_emplacement = 1;
$nom_lieu = "4000 rue mickeyBOOOM";

$emplacement = new Emplacement($id, $id_type_emplacement, $nom_lieu);
$emplacement->print();

 ?>
