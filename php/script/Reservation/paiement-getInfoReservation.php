<?php
/**
 * Retourne les informations nécessaires pour l'affichage du formulaire de PAIEMENT
 * d'une réservation
 *
 * Nom :         paiement-getInfoReservation.php
 * Catégorie :   scriptPhp
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-11-26
 */

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";

$conn = ($ctemp = new Connexion())->do();
$service_nom = "";


// Get info SERVICE
$stmt = $conn->prepare("SELECT nom, id_type_activite FROM activite WHERE id = ?");
$stmt->bind_param('i', $id_activite);
$stmt->execute();
$result = $stmt->get_result();
if($row = $result->fetch_assoc()){
  $service_nom = $row['nom'];
  $id_type_activite = $row['id_type_activite'];
} else $service_nom = "*erreur";




 ?>
