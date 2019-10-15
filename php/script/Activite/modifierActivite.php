<?php
/****************************************
Fichier : scriptSupprimerClient.php
Auteur : Guillaume Côt.
Fonctionnalité : Script php pour supprimer un client
Date : 2019-04-24
Vérification :
Date Nom Approuvé
2019-05-02        William Gonin              Approuvé
=========================================================
Historique de modifications :
Date Nom Description
=========================================================
****************************************/
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/activite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Activite/gestionActivite.php";

$ga = new GestionActivite();
$activite = new Activite( $_POST['id'],
                        $_POST['idType'],
                        $_POST['nom'],
                        $_POST['descriptionC'],
                        $_POST['descriptionL']);
$ga->modifierActivite($activite, $_POST['id'])
 ?>
