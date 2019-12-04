<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/connexion.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Reservation/GestionAffichageReservation.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Horaire/gestionHoraire.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Facilitateur/gestionFacilitateur.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/class/QuestionnaireReservation/questionnaire.php';
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Reservation/Reservation.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Groupe/Groupe.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Client/Client.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Emplacement/Emplacement.php";

$gHoraire = new GestionHoraire();
$gFacilitaeur = new GestionFacilitateur();
$id_facilitateur = -1;

$id_dispo = 20;
$duree = "90";


if($id_facilitateur == -1){ // veut dire pas de facilitateur choisit?? indiquer svp
  $facilitateur = $gFacilitaeur->getDispo($id_dispo);
  $id_facilitateur = $facilitateur->getId(); /*********Ne fonctionne pas si la requete getDispo($id_dispo) retourne rien***************/
}


//Calculer l'heure_fin de la réservation
$dispo = $gHoraire->getDispo($id_dispo);
$heure_fin = date("Y-m-d H:i:s", strtotime($dispo->getHeureDebut() . "+".$duree." minutes"));

//Réserver la disponibilité choisi
$gHoraire->reserverDispo($id_dispo);

$disponibilites = $facilitateur->getDisponibilite();

//Réserver les autres dispo dépendament de la durée
if($duree == "30"){

  $heure_fin = date("Y-m-d H:i:s", strtotime($dispo->getHeureDebut() . "+".$duree." minutes"));
  $heure_debut = date("Y-m-d H:i:s", strtotime($dispo->getHeureDebut() . "-30 minutes"));

  for ($i=0; $i < sizeof($disponibilites); $i++) {
    if($disponibilites[$i]->getHeureDebut() == $heure_fin){           //Réserver 30 minutes après dispo
      $gHoraire->reserverDispo($disponibilites[$i]->getId());
    }else if($disponibilites[$i]->getHeureDebut() == $heure_debut){   //réservé 30 minutes avant dispo
      $gHoraire->reserverDispo($disponibilites[$i]->getId());
    }
  }
}


elseif ($duree == "60") {
  $heure_debut = date("Y-m-d H:i:s", strtotime($dispo->getHeureDebut() . "-30 minutes"));
  $heure_après = date("Y-m-d H:i:s", strtotime($dispo->getHeureDebut() . "+30 minutes"));

  for ($i=0; $i < sizeof($disponibilites); $i++) {
    if($disponibilites[$i]->getHeureDebut() == $heure_fin){           //Réserver la deuxieme dispo (le deuxieme 30 minutes car 1h)
      $gHoraire->reserverDispo($disponibilites[$i]->getId());
    }else if($disponibilites[$i]->getHeureDebut() == $heure_après){   //réservé 30 minutes avant dispo
      $gHoraire->reserverDispo($disponibilites[$i]->getId());
    }else if($disponibilites[$i]->getHeureDebut() == $heure_debut){   //réservé 30 minutes avant dispo
      $gHoraire->reserverDispo($disponibilites[$i]->getId());
    }
  }
}


else if($duree == "90"){
  $heure_dispo_milieu = date("Y-m-d H:i:s", strtotime($dispo->getHeureDebut() . "+30 minutes"));
  $heure_après = date("Y-m-d H:i:s", strtotime($dispo->getHeureDebut() . "+60 minutes"));
  $heure_debut = date("Y-m-d H:i:s", strtotime($dispo->getHeureDebut() . "-30 minutes"));

  for ($i=0; $i < sizeof($disponibilites); $i++) {
    if($disponibilites[$i]->getHeureDebut() == $heure_fin){                 //Réserver 30 minutes après dispo
      $gHoraire->reserverDispo($disponibilites[$i]->getId());
    }else if($disponibilites[$i]->getHeureDebut() == $heure_dispo_milieu){   //Réserver la deuxieme dispo
      $gHoraire->reserverDispo($disponibilites[$i]->getId());
    }else if($disponibilites[$i]->getHeureDebut() == $heure_après){         //Pour réserver la troisième dispo
      $gHoraire->reserverDispo($disponibilites[$i]->getId());
    }else if($disponibilites[$i]->getHeureDebut() == $heure_debut){         //Pour réserver 30 minutes avant une dispo
      $gHoraire->reserverDispo($disponibilites[$i]->getId());
    }
  }
}






 ?>
