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
  public function insertReservationIndividuelle($groupe, $reservation, $client, $emplacement){
    $connexion = new Connexion();
    $conn = $connexion->do();
    $id_utilisateur = $client->getId();

    // TODO: Vérifier si la réservation est conforme

    mysqli_autocommit($conn,FALSE);
    $conn->begin_transaction();

    // Insert le groupe et get son id
    $id_groupe = $this->groupeInsertReturnId($conn, $groupe);
    // Rollback is erreur
    if ($id_groupe == null){
      $conn->rollback();
      exit();
    }

    // Créer l'inscription (Lien entre groupe et utilisateur)
    $inscription = new Inscription($id_utilisateur, $id_groupe, null);

    // Insert l'inscription, Rollback si erreur
    if($this->inscriptionInsert($conn, $inscription) == false){
      $conn->rollback();
      exit();
    }

    // Insert emplacement, rollback si erreur
    if($this->emplacementInsert($conn, $emplacement) == false){
      $conn->rollback();
      exit();
    }

    // get l'id de l'emplacement précédement créé
    $id_emplacement =  $this->emplacementSelectId($conn, $emplacement);
    // Rollback si erreur
    if($id_emplacement == null){
      $conn->rollback();
      exit();
    }

    // Créer la réservation
    $reservation->setIdGroupe($id_groupe);
    $reservation->setIdEmplacement($id_emplacement);

    // Insert la reservation, Rollback si erreur
    if($this->reservationInsert($conn, $reservation) == false){
      $conn->rollback();
      exit();
    }

    $conn->commit();
  }

  /**
  * Insert un groupe dans la BD
  * Retourne l'id PK du groupe inséré
  */
  private function groupeInsertReturnId($conn, $groupe){
    $id = null;
    $id_type_groupe = $groupe->getIdTypeGroupe();
    $nom_entreprise = $groupe->getNomEntreprise();
    $nom_organisateur = $groupe->getNomOrganisateur();
    $nb_participant = $groupe->getNbParticipant();

    // Créer le groupe
    $stmt = $conn->prepare("INSERT INTO groupe (id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (?, ?, ?, ?);");
    $stmt->bind_param('issi', $id_type_groupe, $nom_entreprise, $nom_organisateur, $nb_participant);
    $stmt->execute();

    //Vérifie si le groupe a bien été insert
    $stmt = $conn->prepare("SELECT * FROM groupe WHERE id_type_groupe = ? AND nom_entreprise = ? AND nom_organisateur = ? AND nb_participant = ?;");
    $stmt->bind_param('issi', $id_type_groupe, $nom_entreprise, $nom_organisateur, $nb_participant);
    $stmt->execute();
    $result = $stmt->get_result();

    // S'il y a un résultat
    if ($row = $result->fetch_assoc()){
      $id = $row['no_groupe']; // get l'id du groupe
    }

    if($conn->error){
      echo "groupeInsertReturnId : ".$conn->error;
    }

    return $id;
  }

  /**
  * Insert une inscription dans la BD
  * Retourne un bool si erreur
  */
  private function inscriptionInsert($conn, $inscription){
    $id_utilisateur = $inscription->getIdUtilisateur();
    $id_groupe = $inscription->getIdGroupe();

    $stmt = $conn->prepare("INSERT INTO inscription (id_utilisateur, id_groupe) VALUES (?, ?);");
    $stmt->bind_param('ii', $id_utilisateur, $id_groupe);
    $stmt->execute();
    if($conn->error){
      echo "inscriptionInsert : ".$conn->error;
      return false;
    }
    return true;
  }

 /**
 * Insert un emplacement dans la BD
 * Retourne un bool si erreur
 */
  private function emplacementInsert($conn, $emplacement){
    $id_type_emplacement = $emplacement->getIdTypeEmplacement();
    $nom_lieu = $emplacement->getNomLieu();

    $stmt = $conn->prepare("INSERT INTO emplacement (id_type_emplacement, nom_lieu) VALUES (?,?);");
    $stmt->bind_param('is', $id_type_emplacement, $nom_lieu);
    $stmt->execute();

    if($conn->error){
      echo "emplacementInsert".$conn->error;
      return false;
    }
    return true;
  }

  /**
  * Select l'id d'un emplacement dans la BD
  * Retourne l'id, ou NULL
  */
  private function emplacementSelectId($conn, $emplacement){
    $id = null;
    $id_type_emplacement = $emplacement->getIdTypeEmplacement();
    $nom_lieu = $emplacement->getNomLieu();

    $stmt = $conn->prepare("SELECT id FROM emplacement WHERE id_type_emplacement = ? AND nom_lieu = ?;");
    $stmt->bind_param('is', $id_type_emplacement, $nom_lieu);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()){
      $id = $row['id']; // get l'id du groupe
    }

    if($conn->error){
      echo "emplacementSelectId : ".$conn->error;
    }

    return $id;
  }

  /**
  * Insert une reservation dans la BD
  * Retourne un bool si erreur
  */
  private function reservationInsert($conn, $reservation){
    $id_paiement = $reservation->getIdPaiement();
    $id_emplacement = $reservation->getIdEmplacement();
    $id_suivi = $reservation->getIdSuivi();
    $id_activite = $reservation->getIdActivite();
    $id_groupe = $reservation->getIdGroupe();
    $date_rendez_vous = $reservation->getDateRendezVous();
    $heure_debut = $reservation->getHeureDebut();
    $heure_fin = $reservation->getHeureFin();

    $stmt = $conn->prepare("INSERT INTO Reservation (id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, date_rendez_vous, heure_debut, heure_fin) VALUES (?,?,?,?,?,?,?,?);");
    $stmt->bind_param('iiiiisii', $id_paiement, $id_emplacement, $id_suivi, $id_activite, $id_groupe, $date_rendez_vous, $heure_debut, $heure_fin);
    $stmt->execute();

    if($conn->error){
      echo "reservationInsert".$conn->error;
      return false;
    }
    return true;
  }

  /**
  * Selectionne tous les groupes dans la BD.
  * Retourne un array de Groupe
  */
  public function groupeSelectAll(){
    $conn = ($connexion = new Connexion())->do();

    $stmt = $conn->prepare("SELECT * FROM groupe;");
    $stmt->execute();
    $result = $stmt->get_result();
    $array = array();
    while($row = $result->fetch_assoc()){
      $groupeTemp = new Groupe($row['no_groupe'], $row['id_type_groupe'], $row['nom_entreprise'], $row['nom_organisateur'], $row['nb_participant']);
      array_push($array, $groupeTemp);
    }
    return $array;
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
