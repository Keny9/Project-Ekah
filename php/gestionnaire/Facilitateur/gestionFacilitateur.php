<?php
/**
* Gestionnaire pour les facilitateurs
* Contient les méthodes nécessaires
* pour gérer les facilitateurs
*
* Nom :         GestionFacilitateur
* Catégorie :   Classe
* Auteur :      Guillaume Côté
* Version :     1.0
* Date de la dernière modification : 2019-10-13
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/disponibilite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Region/Region.php";


class GestionFacilitateur{

  /*
    Retourne un array contenant toutes les disponibilites contenus dans la BD
    (Permet de recevoir les disponibilité à mettre dans le calendrier)
  */
    public function getAllDisponibiliteActive($id){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();
      $activite = null;
      $disponibilite = null;

      $requete= "SELECT * FROM utilisateur
                   INNER JOIN ta_disponibilite_specialiste ON id_specialiste = id
                   INNER JOIN disponibilite ON disponibilite.id = id_disponibilite
                 WHERE id_type_utilisateur = 2 AND id_type_etat_dispo = 1 AND id_etat = 1 AND utilisateur.id = ".$id." AND heure_debut >= now()
                 ORDER BY heure_debut ASC
                ";

      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

          $disponibilite[] = new Disponibilite(
                                  $row['id_disponibilite'],
                                  $row['heure_debut'],
                                  $row['heure_fin'],
                                  $row['id_etat']);
        }
      }
      return $disponibilite;
    }

    /*
      Retourne les disponibilité d'un facilitateurs avec l'id
    */
      public function getDisponibilite($id){
        $tempconn = new Connexion();
        $conn = $tempconn->getConnexion();
        $activite = null;
        $disponibilite = null;

        $requete= "SELECT * FROM utilisateur
                     INNER JOIN ta_disponibilite_specialiste ON id_specialiste = id
                     INNER JOIN disponibilite ON disponibilite.id = id_disponibilite
                   WHERE id_type_utilisateur = 2 AND id_type_etat_dispo = 1 AND utilisateur.id = ".$id." AND id_etat = 1
                  ";

        $result = $conn->query($requete);
        if(!$result){
          trigger_error($conn->error);
        }

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $disponibilite[] = new Disponibilite(
                                    $row['id_disponibilite'],
                                    $row['heure_debut'],
                                    $row['heure_fin'],
                                    $row['id_etat']);
          }
        }
        return $disponibilite;
      }


  /*
    Retourne une liste de tous les facilitateurs qui sont actifs
  */
    public function getAllFacilitateurActif(){

      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();

      $requete= "SELECT * FROM utilisateur
                  INNER JOIN compte_utilisateur ON fk_utilisateur = id
                 WHERE id_type_utilisateur = 2 AND id_type_etat_dispo = 1
                ";

      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $id = $row['id'];
          $disponibilite = $this->getAllDisponibiliteActive($id);
          $facilitateur[] = new Facilitateur(
                                    $id,
                                    $row['nom'],
                                    $row['prenom'],
                                    $row['date_inscription'],
                                    $row['courriel'],
                                    $row['date_naissance'],
                                    $row['telephone'],
                                    "actif",
                                    $disponibilite
                                  );
        }
      }
      return $facilitateur;

    }

    /*
      Retourne une liste de tous les facilitateurs qui sont actifs et qui ont des dispos
    */
      public function getAllFacilitateurActifAvecDispo(){

      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();
      $disponibilite[] = null;

      $requete= "SELECT * FROM `utilisateur`
                  INNER JOIN ta_disponibilite_specialiste ON id_specialiste = utilisateur.id
                  INNER JOIN disponibilite ON id_disponibilite = disponibilite.id
                  INNER JOIN compte_utilisateur ON fk_utilisateur = utilisateur.id

                  WHERE disponibilite.id_etat = 1 AND id_type_utilisateur = 2 AND id_type_etat_dispo = 1
                ";

      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $id = $row['id'];
          $disponibilite = $this->getAllDisponibiliteActive($id);
          $facilitateur[] = new Facilitateur(
                                    $id,
                                    $row['nom'],
                                    $row['prenom'],
                                    $row['date_inscription'],
                                    $row['courriel'],
                                    $row['date_naissance'],
                                    $row['telephone'],
                                    "actif",
                                    $disponibilite
                                  );
        }
      }
      return $facilitateur;

    }

  /*
    Retourne une liste de tous les facilitateurs groupé par id qui sont actifs et qui ont des dispos
  */
    public function getAllFacilitateurActifAvecDispoGroup(){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();
      $disponibilite[] = null;

      $requete= "SELECT utilisateur.id, nom, prenom, date_inscription, date_naissance, telephone, courriel, photo FROM `utilisateur`
                  INNER JOIN ta_disponibilite_specialiste ON id_specialiste = utilisateur.id
                  INNER JOIN disponibilite ON id_disponibilite = disponibilite.id
                  INNER JOIN compte_utilisateur ON fk_utilisateur = utilisateur.id
                  WHERE disponibilite.id_etat = 1 AND id_type_utilisateur = 2 AND id_type_etat_dispo = 1
                  GROUP BY utilisateur.id
                ";

      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }

      if ($result->num_rows > 0) {
        $i = 0;
        while($row = $result->fetch_assoc()) {
          $id = $row['id'];

          $disponibilite = $this->getAllDisponibiliteActive($id);

          if(isset($disponibilite)){
            if(sizeof($disponibilite) > 0){
              $facilitateur[] = new Facilitateur(
                                        $id,
                                        $row['nom'],
                                        $row['prenom'],
                                        $row['date_inscription'],
                                        $row['courriel'],
                                        $row['date_naissance'],
                                        $row['telephone'],
                                        "actif",
                                        $disponibilite
                                      );
              $facilitateur[$i]->setPhoto($row['photo']);
            }
          }
            $i++;
        }
      }

      return $facilitateur;
    }

    /*
      Retourne un facilitateur selon l'id qui as des dispo
    */
      public function getFacilitateurActifAvecDispoGroup($idFacilitateur){

        $tempconn = new Connexion();
        $conn = $tempconn->getConnexion();
        $disponibilite[] = null;

        $requete= "SELECT utilisateur.id, nom, prenom, date_inscription, date_naissance, telephone, courriel, photo FROM utilisateur
                    INNER JOIN ta_disponibilite_specialiste ON id_specialiste = utilisateur.id
                    INNER JOIN disponibilite ON id_disponibilite = disponibilite.id
                    INNER JOIN compte_utilisateur ON fk_utilisateur = utilisateur.id
                    WHERE disponibilite.id_etat = 1 AND id_type_utilisateur = 2 AND id_type_etat_dispo = 1 AND utilisateur.id = '".$idFacilitateur."'
                    GROUP BY utilisateur.id;";

        $result = $conn->query($requete);
        if(!$result){
          trigger_error($conn->error);
        }

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $id = $row['id'];

            $disponibilite = $this->getAllDisponibiliteActive($id);

            if(sizeof($disponibilite) > 0){
              $facilitateur[] = new Facilitateur(
                                        $id,
                                        $row['nom'],
                                        $row['prenom'],
                                        $row['date_inscription'],
                                        $row['courriel'],
                                        $row['date_naissance'],
                                        $row['telephone'],
                                        "actif",
                                        $disponibilite
                                      );
              $facilitateur[0]->setPhoto($row['photo']);
            }
          }
        }

        return $facilitateur;
      }


    /*
      Retourne une liste de tous les facilitateurs
    */
      public function getFacilitateur($id){

        $disponibilite = $this->getDisponibilite($id);

        $tempconn = new Connexion();
        $conn = $tempconn->getConnexion();

        $requete= "SELECT * FROM utilisateur
                    INNER JOIN compte_utilisateur ON fk_utilisateur = id

                   WHERE id_type_utilisateur = 2 AND id_type_etat_dispo = 1 AND id = ".$id."
                  ";

        $result = $conn->query($requete);
        if(!$result){
          trigger_error($conn->error);
        }

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $facilitateur = new Facilitateur(
                                  $id,
                                  $row['nom'],
                                  $row['prenom'],
                                  $row['date_inscription'],
                                  $row['courriel'],
                                  $row['date_naissance'],
                                  $row['telephone'],
                                  "actif",
                                  $disponibilite
                                );
          }
        }
        return $facilitateur;
      }


