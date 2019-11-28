<?php

if (session_status() === PHP_SESSION_NONE){session_start();}

  class GestionAffichageActivite
  {
    public function getAllAtelier(){
       $gf = new GestionActivite();
       $atelier = $gf->getAllAtelier();

       $html = "";

        if (!is_array($atelier)){
         $html .= "Aucun resultat trouvé.";
       }
       else{
         for ($i = 0; $i < sizeof($atelier);$i++){
           $j=$i+1;

           $html .= "
             <option selected id='Facilitateur-$i' value=".$atelier[$i]->getIdentifiant()." >".$atelier[$i]->getNom()."</option>
           ";

         }
       }
       return $html;
     }

  }
?>
