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
  * Retourne un String contenant les questions en language html
  *
  */
  public function printQuestionArray($array){
    $string = "";
    foreach ($array as $question){
      $string .= $this->printQuestion($question);
    }
    return $string;
  }

  /**
  * Retourne un string contenant une question en langauge html
  *
  */
  public function printQuestion($question){
    $id_input = "Q-".$question->getOrdre();
    return
    "
    <div class=\"group-input-inscr\">
      <label class=\"label-question\" for=\"".$id_input."\">".$question->getQuestion()."</label>
      <input type=\"text\" name=\"".$id_input."\" id=\"".$id_input."\" value=\"\" class=\"input-inscr input-long input-question\"
    </div>
    ";
  }


}
 ?>
