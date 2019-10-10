<?php
/**
* Gestionnaire pour les horaires
* Contient les méthodes nécessaires
* aux fonctionnements de l'horaire
*
* Nom :         GestionHoraire
* Catégorie :   Classe
* Auteur :      Guillaume Côté
* Version :     1.0
* Date de la dernière modification : 2019-10-07
*/

class GestionHoraire{

  /*
    Retourne un array contenant toutes les réservations contenus dans la BD
    Prend des critères de recherche en paramètres.
    Le paramètre doit être 'null' s'il ne contient pas de critère de recherche
  */
    public function getAllReservation(){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();
      $activite = null;

      $requete= "SELECT * FROM reservation";

      $result = $conn->query($requete);
      if(!$result){
        trigger_error($conn->error);
      }

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $activite[] = new Activite( $row['identifiant'],
                                    $row['id_type_activite'],
                                    $row['nom'],
                                    $row['description_breve'],
                                    $row['description_longue']);
        }
      }

      return $activite;
    }




 ?>
