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
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/Activite.php";
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
 $string = "";

 foreach ($reservations as $res){
   $string .= "
   <tr>
     <td>".$res['activite']->getNom()."</td>
     <td>".$res['reservation']->getDateRendezVous()."</td>
     <td>".$res['emplacement']->getNomLieu()."</td>
     <td>".$res['activite']->getCout()."</td>
     <td>".$res['facilitateur']->getPrenom()." ".$res['facilitateur']->getNom()."</td>
   </tr>";
 }

 echo $string;

?>
