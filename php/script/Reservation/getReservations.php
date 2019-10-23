<?php
/**
 * Script qui retourne un array de toute les réservations trouvées
 * selon les variables POST
 *
 * Nom :         getReservations.php
 * Catégorie :   Script
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-19
 */

 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Reservation/Reservation.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Emplacement/Emplacement.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/activite.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php";

 $gestion = new GestionReservation();

 if (empty($_POST)){
    $reservations = $gestion->selectAll(null);
 }
 else{
    $reservations = $gestion->selectAll($_POST['user_id']);
 }



 $array = array();
 $res_json;

 foreach ($reservations as $res){
   $res_json = [
     'reservation_id' =>  $res['reservation']->getId(),
     'reservation_datetime' => $res['reservation']->getDateRendezVous(),
     'activite_nom' =>  $res['activite']->getNom(),
     'activite_cout' =>  $res['activite']->getCout(),
     'emplacement_nomlieu' =>  $res['emplacement']->getNomLieu(),
     'facilitateur_nom' => $res['facilitateur']->getNom(),
     'facilitateur_prenom' => $res['facilitateur']->getPrenom(),
     'facilitateur_id' => $res['facilitateur']->getId(),
   ];

   array_push($array, $res_json);
 }

 echo json_encode($array);

?>
