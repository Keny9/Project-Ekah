<?php
/**
* Gestionnaire d'affichage de réservation
*
* Nom :         GestionAffichageReservation
* Catégorie :   Classe
* Auteur :      Maxime Lussier
* Version :     1.0
* Date de la dernière modification : 2019-10-13
*/

include_once 'GestionReservation.php';
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/question.php";

class GestionAffichageReservation{

  /**
  * Print un array de question dans des balises html
  *
  */
  public function printQuestionArray($array){
    foreach ($array as $question){
      $this->printQuestion($question);
    }
  }

  /**
  * Print une question dans des balises html
  *
  */
  public function printQuestion($question){
    $id_input = "Q-".$question->getOrdre();
    echo
    "
    <div class=\"group-input-inscr\">
      <label class=\"label-question\" for=\"".$id_input."\">".$question->getQuestion()."</label>
      <input type=\"text\" name=\"".$id_input."\" id=\"".$id_input."\" value=\"\" class=\"input-inscr input-long input-question\"
    </div>
    ";
  }


}
 ?>
