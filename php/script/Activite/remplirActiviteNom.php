<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/Activite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Activite/GestionActivite.php";

$ga = new GestionActivite();
print_r(json_encode($ga->getActivite($_POST['id'])->getNom()));
 ?>
