<?php
/**
 * Compare un mot de passe avec celui d'un client à partir de son ID
 *
 * Nom :         comparerMotDePasse.php
 * Catégorie :   script
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-11-03
 */

  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";

$client_id =  $_GET['client_id'];
$mot_de_passe = $_GET['mot_de_passe'];


//SQL
$conn = ($temp = new Connexion)->do();
$request = "SELECT mot_de_passe FROM compte_utilisateur WHERE fk_utilisateur = ?";
$stmt = $conn->prepare($request);
$stmt->bind_param('i', $client_id);
$stmt->execute();
$result = $stmt->get_result();
if($result == false){
  die($conn->errno.$conn->error);
}

$row = $result->fetch_assoc();

// TEST
echo password_verify($mot_de_passe, $row['mot_de_passe']) ? 'true' : 'false';

 ?>
