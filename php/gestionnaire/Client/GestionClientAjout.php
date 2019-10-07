<?php
/**
* Gestionnaire d'ajout de Client.
* Contient les méthodes nécessaires
* à l'ajout d'un client.
*
* Nom :         GestionClientAjout
* Catégorie :   Classe
* Auteur :      Maxime Lussier
* Version :     1.3
* Date de la dernière modification : 2019-10-07
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Client/Client.php";

class GestionClientAjout{


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


    // Ajoute le client à la BD
    // TODO: Est-ce que la transaction fonctionne?
    public function ajouterClient($client, $motDePasse){
      $conn = new Connexion();

      // Variables pour Adresse
      $noCivique = $client->getNoCivique();
      $rue = $client->getRue();
      $codePostal = $client->getCodePostal();
      $pays = $client->getPays();
      $ville = $client->getVille();
      // Variables pour Utilisateur
      $idTypeUtilisateur = 1;
      $fkIdAdresse;
      $nom = $client->getNom();
      $prenom = $client->getPrenom();
      $telephone = $client->getTelephone();
      $dateNaissance = $client->getDateNaissance();
      // Variables pour Compte_utilisateur
      $utilisateurId;
      $courriel = $client->getCourriel();
      $motDePasseHash = password_hash($motDePasse, PASSWORD_ARGON2ID);;
      try {
        $conn->do()->begin_transaction();

        // Crée un enregistrement de l'adresse du Client
        // dans la BD.
        $stmt = $conn->do()->prepare("INSERT INTO adresse
          (no_civique, rue, code_postal, pays, ville)
          VALUES (?, ?, ?, ?, ?);");
          $stmt->bind_param('issss', $noCivique, $rue, $codePostal, $pays, $ville);
          $stmt->execute();

          // Va chercher le primary key de l'adresse précédement enregistrée
          // dans la BD.
          $adresseId = $conn->do()->insert_id;

          // Crée un enregistrement dans la table Utilisateur de la BD
          // pour le Client.
          $stmt = $conn->do()->prepare("INSERT INTO utilisateur
            (id_type_utilisateur, fk_id_adresse, nom, prenom, telephone, date_naissance)
            VALUES (?, ?, ?, ?, ?, ?);");
            $stmt->bind_param('iissss', $idTypeUtilisateur, $adresseId, $nom, $prenom, $telephone, $dateNaissance);
            $stmt->execute();

            // Va chercher le primary key de l'utilisateur précédement enregistrée
            // dans la BD.
            $utilisateurId = $conn->do()->insert_id;


            // Vérifie si le courriel existe dans la BD.
            // Si oui, lance une exception.
            // TODO: Vérifier si cette vérification est nécessaire
            if($this->courrielExisteDeja($courriel)){
              throw new Exception('Le courriel existe déjà.');
            }

            // Crée un enregistrement dans la table Compte_utilisateur de la BD
            // pour le Client.
            $stmt = $conn->do()->prepare("INSERT INTO compte_utilisateur
              (fk_utilisateur, courriel, mot_de_passe)
              VALUES (?, ?, ?);");
              $stmt->bind_param('iss', $utilisateurId, $courriel, $motDePasseHash);
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
