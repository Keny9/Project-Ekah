<?php
/**
* Script qui retourne un string HTML pour afficher le prix
*
* Nom :         printPrix.php
* Catégorie :   Script
* Auteur :      Maxime Lussier
* Version :     1.0
* Date de la dernière modification : 2019-11-26
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";

$activite_id = $_GET['activite_id'];
$duree = $_GET['duree'];
$duree_id = ($duree / 30);
$facilitateur_id = 1;


$conn = ($ctemp = new Connexion())->do();
$stmt = $conn->prepare("SELECT prix FROM activite_prix WHERE activite_id = ? AND duree_id = ? AND facilitateur_id = ?");
$stmt->bind_param('iii', $activite_id, $duree_id, $facilitateur_id);
$stmt->execute();
$result = $stmt->get_result();
$html = "";

if($result->num_rows == 0){

}
else{
  if($row = $result->fetch_assoc()){
    $html .= $row['prix']." $ CAD";
  }
}

echo $html;
?>
