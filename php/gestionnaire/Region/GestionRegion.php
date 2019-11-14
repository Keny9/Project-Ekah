<?php
/**
* Gestionnaire de réservation
*
* Nom :         GestionReservation
* Catégorie :   Classe
* Auteur :      Maxime Lussier
* Version :     1.4
* Date de la dernière modification : 2019-10-13
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";

class GestionRegion{
  /**
  * Retourne un array de toutes les régions dans la BD
  *
  */
  public function selectAllRegion(){
    $conn = ($connexion = new Connexion())->do();
    $region = null;

    $request = "SELECT * FROM region";
    $stmt = $conn->prepare($request);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()){
      $region[] = $row;
    }

    return $region;
  }
}
 ?>
