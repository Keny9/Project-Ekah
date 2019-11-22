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

   $idFacilitateur = $_POST['idFacilitateur'];
   if(isset($_POST['annee'])) {$annee = $_POST['annee'];}
   if(isset($_POST['mois'])) {$mois = $_POST['mois'];}
   if(isset($_POST['jour'])) {$jour = $_POST['jour'];}

   if(isset($_POST['heure_debut'])) {$heure_debut = $_POST['heure_debut'];}
   if(isset($_POST['heure_fin'])) {$heure_fin = $_POST['heure_fin'];}

   if($idFacilitateur == null){
     $idFacilitateur = $_SESSION['logged_in_user_id'];
   }

   // $annee = "2019";
   // $mois = "10";
   // $jour = "11";
   // $heure_debut = "07:00";
   // $heure_fin = "07:30";

  $gestionFacilitateur = new GestionFacilitateur();
  $facilitateur = $gestionFacilitateur->getFacilitateur($idFacilitateur);
  // print_r($facilitateur->getDisponibilite());

  //Mettre les dates dans le bon format
  $date_debut = $annee . "-" . $mois . "-" . $jour . " " . $heure_debut . ":00";
  $date_fin = $annee . "-" . $mois . "-" . $jour . " " . $heure_fin . ":00";

  // echo $date_debut;
  // echo $date_fin;
  // echo "<br />";

  $disponibilite = new Disponibilite(null, $date_debut, $date_fin, 1);

  $disponibilite = $gestionFacilitateur->getIdDisponibilite($facilitateur, $disponibilite);
  // print_r($disponibilite);

  // print_r($id[0]);
  // echo "<br />";

  $gestionFacilitateur->supprimerDisponibilite($disponibilite);

  // echo $disponibilite->getID();

 ?>
