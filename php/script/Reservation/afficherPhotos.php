<?php

  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Facilitateur/gestionFacilitateur.php";

  $gf = new GestionFacilitateur();

  $facilitateur = $gf->getAllFacilitateurActifAvecDispoGroup();
  $html = "";

  // print_r($facilitateur);

  if (!is_array($facilitateur)){
   $html .= "Vous ne pouvez pas choisir de facilitateur.";
 }else{
   for ($i=0; $i < sizeof($facilitateur); $i++) {

     $html .= "

     <div id=\"".$facilitateur[$i]->getId()."\" class=\"block-photo-facilitateur\">
       <div class=\"photo-facilitateur\">
         <img src=\"../../img/facilitateur/".$facilitateur[$i]->getPhoto()."\" alt=\"facilitateur\">
       </div>
       <div class=\"block-photo-nom\">
         <div class=\"photo-nom\">".$facilitateur[$i]->getPrenom()."</div>
       </div>
     </div>

     ";
   }
 }
 echo $html;
 ?>
