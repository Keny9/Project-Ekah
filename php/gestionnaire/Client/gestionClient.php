<?php
/**
* Gestionnaire client pour obtenir des informations
* Ex: Obtenir toutes les infos d'un client
*
*
* Nom :         gestionClient.php
* Catégorie :   Classe
* Auteur :      Karl Boutin
* Co-Auteur :   Maxime Lussier
* Version :     1.1
* Date de la dernière modification : 2019-10-30
*/

  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
//  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Client/Client.php";

class GestionClient{

  /**
  * Retourne les informations relatives aux clients et nécessaires à la
  * modification de ceux-ci.
  *
  */
  public function getAllClient(){
    $conn = ($connexion = new Connexion())->do();

    $requete = "SELECT u.id,
                u.nom,
                u.prenom,
                u.telephone,
                u.date_inscription,
                u.date_naissance,
                u.fk_id_adresse as 'id_adresse',
                a.no_civique,
                a.rue,
                a.code_postal,
                a.pays,
                a.ville,
                c.courriel FROM utilisateur u
                LEFT JOIN compte_utilisateur c ON u.id = c.fk_utilisateur
                LEFT JOIN adresse AS a ON a.id = u.fk_id_adresse
                WHERE id_type_utilisateur = 1;";

    $stmt = $conn->prepare($requete);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0){
      $arrClient = [];
      return $arrClient;
    }

    while($row = $result->fetch_assoc()){
      $arrClient[] = $row;
    }

    return $arrClient;
  }

  /**
  * Update un client dans la BD selon les infos dans l'array
  *
  */
  public function updateClient($array){
    $conn = ($connexion = new Connexion())->do();
  //  $id_client = $array['id_client'];
  //  $id_adresse = $array['id_adresse'];
  //  $telephone = $array['telephone'];

    // Update l'adresse
    $requete = "UPDATE adresse
                SET ville = ?,
                    no_civique = ?,
                    rue = ?,
                    code_postal = ?,
                    pays = ?
                WHERE id = ?";
    $stmt = $conn->prepare($requete);
    $stmt->bind_param('sssssi', $array['ville'], $array['no_civique'], $array['rue'], $array['code_postal'], $array['pays'], $array['id_adresse']);
    $stmt->execute();


    // Update client

    $requete = "UPDATE utilisateur
                SET telephone = ?,
                    date_naissance = ?
                WHERE id = ?";
    $stmt = $conn->prepare($requete);
    $stmt->bind_param('ssi', $array['telephone'], $array['date_naissance'], $array['id_client']);
    $stmt->execute();

    // Update le compte
    $requete = "UPDATE compte_utilisateur
                SET courriel = ?
                WHERE fk_utilisateur = ?";
    $stmt = $conn->prepare($requete);
    $stmt->bind_param('si', $array['courriel'], $array['id_client']);
    $stmt->execute();

    $date = $array['date_naissance'];
    echo $date;
  }

  /**
  * Update les infos d'un client pour la page "mon-profil"
  *
  * $array  contient les informations nécessaires à l'update
  */
  public function updateMonProfil($array){
    $conn = ($connexion = new Connexion())->do();

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
      $conn->begin_transaction();

      // Crée un enregistrement de l'adresse du Client
      // dans la BD.
      $stmt = $conn->prepare("INSERT INTO adresse
        (no_civique, rue, code_postal, pays, ville)
        VALUES (?, ?, ?, ?, ?);");
        $stmt->bind_param('issss', $noCivique, $rue, $codePostal, $pays, $ville);
        $stmt->execute();

        // Va chercher le primary key de l'adresse précédement enregistrée
        // dans la BD.
        $adresseId = $conn->insert_id;

        // Crée un enregistrement dans la table Utilisateur de la BD
        // pour le Client.
        $stmt = $conn->prepare("INSERT INTO utilisateur
          (id_type_utilisateur, fk_id_adresse, nom, prenom, telephone, date_naissance)
          VALUES (?, ?, ?, ?, ?, ?);");
          $stmt->bind_param('iissss', $idTypeUtilisateur, $adresseId, $nom, $prenom, $telephone, $dateNaissance);
          $stmt->execute();

          // Va chercher le primary key de l'utilisateur précédement enregistrée
          // dans la BD.
          $utilisateurId = $conn->insert_id;


          // Vérifie si le courriel existe dans la BD.
          // Si oui, lance une exception.
          // TODO: Vérifier si cette vérification est nécessaire
          if($this->courrielExisteDeja($courriel)){
            throw new Exception('Le courriel existe déjà.');
          }

          // Crée un enregistrement dans la table Compte_utilisateur de la BD
          // pour le Client.
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

    /**
    * Retourne un array avec les informations d'un client
    *
    * $client_id  est l'id du client à get
    */
    public function getClient($client_id){
      $conn = ($connexion = new Connexion())->do();

      $requete = "SELECT u.id,
                  u.nom,
                  u.prenom,
                  u.telephone,
                  u.date_inscription,
                  u.date_naissance,
                  u.fk_id_adresse as 'id_adresse',
                  a.no_civique,
                  a.rue,
                  a.code_postal,
                  a.pays,
                  a.ville,
                  c.courriel FROM utilisateur u
                  LEFT JOIN compte_utilisateur c ON u.id = c.fk_utilisateur
                  LEFT JOIN adresse AS a ON a.id = u.fk_id_adresse
                  WHERE u.id = ?;";

      $stmt = $conn->prepare($requete);
      $stmt->bind_param('i', $client_id);
      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $arrClient = null;
        return $arrClient;
      }

      while($row = $result->fetch_assoc()){
        $arrClient = $row;
      }

      return $arrClient;
    }

}
 ?>
