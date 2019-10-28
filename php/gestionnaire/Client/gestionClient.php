<?php
/**
* Gestionnaire client pour obtenir des informations
* Ex: Obtenir toutes les infos d'un client
*
*
* Nom :         gestionClient.php
* Catégorie :   Classe
* Auteur :      Karl Boutin
* Version :     1.0
* Date de la dernière modification : 2019-10-07
*/

  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Client/Client.php";

class GestionClient{

  // Méthode pour obtenir toutes les clients
  public function getAllClient(){
    $conn = ($connexion = new Connexion())->do();

    $requete = "SELECT u.id, u.nom, u.prenom, u.telephone, u.date_inscription, c.courriel FROM utilisateur u
                LEFT JOIN compte_utilisateur c ON u.id = c.fk_utilisateur
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

}
 ?>
