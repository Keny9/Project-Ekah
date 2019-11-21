<?php
include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/Gestionnaire/Facilitateur/GestionFacilitateur.php';

  class GestionAffichageDispo
  {
    public function getAllFacilitateur(){
       $gf = new GestionFacilitateur();
       $facilitateur = $gf->getAllFacilitateurActif();

       $html = "";

        if (!is_array($facilitateur)){
         $html .= "Aucun resultat trouvé.";
       }
       else{
         for ($i = 0; $i < sizeof($facilitateur);$i++){
           $j=$i+1;
           $html .= "
             <option id='Facilitateur-$i' value=".$facilitateur[$i]->getId()." >".$facilitateur[$i]->getPrenom()." ".$facilitateur[$i]->getNom()."</option>
           ";
         }
       }
       return $html;
     }

     public function getAllRegion(){
        $gf = new GestionFacilitateur();
        $region = $gf->getRegion();

        $html = "";

         if (!is_array($region)){
          $html .= "Aucun resultat trouvé.";
        }
        else{
          for ($i = 0; $i < sizeof($region);$i++){
            $html .= "
              <option id='Region-$i' value=".$region[$i]->getId()." >".$region[$i]->getNom()."</option>
            ";
          }
        }
        return $html;
      }

   }
?>
