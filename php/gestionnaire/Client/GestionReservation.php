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
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Groupe/Groupe.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Inscription/Inscription.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Client/Client.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Emplacement/Emplacement.php";

class GestionReservation{

  /**
  *
  * Insert un enregistrement dans la table Reservation
  * pour une réservation individuelle
  */
  public function insertReservationIndividuelle($reservation, $client, $emplacement){
    $connexion = new Connexion();
    $conn = $connexion->do();

    // TODO: Vérifier si la réservation est conforme

    //Insérer la Reservation

      // Créer le groupe
      $stmt = $conn->prepare("INSERT INTO groupe (id_type_groupe, nb_participant) VALUES (1, 1);");
      $stmt->execute();

        // get l'id du groupe précédement créé
      $id_groupe =  $conn->insert_id;
      $id_utilisateur = $client->getId();
      // Créer l'inscription (Lien entre groupe et utilisateur)

      $stmt = $conn->prepare("INSERT INTO inscription (id_utilisateur, id_groupe) VALUES (?, ?);");
      $stmt->bind_param('ii', $id_utilisateur, $id_groupe);
      $stmt->execute();


      //Créer l'emplacement
      $id_type_emplacement = $emplacement->getIdTypeEmplacement();
      $nom_lieu = $emplacement->getNomLieu();
      $stmt = $conn->prepare("INSERT INTO emplacement (id_type_emplacement, nom_lieu) VALUES (?,?);");
      $stmt->bind_param('is', $id_type_emplacement, $nom_lieu);
      $stmt->execute();

      // get l'id de l'emplacement précédement créé
      $id_emplacement =  $conn->insert_id;
      // Créer la réservation
      $stmt = $conn->prepare("INSERT INTO Reservation
         (id_emplacement, id_activite, id_groupe, date_rendez_vous, heure_debut, heure_fin)
         VALUES (?,?, ?,?,?,?);");
      $id_emplacement;
      $id_activite = $reservation->getIdActivite();
      $id_groupe;
      $date_rendez_vous = $reservation->getDateRendezVous();
      $heure_debut = $reservation->getHeureDebut();
      $heure_fin = $reservation->getHeureFin();
      $stmt->bind_param('iiisii', $id_emplacement, $id_activite, $id_groupe, $date_rendez_vous, $heure_debut, $heure_fin);
      $stmt->execute();
  }

  /**
  * Insert un groupe dans la BD
  *
  */
  private function RI_insertGroupe($conn, $groupe){

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
                                     $row['id_activite'], $row['id_groupe'],
                                     $row['date_rendez_vous'],
                                     $row['heure_debut'], $row['heure_fin']);
    }
    return $reservation;
  }
}
 ?>
