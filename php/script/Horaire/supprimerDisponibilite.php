<?php
  /**
   * Fait appel à la méthode getDisponibiliteFacilitateur
   *
   * Nom :         supprimerDisponibilite
   * Catégorie :   scriptPhp
   * Auteur :      Guillaume Côté
   * Version :     1.0
   * Date de la dernière modification : 2019-10-15
   */

   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Horaire/gestionHoraire.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Facilitateur/gestionFacilitateur.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Disponibilite.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";

   $idFacilitateur = null;
   $annee = null;
   $mois = null;
   $jour = null;
   $heure_debut = null;
   $heure_fin = null;

//   if(isset($_POST['idFacilitateur'])) {$idFacilitateur = $_POST['idFacilitateur'];}
   if(isset($_POST['annee'])) {$annee = $_POST['annee'];}
   if(isset($_POST['mois'])) {$mois = $_POST['mois'];}
   if(isset($_POST['jour'])) {$jour = $_POST['jour'];}

   if(isset($_POST['heure_debut'])) {$heure_debut = $_POST['heure_debut'];}
   if(isset($_POST['heure_fin'])) {$heure_fin = $_POST['heure_fin'];}

   // $annee = "2019";
   // $mois = "10";
   // $jour = "14";
   // $heure_debut = "11:30";
   // $heure_fin = "13:00";

   echo $annee . "-" . $mois . "-" . $jour . " " . $heure_debut . ":00";

  $idFacilitateur = 1;      //TEST AVEC LE PREMIER Facilitateur


  $gestionFacilitateur = new GestionFacilitateur();
  $facilitateur = $gestionFacilitateur->getFacilitateur($idFacilitateur);
  // print_r($facilitateur->getDisponibilite());

  //Mettre les dates dans le bon format
  $date_debut = $annee . "-" . $mois . "-" . $jour . " " . $heure_debut . ":00";
  $date_fin = $annee . "-" . $mois . "-" . $jour . " " . $heure_fin . ":00";

  echo $date_debut;
  echo $date_fin;

  //Créer la disponibilité et l'ajouter dans la BD
  $disponibilite = new Disponibilite(null, $date_debut, $date_fin);

  echo "<br />";

  //print_r($facilitateur);

  print_r($disponibilite);

  echo "<br />";
  echo $facilitateur->getId();

  echo "<br />";

  echo $gestionFacilitateur->ajouterHoraire($facilitateur, $disponibilite);

 ?>
