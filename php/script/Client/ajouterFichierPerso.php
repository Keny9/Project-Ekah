<?php
/**
 * Ajoute un fichier sur le serveur
 *
 * Nom :         ajouterFichierPerso.php
 * Catégorie :   script
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-11-03
 */

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";

$nom_fichier =  $_GET['nom_fichier'];

echo $nom_fichier;






/*
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
*/
 ?>
