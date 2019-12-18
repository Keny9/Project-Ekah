<?php
include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Facilitateur/GestionFacilitateur.php';

if (session_status() === PHP_SESSION_NONE){session_start();}

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

           echo $_SESSION['logged_in_user_id'] . " = " . $facilitateur[$i]->getId();

           if($_SESSION['logged_in_user_id'] == $facilitateur[$i]->getId()){
             $html .= "
               <option selected id='Facilitateur-$i' value=".$facilitateur[$i]->getId()." >".$facilitateur[$i]->getPrenom()." ".$facilitateur[$i]->getNom()."</option>
             ";
           }else{
             $html .= "
               <option id='Facilitateur-$i' value=".$facilitateur[$i]->getId()." >".$facilitateur[$i]->getPrenom()." ".$facilitateur[$i]->getNom()."</option>
             ";
           }

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
          for ($i = 1; $i < sizeof($region);$i++){
            $html .= "
              <option id='Region-$i' value=".$region[$i]->getId()." >".$region[$i]->getNom()."</option>
            ";
          }
        }
        return $html;
      }

   }
?>
