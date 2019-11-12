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

   if (session_status() === PHP_SESSION_NONE){session_start();}

   $idFacilitateur = null;
   $annee = null;
   $mois = null;
   $jour = null;
   $heure_debut = null;
   $heure_fin = null;

   $idFacilitateur = $_SESSION['logged_in_user_id'];
   $annee = $_POST['annee'];
   $mois = $_POST['mois'];
   $jour = $_POST['jour'];
   $heure_debut = $_POST['heure_debut'];
   $heure_fin = $_POST['heure_fin'];

   // $annee = "2019";
   // $mois = "11";
   // $jour = "14";
   // $heure_debut = "11:30";
   // $heure_fin = "12:00";

   echo $annee . "-" . $mois . "-" . $jour . " " . $heure_debut . ":00";

  // $idFacilitateur = 3;      //TEST AVEC LE PREMIER Facilitateur


  $gestionFacilitateur = new GestionFacilitateur();
  $facilitateur = $gestionFacilitateur->getFacilitateur($idFacilitateur);
  // print_r($facilitateur->getDisponibilite());

  //Mettre les dates dans le bon format
  $date_debut = $annee . "-" . $mois . "-" . $jour . " " . $heure_debut . ":00";
  $date_fin = $annee . "-" . $mois . "-" . $jour . " " . $heure_fin . ":00";

  echo $date_debut;
  echo $date_fin;

  //Créer la disponibilité et l'ajouter dans la BD
  $disponibilite = new Disponibilite(null, $date_debut, $date_fin, 1);

  echo "<br />";

  //print_r($facilitateur);

  print_r($disponibilite);

  echo "<br />";
  echo $facilitateur->getId();

  echo "<br />";

  echo $gestionFacilitateur->ajouterHoraire($facilitateur, $disponibilite);

 ?>
