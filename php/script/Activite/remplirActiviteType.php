<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/activite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Activite/gestionActivite.php";

$ga = new GestionActivite();
print_r(json_encode($ga->getActivite($_POST['id'])->getId_type()));
 ?>