//Ajoute la disponibilite d'un facilitateur dans la BD
  public function ajouterHoraire($facilitateur, $disponibilite){
    $conn = new Connexion();

    $heure_debut = $disponibilite->getHeureDebut();
    $heure_fin = $disponibilite->getHeureFin();
    $etat = $disponibilite->getEtat();
    $region = $disponibilite->getRegion();

    $idFacilitateur = $facilitateur->getId();
    $regionId = $region->getId();

    try {
      $conn->do()->begin_transaction();

      // Crée un enregistrement de la disponibilite
      // dans la BD.
      $stmt = $conn->do()->prepare("INSERT INTO disponibilite
        (heure_debut, heure_fin, id_etat)
        VALUES (?, ?, ?);");
        $stmt->bind_param('ssi',$heure_debut, $heure_fin, $etat);    //Mettre le bon jour
        $stmt->execute();

        // Va chercher le primary key de la disponibilite précédement enregistrée
        // dans la BD.
        $disponibiliteId = $conn->do()->insert_id;

        // Crée un enregistrement dans la table ta_disponibilite_specialiste de la BD
        $stmt = $conn->do()->prepare("INSERT INTO ta_disponibilite_specialiste
          (id_specialiste, id_disponibilite, id_region)
          VALUES (?, ?, ?);");
          $stmt->bind_param('iii', $idFacilitateur, $disponibiliteId, $regionId);
          $stmt->execute();

        // Commit la transaction
        $conn->do()->commit();
        return true;
      } catch (Exception $e) {
        // Rollback la transaction
        $conn->do()->rollback();
        echo "Erreur try-catch : ".$e."<br>";
        return false;
      }
    }


//recevoir l'id d'une disponibilité avec le facilitateur et la disponibilité sans id
  public function getIdDisponibilite($facilitateur, $disponibilite){

    $connexion = new Connexion();
    $conn = $connexion->do();
    $out = NULL;
    $idFacilitateur = $facilitateur->getId();
    $heure_debut = $disponibilite->getHeureDebut();
    $heure_fin = $disponibilite->getHeureFin();
    $id_etat = $disponibilite->getEtat();


    $stmt = $conn->prepare("SELECT disponibilite.id FROM disponibilite
                              INNER JOIN ta_disponibilite_specialiste ON id_disponibilite = disponibilite.id
                              INNER JOIN utilisateur ON utilisateur.id = id_specialiste
                            WHERE utilisateur.id = ? AND heure_debut =? AND id_etat = 1 ");
    $stmt->bind_param('is', $idFacilitateur, $heure_debut);
    $stmt->execute();
    $result = $stmt->get_result();

    if($row = $result->fetch_assoc()){
      $out = new Disponibilite($row['id'],
                              $heure_debut,
                              $heure_fin,
                              $id_etat);
                            }
    return $out;
  }


  //Supprimer une disponibilité d'un utilisateur
    public function supprimerDisponibilite($disponibilite){
      $id = $disponibilite->getId();

      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();

      $requete= "UPDATE disponibilite
                  SET id_etat = 3
                 WHERE id = ".$id." AND id_etat = 1 ;";

      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }
    }

    //Retourne un facilitateur avec l'id de sa dispo
    public function getDispo($id){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();

      //Il manque le WHERE facilitateur actif
      $requete= "SELECT * FROM utilisateur
                   INNER JOIN ta_disponibilite_specialiste ON id_specialiste = id
                   INNER JOIN compte_utilisateur ON fk_utilisateur = id
                   WHERE id_disponibilite = '".$id."' AND id_type_utilisateur = 2;";

      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }

      $disponibilite = null;

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $facilitateur = new Facilitateur(
                                $row['id'],  /*********Juste id ? Serveur web: erreur undefined index utilisateur.id*************/
                                $row['nom'],
                                $row['prenom'],
                                $row['date_inscription'],
                                $row['courriel'],
                                $row['date_naissance'],
                                $row['telephone'],
                                "actif",
                                $disponibilite
                              );
        }
      }
      return $facilitateur;
    }

    //Retourne une liste de toutes les régions
    public function getRegion(){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();
      $region = null;

      $requete= "SELECT * FROM region";

      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $region[] = new Region(
                                    $row['id'],
                                    $row['nom']
                                  );
        }
      }
      return $region;
    }

    //Retourne la region avec id
    public function getRegionId($id){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();
      $region = null;

      $requete= "SELECT * FROM region WHERE id = ".$id."";

      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $region = new Region(
                                $row['id'],
                                $row['nom']
                              );
        }
      }
      return $region;
    }

    /**
    * Permet d'obtenir tous les facilitateurs faisant partie de la base de donnée
    */
    public function getAllFacilitateur(){
      $conn = ($connexion = new Connexion())->do();

      $requete = "SELECT u.id, u.nom, u.prenom, u.telephone, c.courriel, e.nom AS etat FROM utilisateur AS u
                  INNER JOIN compte_utilisateur c ON c.fk_utilisateur = u.id
                  INNER JOIN etat_disponible e ON e.id = u.id_type_etat_dispo
                  WHERE id_type_utilisateur = 2;";

      $stmt = $conn->prepare($requete);
      $status = $stmt->execute();
      $result = $stmt->get_result();

      if($status === false){
        trigger_error($stmt->error, E_USER_ERROR);
      }

      if($result->num_rows == 0){
        $arrFacilitateur = [];
        return $arrFacilitateur;
      }

      while($row = $result->fetch_assoc()){
        $arrFacilitateur[] = $row;
      }

      return $arrFacilitateur;
    }

    /**
    * Fonction permettant d'ajouter un facilitateurs
    * Particularité de la fonction: crée un facilitateur avec seulement les champs requis
    * - nom, prenom, telephone, courriel, mot de passe
    */
    public function addFacilitateur($facilitateur, $motDePasse){
      $conn = ($connexion = new Connexion())->do();

      // Variables pour Adresse
      $noCivique = null;
      $rue = null;
      $codePostal = null;
      $pays = null;
      $ville = null;

      // Variables pour Utilisateur
      $idTypeUtilisateur = 2;
      $idTypeEtat = 1;
      $fkIdAdresse;
      $nom = $facilitateur->getNom();
      $prenom = $facilitateur->getPrenom();
      $telephone = $facilitateur->getTelephone();
      $dateNaissance = $facilitateur->getDateNaissance();

      // Variables pour Compte_utilisateur
      $utilisateurId;
      $courriel = $facilitateur->getCourriel();
      $motDePasseHash = password_hash($motDePasse, PASSWORD_ARGON2I);

      try {
        $conn->begin_transaction();

        // Crée un enregistrement de l'adresse du Facilitateur dans la BD.
        $stmt = $conn->prepare("INSERT INTO adresse
          (no_civique, rue, code_postal, pays, ville)
          VALUES (?, ?, ?, ?, ?);");
        $stmt->bind_param('issss', $noCivique, $rue, $codePostal, $pays, $ville);
        $stmt->execute();

        // Va chercher le primary key de l'adresse précédement enregistrée dans la BD.
        $adresseId = $conn->insert_id;

        // Crée un enregistrement dans la table Utilisateur de la BD pour le facilitateur.
        $stmt = $conn->prepare("INSERT INTO utilisateur
          (id_type_utilisateur, id_type_etat_dispo, fk_id_adresse, nom, prenom, telephone, date_naissance)
          VALUES (?, ?, ?, ?, ?, ?, ?);");
        $stmt->bind_param('iiissss', $idTypeUtilisateur, $idTypeEtat, $adresseId, $nom, $prenom, $telephone, $dateNaissance);
        $stmt->execute();

        // Va chercher le primary key de l'utilisateur précédement enregistrée dans la BD.
        $utilisateurId = $conn->insert_id;

        // Vérifie si le courriel existe dans la BD.
        // Si oui, lance une exception.
        if($this->courrielExisteDeja($courriel)){
          throw new Exception('Le courriel existe déjà.');
        }

        // Crée un enregistrement dans la table Compte_utilisateur de la BD
        // pour le Facilitateur.
        $stmt = $conn->prepare("INSERT INTO compte_utilisateur
          (fk_utilisateur, courriel, mot_de_passe)
          VALUES (?, ?, ?);");
        $stmt->bind_param('iss', $utilisateurId, $courriel, $motDePasseHash);
        $stmt->execute();

        // Commit la transaction
        $conn->commit();
        return true;
      } catch (Exception $e) {
        // Rollback la transaction
        $conn->rollback();
        echo "Erreur try-catch : ".$e."<br>";
        return false;
      }
    }

    //Retourne vrai si le courriel en paramètre existe dans la BD
    public function courrielExisteDeja($courriel){
      $conn = new Connexion();

      $stmt = $conn->do()->prepare("SELECT fk_utilisateur
        FROM compte_utilisateur
        WHERE courriel = ?");
        $stmt->bind_param('s', $courriel);

        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
          $stmt->close();
          return true;
        }
        else{
          $stmt->close();
          return false;
        }

        $stmt->close();
      }

  }

 ?>
