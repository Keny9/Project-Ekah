<?php
/****************************************
Fichier : supprimerActiviteDuree.php
Auteur : William Gonin
Fonctionnalité : Script php pour supprimer une duree d'un activite
Date : 2019-10-03
Vérification :
Date Nom Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
****************************************/
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/activite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Activite/gestionActivite.php";

$ga = new GestionActivite();
$ga->supprimerActiviteDuree($_POST['idActivite'],$_POST['idDuree']);
 ?>
