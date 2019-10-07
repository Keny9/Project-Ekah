<?php
/**
* Gestionnaire du login
*
* Nom :         Login
* Catégorie :   Classe
* Auteur :      Maxime Lussier
* Version :     1.1
* Date de la dernière modification : 2019-10-06
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
//include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Client/Client.php";

class GestionLogin{

  // Vérifie si l'utilisateur existe
  public function utilisateurExiste($courriel, $motDePasse){
    $connexion = new Connexion();
    $conn = $connexion->do();

    // Si le courriel existe
    if(($motDePasseBd = $this->courrielExiste($conn, $courriel)) != null){

      // Si c'est le bon mot de passe
      if($this->bonMotDePasse($motDePasse, $motDePasseBd)){
        return "Bon courriel bon mot de passe";
      }

      // Sinon (bon courriel mauvais mot de passe)
      else{
        return "Bon courriel mauvais mot de passe";
      }
    }

    // Sinon (courriel n'existe pas)
    else{
      return "Courriel n'existe pas";
    }
  }

  //retourne l'id du user
  public function getUserId($courriel){
    $connexion = new Connexion();
    $conn = $connexion->do();
    
    $stmt = $conn->prepare("SELECT fk_utilisateur
    FROM compte_utilisateur
    WHERE courriel = ?");
    $stmt->bind_param('s', $courriel);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()){
      return $row['fk_utilisateur'];
    }
    return null;
  }

  // Si le courriel existe, retourne le mot de passe.
  // Sinon, retourne null
  private function courrielExiste($conn, $courriel){
    $stmt = $conn->prepare("SELECT mot_de_passe
    FROM compte_utilisateur
    WHERE courriel = ?");
    $stmt->bind_param('s', $courriel);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()){
      return $row['mot_de_passe'];
    }
    return null;
  }

  // Retourne si le mot de passe correspond
  private function bonMotDePasse($motDePasseEntree, $motDePasseBd){
    return password_verify($motDePasseEntree, $motDePasseBd);
  }

}
 ?>
