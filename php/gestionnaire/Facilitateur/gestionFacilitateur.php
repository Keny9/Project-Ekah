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


class GestionFacilitateur{

  /*
    Retourne un array contenant toutes les disponibilites contenus dans la BD
    (Permet de recevoir les disponibilité à mettre dans le calendrier)
  */
    public function getAllDisponibilite(){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();
      $activite = null;

      $requete= "SELECT * FROM utilisateur
                   INNER JOIN ta_disponibilite_specialiste ON id_specialiste = id
                   INNER JOIN disponibilite ON disponibilite.id = id_disponibilite
                 WHERE id_type_utilisateur = 2 AND id_type_etat_dispo = 1
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
                                    $row['heure_fin']);
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

        $requete= "SELECT * FROM utilisateur
                     INNER JOIN ta_disponibilite_specialiste ON id_specialiste = id
                     INNER JOIN disponibilite ON disponibilite.id = id_disponibilite
                   WHERE id_type_utilisateur = 2 AND id_type_etat_dispo = 1 AND utilisateur.id = ".$id."
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
                                      $row['heure_fin']);
          }
        }
        return $disponibilite;
      }


  /*
    Retourne une liste de tous les facilitateurs qui sont actifs
  */
    public function getAllFacilitateurActif(){

      $disponibilite = $this->getAllDisponibilite();

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
          $facilitateur[] = new Facilitateur(
                                    $row['id'],
                                    $row['nom'],
                                    $row['prenom'],
                                    $row['date_inscription'],
                                    $row['date_naissance'],
                                    $row['telephone'],
                                    "actif",
                                    $row['telephone'],
                                    $disponibilite
                                  );
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
                                  $row['id'],
                                  $row['nom'],
                                  $row['prenom'],
                                  $row['date_inscription'],
                                  $row['date_naissance'],
                                  $row['telephone'],
                                  "actif",
                                  $row['telephone'],
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

    $idFacilitateur = $facilitateur->getId();

    $jour = 1;

    try {
      $conn->do()->begin_transaction();

      // Crée un enregistrement de la disponibilite
      // dans la BD.
      $stmt = $conn->do()->prepare("INSERT INTO disponibilite
        (id_jour, heure_debut, heure_fin)
        VALUES (?, ?, ?);");
        $stmt->bind_param('iss', $jour, $heure_debut, $heure_fin);    //Mettre le bon jour
        $stmt->execute();

        // Va chercher le primary key de la disponibilite précédement enregistrée
        // dans la BD.
        $disponibiliteId = $conn->do()->insert_id;

        // Crée un enregistrement dans la table ta_disponibilite_specialiste de la BD
        $stmt = $conn->do()->prepare("INSERT INTO ta_disponibilite_specialiste
          (id_specialiste, id_disponibilite)
          VALUES (?, ?);");
          $stmt->bind_param('ii', $idFacilitateur, $disponibiliteId);
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

  }

 ?>