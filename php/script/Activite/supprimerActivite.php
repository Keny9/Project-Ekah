<?php
/****************************************
Fichier : supprimerActivite.php
Auteur : William Gonin
Fonctionnalité : Script php pour supprimer un activite
Date : 2019-10-03
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
****************************************/
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/Activite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Activite/GestionActivite.php";

$ga = new GestionActivite();
$ga->supprimerActivite($_POST['id'])
 ?>
