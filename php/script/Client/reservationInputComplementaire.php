<?php
/**
 * Script pour la page 'reservation' du client. Fonction Ajax pour le onChange des services.
 * Retourne la valeur de display pour les questions pour le lieu.
 *
 * Nom :         reservationInputComplementaire
 * Catégorie :   script
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-11-13
 */

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Activite/GestionActivite.php";


function reservationInputComplementaire(){
  $gA = new GestionActivite();
  $activite_id = $_GET['service_id'];
  $type_activite_id = $gA->getActiviteTypeId($activite_id);

  if ($type_activite_id == 2){ // À domicile
    echo "block";
  } elseif($type_activite_id == 3){ // En ligne
    echo "none";
  }
}

reservationInputComplementaire();
?>
