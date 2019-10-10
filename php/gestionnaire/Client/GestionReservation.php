<?php
/**
* Gestionnaire de réservation
*
* Nom :         GestionReservation
* Catégorie :   Classe
* Auteur :      Maxime Lussier
* Version :     1.1
* Date de la dernière modification : 2019-10-07
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Reservation/Reservation.php";

class GestionReservation{

  /**
  *
  * Insert un enregistrement dans la table Reservation
  */
  public function insertReservation(){

  }

  /**
  *
  * Retourne un enregistrement de la table Reservation;
  * Retourne NULL si aucun enregristrement trouvé.
  *
  * @param int $id Id primary key de l'enregistrement
  * @return reservation $reservation
  */
  public function selectReservation($id){
    $connexion = new Connexion();
    $conn = $connexion->do();
    $reservation = NULL;

    $stmt = $conn->prepare("SELECT * FROM reservation WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()){
      $reservation = new Reservation($row['id'], $row['id_paiement'],
                                     $row['id_emplacement'], $row['id_suivi'],
                                     $row['id_activite'], $row['date_rendez_vous'],
                                     $row['heure_debut'], $row['heure_fin']);
    }
    return $reservation;
  }
}
 ?>
