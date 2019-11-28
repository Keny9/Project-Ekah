<?php
/**
* Gestionnaire du login
*
* Nom :         GestionLogin
* Catégorie :   Classe
* Auteur :      Maxime Lussier
* Version :     1.2
* Date de la dernière modification : 2019-10-07
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";

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
      return "Courriel existe pas";
    }
  }

  //retourne un array {'l'id de l'utilisateur', 'l'id du type d'utilisateur'}
  public function getUserIdAndUserTypeId($courriel){
    $connexion = new Connexion();
    $conn = $connexion->do();

    $stmt = $conn->prepare("SELECT c.fk_utilisateur, u.id_type_utilisateur
    FROM compte_utilisateur as c
    INNER JOIN utilisateur as u ON u.id = c.fk_utilisateur
    WHERE c.courriel = ?");
    $stmt->bind_param('s', $courriel);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()){
      $array = array($row['fk_utilisateur'], $row['id_type_utilisateur']);
      return $array; // Retourne l'array contenant l'id du user et l'id de son Type
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

  // Retourne le user_type_id
  public function getTypeId($user_id){
    $connexion = new Connexion();
    $conn = $connexion->do();

    $stmt = $conn->prepare("SELECT id_type_utilisateur
                            FROM utilisateur
                            WHERE id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $user_type_id = null;
    if($row = $result->fetch_assoc()){
      $user_type_id = $row['id_type_utilisateur'];
    }
    return $user_type_id;
  }

  // Si le courriel existe, retourne qu'il existe (true).
  // Sinon, retourne false
  public function compteExiste($courriel){
    $conn = ($connexion = new Connexion())->do();

    $stmt = $conn->prepare("SELECT fk_utilisateur
    FROM compte_utilisateur
    WHERE courriel = ?");

    $stmt->bind_param('s', $courriel);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()){
      return true;
    }
    return false;
  }
}
 ?>
