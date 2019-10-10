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

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/disponibilite.php";


class GestionHoraire{

  /*
    Retourne un array contenant toutes les disponibilites contenus dans la BD
    (Permet de recevoir les disponibilité à mettre dans le calendrier)
  */
    public function getAllDisponibilite(){
      $tempconn = new Connexion();
      $conn = $tempconn->getConnexion();
      $activite = null;

      //Il manque le WHERE facilitateur actif
      $requete= "SELECT * FROM utilisateur
                   INNER JOIN ta_disponibilite_specialiste ON id_specialiste = id
                   INNER JOIN disponibilite ON disponibilite.id = id_disponibilite

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
      Retourne un array contenant toutes les disponibilites contenus dans la BD
      (Permet de recevoir les disponibilité à mettre dans le calendrier)
    */
      public function getDisponibiliteFacilitateur($facilitateur){
        $tempconn = new Connexion();
        $conn = $tempconn->getConnexion();
        $activite = null;

        //Il manque le WHERE facilitateur actif
        $requete= "SELECT * FROM utilisateur
                     INNER JOIN ta_disponibilite_specialiste ON id_specialiste = id
                     INNER JOIN disponibilite ON disponibilite.id = id_disponibilite
                   WHERE id_specialiste = ."$facilitateur->getId()
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

}

 ?>
