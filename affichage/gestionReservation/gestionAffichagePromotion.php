<?php
  class GestionAffichageGestionReservation
  {
    public function getAllActivite(){
       $ga = new GestionActivite();
       $activite = $gp->getAllActivite();

       $html = "";

        if (!is_array($activite)){
         $html .= "Aucun resultat trouvé.";
       }
       else{
         for ($i = 0; $i < sizeof($activite); $i++){
           $html .= "
               <div class=\"sectionActivite\" id='Activite-$i'>
               <div class=\"titreActivite\">".$activite[$i]->getNom()."</div>
               </div>
               </br>
                 ";
         }
       }
       return $html;
     }

   }
?>
