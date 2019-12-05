<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/Activite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Activite/GestionActivite.php";

$ga = new GestionActivite();
$ta_activite_duree = new Ta_duree_activite( $_POST['idDuree'],
                        $_POST['idActivite']);
$ga->ajouterActiviteDuree($ta_activite_duree);
 ?>
