<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Duree/duree.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Duree/gestionDuree.php";

$gd = new GestionDuree();
print_r(json_encode($ga->getActivite($_POST['id'])->getId_type()));
 ?>
