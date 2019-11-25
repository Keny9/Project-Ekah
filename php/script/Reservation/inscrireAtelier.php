<?php
  /**
   * Fait appel à la méthode getDisponibiliteFacilitateur
   *
   * Nom :         ajouterDisponibilite
   * Catégorie :   scriptPhp
   * Auteur :      Guillaume Côté
   * Version :     1.0
   * Date de la dernière modification : 2019-10-14
   */

   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Reservation/Reservation.php";

   if (session_status() === PHP_SESSION_NONE){session_start();}

   $id_Reservation = $_POST['id'];
   // $id_Reservation = 1;

   $id_User = $_SESSION['logged_in_user_id'];


   $gReservation = new GestionReservation();
   $reservation = $gReservation->getAtelier($id_Reservation);

  // print_r($reservation);

   echo $gReservation->inscrireAtelier($reservation, $id_User);

?>
