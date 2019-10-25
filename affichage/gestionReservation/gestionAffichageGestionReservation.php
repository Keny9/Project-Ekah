<?php
  class GestionAffichageGestionReservation
  {
    public function getAllActivite(){
       $ga = new GestionActivite();
       $activite = $ga->getAllActivite();

       $html = "";

        if (!is_array($activite)){
         $html .= "Aucun resultat trouvé.";
       }
       else{
         for ($i = 0; $i < sizeof($activite); $i++){
           $html .= "
               <div class=\"sectionActivite\" >
               <div class=\"titreActivite\">".$activite[$i]->getNom()."</div>
               <div onclick='selectionne($i);' class=\"boiteSelection\" id='Activite-$i'></div>
               </div>
                 ";

         }
         $j=sizeof($activite);
         $html.="
         <div class=\"sectionActivite\" >
         <div class=\"titreActivite\">Ajouter une réservation</div>
         <div onclick='selectionne($j);' class=\"boiteSelection\" id='Activite-$j'></div>
         </div>
         ";
       }
       return $html;
     }

     public function getAllTypeActivite(){
        $ga = new GestionActivite();
        $type_activite = $ga->getAllTypeActivite();

        $html = "";

         if (!is_array($type_activite)){
          $html .= "Aucun resultat trouvé.";
        }
        else{
          $html .= "<select class=\"boxType\" name=\"type\" id=\"type\"> ";
          for ($i = 0; $i < sizeof($type_activite);$i++){
            $j=$i+1;

            $html .= "
              <option id='Type-$i' value=\"$j\" >".$type_activite[$i]->getNom()."</option>
            ";
          }
          $html .= "</select>";
        }
        return $html;
      }

      public function getDureeActivite(){
         $gd = new GestionDuree();
         $duree_activite = $gd->getDureesOfActivite(13);

         $html = "";

          if (!is_array($duree_activite)){
           $html .= "Aucun resultat trouvé.";
         }
         else{
           $html .= "<select class=\"boxDuree\" name=\"service\" id=\"duree\">";
           for ($i = 0; $i < sizeof($duree_activite);$i++){
             $j=$i+1;

             $html .= "
               <option id='Duree-$i' value=\"$j\" >".$duree_activite[$i]->getTemps()." minutes</option>
             ";
           }
           $html .= "</select>";
         }
         return $html;
       }

     public function getAllDuree(){
        $gd = new GestionDuree();
        $duree = $gd->getAllDuree();

        $html = "";

         if (!is_array($duree)){
          $html .= "Aucun resultat trouvé.";
        }
        else{
          for ($i = 0; $i < sizeof($duree); $i++){
            $html .= "
                <div class=\"sectionDuree\" >
                <div class=\"titreActivite\">".$duree[$i]->getTemps()." minutes</div>
                <div onclick='selectionneDuree($i);' class=\"boiteSelection\" id='Duree-$i'></div>
                </div>
                  ";
          }
        }
        return $html;
      }
   }
?>
