<?php
  /**
   * Fait appel à la méthode getDisponibiliteFacilitateur
   *
   * Nom :         ajouterDisponibilite
   * Catégorie :   scriptPhp
   * Auteur :      Guillaume Côté
   * Version :     1.0
   * Date de la dernière modification : 2019-10-14
   */

   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Horaire/gestionHoraire.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Facilitateur/GestionFacilitateur.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Disponibilite.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Region/Region.php";

   if (session_status() === PHP_SESSION_NONE){session_start();}

   $idFacilitateur = null;
   $annee = null;
   $mois = null;
   $jour = null;
   $heure_debut = null;
   $heure_fin = null;
   $regionid = null;

   $idFacilitateur = $_POST['idFacilitateur'];
   if($idFacilitateur == null){
     $idFacilitateur = $_SESSION['logged_in_user_id'];
   }

   $annee = $_POST['annee'];
   $mois = $_POST['mois'];
   $jour = $_POST['jour'];
   $heure_debut = $_POST['heure_debut'];
   $heure_fin = $_POST['heure_fin'];
   $regionid = $_POST['region'];

   if($regionid == 0){
     $regionid = 1;
   }

   // $annee = "2019";
   // $mois = "11";
   // $jour = "28";
   // $heure_debut = "11:30";
   // $heure_fin = "12:00";
   // $regionid = 1;

   // echo $annee . "-" . $mois . "-" . $jour . " " . $heure_debut . ":00";


  $gestionFacilitateur = new GestionFacilitateur();
  $facilitateur = $gestionFacilitateur->getFacilitateur($idFacilitateur);

  // print_r($facilitateur->getDisponibilite());

  //Mettre les dates dans le bon format
  $date_debut = $annee . "-" . $mois . "-" . $jour . " " . $heure_debut . ":00";
  $date_fin = $annee . "-" . $mois . "-" . $jour . " " . $heure_fin . ":00";


  //Créer la disponibilité et l'ajouter dans la BD
  $disponibilite = new Disponibilite(null, $date_debut, $date_fin, 1);
  $region = $gestionFacilitateur->getRegionId($regionid);
  $disponibilite->setRegion($region);

  // echo "<br />";

  //print_r($facilitateur);

  // print_r($disponibilite);

  // echo "<br />";
  // echo $facilitateur->getId();
  //
  // echo "<br />";

  // print_r($disponibilite);

  echo $gestionFacilitateur->ajouterHoraire($facilitateur, $disponibilite);

 ?>
