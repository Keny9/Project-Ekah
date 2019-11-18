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
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Reservation/Reservation.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Groupe/Groupe.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Inscription/Inscription.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Client/Client.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Emplacement/Emplacement.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Question/question.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/activite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/QuestionnaireReservation/questionnaire.php";

class GestionReservation{
  //Retourne tous les ateliers
    public function getAllAteliers(){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();
      $reservation = null;

      $requete= "SELECT reservation.id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, date_rendez_vous, id_region, heure_fin FROM reservation
                INNER JOIN activite ON id_activite = activite.id
                INNER JOIN type_activite ON id_type_activite = type_activite.id
                WHERE type_activite.id = 1 AND id_etat = 1 AND date_rendez_vous >= now()";

      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $reservation[] = new Reservation($row['id'], $row['id_paiement'],
                                         $row['id_emplacement'], $row['id_suivi'],
                                         $row['id_activite'], $row['id_groupe'],
                                         $row['date_rendez_vous'],
                                         $row['id_region'], $row['heure_fin']);
        }
      }

      return $reservation;
    }

    //Retourne un atelier à l'aide d'un id
      public function getAtelier($id){
        $conn = ($connexion = new Connexion())->do();
        $reservation = null;

        $requete= "SELECT * FROM reservation
                  WHERE id = ?";

        $stmt = $conn->prepare($requete);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if(!$result){
          trigger_error($conn->error);
        }

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $reservation = new Reservation($row['id'], $row['id_paiement'],
                                           $row['id_emplacement'], $row['id_suivi'],
                                           $row['id_activite'], $row['id_groupe'],
                                           $row['date_rendez_vous'],
                                           $row['id_region'], $row['heure_fin']);
          }
        }

        return $reservation;
      }

    //Retourne l'emplacement d'une reservation à l'aide d'un id
      public function getEmplacementAtelier($id){
        $conn = ($connexion = new Connexion())->do();
        $emplacement = null;

        $requete= "SELECT * FROM emplacement
                  INNER JOIN reservation ON emplacement.id = id_emplacement
                  WHERE reservation.id = ?";

        $stmt = $conn->prepare($requete);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if(!$result){
          trigger_error($conn->error);
        }

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $emplacement = new Emplacement($row['id'], $row['id_type_emplacement'], $row['nom_lieu']);
          }
        }

        return $emplacement;
      }


    //Retourne l'activite d'une reservation à l'aide d'un id
      public function getActiviteReservation($id){
        $conn = ($connexion = new Connexion())->do();
        $activite = null;

        $requete= "SELECT * FROM activite
                  INNER JOIN reservation ON activite.id = id_activite
                  WHERE reservation.id = ?";

        $stmt = $conn->prepare($requete);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if(!$result){
          trigger_error($conn->error);
        }

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $activite = new Activite( $row['id'],
                                      $row['id_type_activite'],
                                      $row['nom'],
                                      $row['description_breve'],
                                      $row['description_longue']);
          }
        }

        return $activite;
      }


  public function getIdActiviteReservation($reservation){
    $tempconn = new Connexion();
    $conn = $tempconn->getConnexion();
    $reservation = null;

    $requete= "SELECT reservation.id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, date_rendez_vous, id_region, heure_fin FROM reservation
              INNER JOIN activite ON id_activite = activite.id
              INNER JOIN type_activite ON id_type_activite = type_activite.id
              WHERE type_activite.id = 1 AND id_etat = 1";

    $result = $conn->query($requete);
    if(!$result){
      trigger_error($conn->error);
    }

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $reservation[] = new Reservation($row['id'], $row['id_paiement'],
                                       $row['id_emplacement'], $row['id_suivi'],
                                       $row['id_activite'], $row['id_groupe'],
                                       $row['date_rendez_vous'],
                                       $row['id_region'], $row['heure_fin']);
      }
    }

    return $reservation;
  }

  /**
   *
   * Insert un enregistrement dans la table Reservation
   * pour une réservation individuelle
   * Retourne l'id du suivi
   */
 public function insertReservationIndividuelle($groupe, $reservation, $client_id/*, $emplacement*/){
     $connexion = new Connexion();
     $conn = $connexion->do();
     $id_utilisateur = $client_id;

     // TODO: Vérifier si la réservation est conforme

     mysqli_autocommit($conn,FALSE);
     $conn->begin_transaction();

     // Insert le groupe et get son id
     $id_groupe = $this->groupeInsertReturnId($conn, $groupe);
     // Rollback is erreur
     if ($id_groupe == null){
       $conn->rollback();
       echo "shit";
       exit();
     }

     // Créer l'inscription (Lien entre groupe et utilisateur)
     $inscription = new Inscription($id_utilisateur, $id_groupe, null);

     // Insert l'inscription, Rollback si erreur
     if($this->inscriptionInsert($conn, $inscription) == false){
       $conn->rollback();
       exit();
     }

    /* // Insert emplacement, rollback si erreur
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
     }*/

     // Créer la réservation
     $reservation->setIdGroupe($id_groupe);

     // Insert la reservation, Rollback si erreur
     if(( $suivi_id = $this->reservationInsert($conn, $reservation) ) == false){
       $conn->rollback();
       exit();
     }

     $conn->commit();
     return $suivi_id;
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
    if($nb_participant == null) $nb_participant = "NULL";
    if($nom_entreprise == null) $nom_entreprise = "NULL";
    if($nom_organisateur == null) $nom_organisateur = "NULL";

    // Créer le groupe
    $stmt = $conn->prepare("INSERT INTO groupe (id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (?, ?, ?, ?);");
    $stmt->bind_param('issi', $id_type_groupe, $nom_entreprise, $nom_organisateur, $nb_participant);
    $stmt->execute();

    // get l'id du groupe
    $id = $conn->insert_id;



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
  * Select un emplacement selon son ID
  * Retourne un Emplacement
  */
  private function emplacementSelect($conn, $id){
    $emplacement = null;

    $stmt = $conn->prepare("SELECT * FROM emplacement WHERE id = ?;");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()){
      $emplacement = new Emplacement($row['id'], $row['id_type_emplacement'], $row['nom_lieu']); // get l'id du groupe
    }

    if($conn->error){
      echo "emplacementSelectId : ".$conn->error;
    }

    return $emplacement;
  }

  /**
  * Insert un emplacement dans la BD
  * Retourne l'id de l'emplacement inséré
  */ // TODO: utiliser un objet Emplacement
  public function insertEmplacement($noAdresse, $rue, $ville){
    $conn = ($connexion = new Connexion())->do();

    $id_type_emplacement = 1; // TODO: Gérer ça
    $nom_lieu = $noAdresse." ".$rue.", ".$ville; // Concat l'adresse en un string
    $request = "INSERT INTO emplacement (id_type_emplacement, nom_lieu) VALUES (?, ?);";
    $stmt = $conn->prepare($request);
    $stmt->bind_param('is', $id_type_emplacement, $nom_lieu);
    $stmt->execute();

    return $conn->insert_id;
  }

  /**
  * Select une activite selon son ID
  * Retourne une Activite
  */
  private function activiteSelect($conn, $id){
    $activite = null;

    $stmt = $conn->prepare("SELECT * FROM activite WHERE id = ?;");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()){
      $activite = new Activite($row['id'], $row['id_type_activite'], $row['nom'], $row['description_breve'], $row['description_longue'], $row['cout']); // get l'id du groupe
    }
    if($conn->error){
      echo "activiteSelect : ".$conn->error;
    }

    return $activite;
  }


  /**
  * Insert une reservation dans la BD
  * Retourne un bool si erreur
  * Retourne l'id du suivi
  */
  private function reservationInsert($conn, $reservation){
    $id_paiement = $reservation->getIdPaiement();
    $id_emplacement = $reservation->getIdEmplacement();
    //$id_suivi = $reservation->getIdSuivi();
    $id_activite = $reservation->getIdActivite();
    $id_groupe = $reservation->getIdGroupe();
    $date_rendez_vous = $reservation->getDateRendezVous();
    $id_region = $reservation->getIdRegion();
    $heure_fin = $reservation->getHeureFin();
    $id_facilitateur = $reservation->getIdFacilitateur();
    $id_etat = 1;



        // TODO: faire une méthode pour ça
        // Insert le suivi vide
    $suivi_contenu = "";
    $stmt = $conn->prepare("INSERT INTO suivi (fait) VALUES (?)"); /*********Sur 000webhost ca ne se produit pas puisque la colonne commentaire est a not null et dans ce cas ci rien est inséré*********/
    $stmt->bind_param('s', $suivi_contenu);
    $stmt->execute();
    $id_suivi = $conn->insert_id;

    /****************** Erreur sur 000webhost Cannot add or update a child row: a foreign key constraint fails (`id11534325_ekah`.`reservation`, CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`id_suivi`) REFERENCES `suivi` (`id`)) *******/

    $stmt = $conn->prepare("INSERT INTO reservation (id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, date_rendez_vous, id_region, heure_fin, id_facilitateur, id_etat) VALUES (?,?,?,?,?,?,?,?,?,?);"); /*******Erreur sur 000webhost puisque dans le insert les colonnes ne sont pas dans le meme ordre que la bd*******/
    $stmt->bind_param('iiiiisisii', $id_paiement, $id_emplacement, $id_suivi, $id_activite, $id_groupe, $date_rendez_vous, $id_region, $heure_fin, $id_facilitateur, $id_etat);
    $stmt->execute();

    if($conn->error){
      echo "reservationInsert".$conn->error;
      return false;
    }
    return $id_suivi;
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
                                     $row['id_region'], $row['heure_fin']);
    }
    return $reservation;
  }

  /**
  * Selectionne toutes les questions dans la bd
  * Retourne un array de question
  */
  public function questionSelectAll(){
    $conn = ($connexion = new Connexion())->do();

    $stmt = $conn->prepare("SELECT * FROM question;");
    $stmt->execute();
    $result = $stmt->get_result();
    $array = array();
    while($row = $result->fetch_assoc()){
      $questionTemp = new Question($row['id'], $row['id_type_question'], $row['question'], $row['nb_ligne'], null);
      array_push($array, $questionTemp);
    }
    return $array;
  }

  /**
  * Selection les questions en lien avec le questionnaire
  * Retourne un array de questions, ou NULL
  * order by ordre
  */
  public function questionSelectAllWithQuestionnaireId($id_du_questionnaire){
    $conn = ($connexion = new Connexion())->do();

    $stmt = $conn->prepare("SELECT q.id, q.id_type_question, q.question, q.nb_ligne, ta.ordre FROM question AS q
      INNER JOIN ta_questionnaire_reservation_question AS ta ON ta.id_question = q.id
      INNER JOIN questionnaire_reservation AS qr ON qr.id = ta.id_questionnaire_res
      WHERE qr.id = ?
      ORDER BY ta.ordre;");
    $stmt->bind_param('i', $id_du_questionnaire);
    $stmt->execute();
    $result = $stmt->get_result();
    $array = array();
    while ($row = $result->fetch_assoc()){
      $questionTemp = new Question($row['id'], $row['id_type_question'], $row['question'], $row['nb_ligne'], $row['ordre']);
      array_push($array, $questionTemp);
    }


    return $array;
  }

  /**
  * Selectionne les ID de questionnaire lié à l'id de l'activité en paramètre
  * Retourne un array de questionnaire, ou NULL
  */
  public function questionnaireSelectAllWithActiviteId($id_activite){
    $conn = ($connexion = new Connexion())->do();
    $array = array();

    $stmt = $conn->prepare("SELECT qr.id AS id_questionnaire, qr.nom_questionnaire, ta.id_activite FROM questionnaire_reservation AS qr
      INNER JOIN ta_activite_questionnaire_reservation AS ta ON ta.id_questionnaire_res = qr.id
      WHERE ta.id_activite = ?;");
    $stmt->bind_param('i', $id_activite);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()){
      $questionnaireTemp = new Questionnaire($row['id_questionnaire'], $row['nom_questionnaire']);
      array_push($array, $questionnaireTemp);
    }
    return $array;
  }


  /**
  * Selectionne toutes les réservations dans la bd
  * Retourne un array de réservation ainsi que d'autres attributs pour l'affichage dans le tableau
  * Prend des paramètres de recherche.
  */
public function selectAll($user_id = null){
    $conn = ($connexion = new Connexion())->do();
    $requete = "SELECT r.id, r.id_paiement, r.id_emplacement, r.id_suivi, r.id_activite, r.id_groupe, r.id_facilitateur, r.date_rendez_vous, r.id_region, r.heure_fin, r.id_facilitateur FROM reservation AS r";


    if ($user_id != null){
      $requete .= "
      INNER JOIN inscription AS i ON i.id_groupe = r.id_groupe
      INNER JOIN utilisateur AS u ON u.id = i.id_utilisateur
      WHERE u.id = $user_id";
    }


    $stmt = $conn->prepare($requete);
    $stmt->execute();
    $result = $stmt->get_result();
    $array = array();
    while($row = $result->fetch_assoc()){
      // Créer la réservation
      $res = new Reservation($row['id'], $row['id_paiement'], $row['id_emplacement'], $row['id_suivi'], $row['id_activite'], $row['id_groupe'], $row['date_rendez_vous'], $row['id_region'], $row['heure_fin'], $row['id_facilitateur']);
      // Créer l'emplacement
      $emp = $this->emplacementSelect($conn, $row['id_emplacement']);
      //Créer l'activité
      $act = $this->activiteSelect($conn, $row['id_activite']);
      //Créer facilitateur
      $fac =  $this->facilitateurSelectWithId($conn, $row['id_facilitateur']);
      $row_content = [
        'reservation' => $res,
        'emplacement' => $emp,
        'activite' => $act,
        'facilitateur' => $fac,
      ];

      array_push($array, $row_content);
    }
    return $array;
  }

  /**
  * Selectionne dans la BD le facilitateur avec l'ID en paramètre.
  * Retourne un objet facilitateur
  */
  private function facilitateurSelectWithId($conn, $facilitateur_id){
    $requete = "SELECT * FROM utilisateur
                INNER JOIN compte_utilisateur ON compte_utilisateur.fk_utilisateur = utilisateur.id
                WHERE utilisateur.id = ?";

    $stmt = $conn->prepare($requete);
    $stmt->bind_param('i', $facilitateur_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $facilitateur = null;
    if ($row = $result->fetch_assoc()){
      $facilitateur = new Facilitateur($row['id'], $row['nom'], $row['prenom'], $row['date_inscription'], $row['courriel'], $row['date_naissance'], $row['telephone'], null, null);
    }

    return $facilitateur;
  }


  /**
  * Obtenir toutes la liste des reservations sous forme de donnees
  *
  */
    public function getAllReservationData($id_client = null){
      $conn = ($connexion = new Connexion())->do();

      $requete = "SELECT r.id, r.id_etat, a.nom, r.date_rendez_vous, e.nom_lieu, p.montant, s.id AS id_suivi, g.no_groupe, i.date_inscription,
                  CONCAT(u.prenom, ' ' , u.nom) AS client, u.id AS client_id, CONCAT(f.prenom, ' ' , f.nom) AS facilitateur
                  FROM reservation r
                  LEFT JOIN utilisateur f ON r.id_facilitateur = f.id
                  LEFT JOIN activite a ON r.id_activite = a.id
                  LEFT JOIN emplacement e ON r.id_emplacement = e.id
                  LEFT JOIN paiement p ON r.id_paiement = p.id
                  LEFT JOIN suivi s ON r.id_suivi = s.id
                  LEFT JOIN groupe g ON r.id_groupe = g.no_groupe
                  LEFT JOIN inscription i ON g.no_groupe = i.id_groupe
                  LEFT JOIN utilisateur u ON i.id_utilisateur = u.id";

      if($id_client){
        $requete .= " WHERE u.id = $id_client;";
      }

      $stmt = $conn->prepare($requete);
      $status = $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $arrReservation = [];
        return $arrReservation;
      }

      while($row = $result->fetch_assoc()){
        // Format le montant
        $montant = $row['montant'];
        $montant = str_pad($montant, 20/*, " ", STR_PAD_RIGHT*/);
        $montantFormat = sprintf("%s%s", $montant, "$");
        $row['montant'] = $montantFormat;

        // Format le datetime
        $daterdv = $row['date_rendez_vous'];
        $daterdvFormat = substr($daterdv, 0, -3);
        $row['date_rendez_vous'] = $daterdvFormat;

        $arrReservation[] = $row;
    }
    return $arrReservation;
  }

  /**
  * Fonction qui permet d'annuler une réservation
  * @param id ID de la réservation à annuler
  */
  public function cancelReservation($id){
    $conn = ($connexion = new Connexion())->do();

    $requete = "UPDATE reservation
                SET id_etat = 2
                WHERE id = ?;";

    $stmt = $conn->prepare($requete);
    $stmt->bind_param("i", $id);
    $status = $stmt->execute();

    if($status === false){
      trigger_error($stmt->error, E_USER_ERROR);
    }

  }



}

 ?>
