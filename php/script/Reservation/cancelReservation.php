<?php
/**
* Script qui cancel une réservation
*
* Nom :         cancelReservation
* Catégorie :   ScriptPhp
* Auteur :      Karl Boutin
* Version :     1.0
* Date de la dernière modification : 2019-11-14
*/

  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php";

  $gReservation = new GestionReservation();

  if(isset($_POST['id_reservation'])){
    $gReservation->cancelReservation($_POST['id_reservation']);




    
    echo json_encode(true);
  }

  echo json_encode(false);

?>
