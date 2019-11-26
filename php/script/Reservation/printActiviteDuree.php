<?php
/**
* Script qui retourne un string HTML pour afficher les durées
*
* Nom :         printRegion.php
* Catégorie :   Script
* Auteur :      Maxime Lussier
* Version :     1.0
* Date de la dernière modification : 2019-11-26
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";

$activite_id = $_GET['activite_id'];
echo $activite_id;
$conn = ($ctemp = new Connexion())->do();
$stmt = $conn->prepare("SELECT d.temps FROM ta_duree_activite AS ta
                        INNER JOIN duree AS d ON d.id = ta.id_duree
                        WHERE ta.id_activite = ?");
$stmt->bind_param('i', $activite_id);
$stmt->execute();
$result = $stmt->get_result();
$arrDuree = null;
$html = "
<option class='option-vide' value='vide' selected='selected'>Durée</option>
";
if($result->num_rows == 0){

}
else{
  while($row = $result->fetch_assoc()){
    $arrDuree[] = $row['temps'];
  }

  foreach($arrDuree as $duree){
    $html .= "<option value='$duree'>$duree minutes</option>";
  }
}

echo $html;
?>
