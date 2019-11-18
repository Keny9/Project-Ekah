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
                    date_naissance = ?";
    // Dans le cas d'une modification sur la page Mon-Profil,
    // Celle-ci permet de modifier son nom et son prénom, contrairement à la page de modification des clients pour les admins.
    if(isset($array['nom']) && isset($array['prenom'])){
      $requete .= ", nom = ?, prenom = ?";
    }
    $requete .= " WHERE id = ?";
    $stmt = $conn->prepare($requete);
    // Encore pour différention si ça vient de mon-profil ou du gestionnaire des clients
    if(isset($array['nom']) && isset($array['prenom'])){
      $stmt->bind_param('ssssi', $array['telephone'], $array['date_naissance'], $array['nom'], $array['prenom'], $array['id_client']);
    }
    else{
      $stmt->bind_param('ssi', $array['telephone'], $array['date_naissance'], $array['id_client']);
    }
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
