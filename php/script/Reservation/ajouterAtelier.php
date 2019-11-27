<?php
  /**
   * Fait appel aux métodes pour créer un nouvel atelier
   *
   * Nom :         ajouterAtelier.php
   * Catégorie :   scriptPhp
   * Auteur :      Guillaume Côté
   * Version :     1.0
   * Date de la dernière modification : 2019-11-27
   */

 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Reservation/Reservation.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Activite/gestionActivite.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/activite.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/emplacement/Emplacement.php";

  if (session_status() === PHP_SESSION_NONE){session_start();}

  $prix = NULL;
  $duree = null;
  $activite = null;
  $date = null;
  $heure = null;
  $adresse = null;

  $prix = $_POST['prix'];
  $duree = $_POST['duree'];
  $activite = $_POST['activite'];     //id de l'activite
  $date = $_POST['date'];
  $heure = $_POST['heure'];
  $adresse = $_POST['adresse'];

  $id_facilitateur = $_SESSION['logged_in_user_id'];

  // $prix = "100";
  // $duree = "30";
  // $activite = 1;
  // $date = "2019-12-25 12:00:00";
  // $adresse = "222 rue du panier";

  $ga = new gestionActivite();
  $activite = $ga->getActivite($activite);

  $gr = new GestionReservation();



  $reservation = new Reservation(null, null, null, null, $activite->getIdentifiant(), null, $date, 1, null);



  echo $gr->insertAtelier($reservation, $activite, $adresse, $id_facilitateur, $duree);



 ?>
