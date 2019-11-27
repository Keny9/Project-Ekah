<?php
/**
* Script qui attribut le prix d'une activité à une variable $prix
*
* Nom :         getPrix
* Catégorie :   Script
* Auteur :      Maxime Lussier
* Version :     1.0
* Date de la dernière modification : 2019-11-27
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";

if(!isset($activite_id)) $activite_id = $_GET['activite_id'];

if(!isset($duree)) $duree = $_GET['duree'];
if (!isset($duree_id)) $duree_id = ($duree / 30);
$facilitateur_id = 1;


$conn = ($ctemp = new Connexion())->do();
$stmt = $conn->prepare("SELECT prix FROM activite_prix WHERE activite_id = ? AND duree_id = ? AND facilitateur_id = ?");
$stmt->bind_param('iii', $activite_id, $duree_id, $facilitateur_id);
$stmt->execute();
$result = $stmt->get_result();
$prix = "";

if($result->num_rows == 0){

}
else{
  if($row = $result->fetch_assoc()){
    $prix .= $row['prix'];
  }
}

?>
