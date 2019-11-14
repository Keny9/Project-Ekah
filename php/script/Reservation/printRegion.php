<?php
/**
* Script qui retourne un string HTML pour afficher les régions dans un selectBox
*
* Nom :         printRegion.php
* Catégorie :   Script
* Auteur :      Maxime Lussier
* Version :     1.0
* Date de la dernière modification : 2019-11-14
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Region/GestionRegion.php";

$gRegion = new GestionRegion();

$region_array = $gRegion->selectAllRegion();

$html = "<select class=\"\" name=\"region\" id=\"region\">";
foreach($region_array as $region){
  $html .= "<option value=\"".$region['id']."\">".$region['nom']."</option>";
}
$html .= "</select>";

echo $html;
?>
