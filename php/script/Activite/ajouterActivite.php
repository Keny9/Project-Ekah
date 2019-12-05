<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/Activite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Activite/GestionActivite.php";

$ga = new GestionActivite();
$activite = new Activite( $_POST['id'],
                        $_POST['idType'],
                        $_POST['idEtat'],
                        $_POST['nom'],
                        $_POST['descriptionC'],
                        $_POST['descriptionL'],);
$ga->ajouterActivite($activite)
 ?>
