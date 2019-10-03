<?php
/**
* Gestionnaire d'ajout de Client.
* Contient les méthodes nécessaires
* à l'ajout d'un client.
*
* Nom :         GestionClientAjout
* Catégorie :   Classe
* Auteur :      Maxime Lussier
* Version :     1.0
* Date de la dernière modification : 2019-10-03
*/

$path = $_SERVER['DOCUMENT_ROOT']."/project_ekah_git/Project-Ekah/utils/connexion.php";
include_once $path;
$path = $_SERVER['DOCUMENT_ROOT']."/project_ekah_git/Project-Ekah/php/class/Individu/Utilisateur/Client/Client.php";
include_once $path;

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

    public function ajouterClient($client){
      $conn = new Connexion();

      $stmt = $conn->do()->prepare("INSERT INTO fk_utilisateur
        FROM compte_utilisateur
        WHERE courriel = ?");
        $stmt->bind_param('s', $courriel);
    }




  }
  ?>
