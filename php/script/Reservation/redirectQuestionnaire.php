<?php
/**
* Redirect la page de réservation selon le service choisit
*
* Nom :         redirectQuestionnaire
* Catégorie :   scriptPhp
* Auteur :      Maxime Lussier
* Version :     1.1
* Date de la dernière modification : 2019-12-03
*/
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/connexion.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Reservation/GestionAffichageReservation.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Horaire/GestionHoraire.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Facilitateur/GestionFacilitateur.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/class/QuestionnaireReservation/Questionnaire.php';
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Reservation/Reservation.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Groupe/Groupe.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Client/Client.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Emplacement/Emplacement.php";
require $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/stripe-php-7.13.0/vendor/autoload.php';

if (session_status() === PHP_SESSION_NONE){session_start();}


\Stripe\Stripe::setApiKey('sk_test_NZqmLN0M3rIysRWEpo5xza8J00PZodFzrb');

$id_activite =      $_SESSION['id_activite'];
$date_rendez_vous = $_SESSION['date_rendez_vous'];
$id_facilitateur =  $_SESSION['id_facilitateur'];
$id_dispo =         $_SESSION['id_dispo'];
$no_adresse =       $_SESSION['no_adresse'];
$rue =              $_SESSION['rue'];
$ville =            $_SESSION['ville'];
$duree =            $_SESSION['duree'];
$id_region =        $_SESSION['id_region'];
$prix =             $_SESSION['prix'];
$client =           $_SESSION['client'];

unset($_SESSION['id_activite']);
unset($_SESSION['date_rendez_vous']);
unset($_SESSION['id_facilitateur']);
unset($_SESSION['id_dispo']);
unset($_SESSION['no_adresse']);
unset($_SESSION['rue']);
unset($_SESSION['ville']);
unset($_SESSION['duree']);
unset($_SESSION['id_region']);
unset($_SESSION['prix']);
unset($_SESSION['client']);

$gReservation =           new GestionReservation();
$gAffichageReservation =  new GestionAffichageReservation();
$gHoraire =               new GestionHoraire();
$gFacilitaeur =           new GestionFacilitateur();

$questionnaireArray;
$questionnaire;
$id_paiement;
$id_emplacement;
$groupe = new Groupe(null, 1, null, null, 1);
$type_paiement_id = 1;
$now = date('Y-m-d H:i:s');

try { // Bloc de paiement
  $token = $_POST['token'];
  $client_courriel = $client['courriel'];

  $charge = \Stripe\Charge::create([
      'amount' => $prix,
      'currency' => 'cad',
      'description' => 'Facturation d\'une réservation',
      'source' => $token,
      'receipt_email' => $client_courriel,
  ]);

} catch (Exception $e) {
  echo 'Status is: ' . $e->getHttpStatus() . '<br>';
  echo 'Type is: ' . $e->getError()->type . '<br>';
  echo 'Code is: ' . $e->getError()->code . '<br>';
  echo 'Param is: ' . $e->getError()->param . '<br>';
  echo 'Message is: ' . $e->getError()->message . '<br>';
  exit();
}
$_SESSION['recu_paiement_url'] = $charge['receipt_url'];
$recu_url = $charge['receipt_url'];

//Insert paiement
$conn = ($connexion = new Connexion())->do();
$requ = "INSERT INTO paiement (id_type_paiement, montant, date_paiement, recu_url)
VALUES (?,?,?,?)";
$stmt = $conn->prepare($requ);
$stmt->bind_param('iiss', $type_paiement_id, $prix, $now, $recu_url);
$stmt->execute();
$id_paiement = $conn->insert_id;


if($id_facilitateur == -1){ // Aucun facilitateur choisi
  $facilitateur = $gFacilitaeur->getDispo($id_dispo);
  $id_facilitateur = $facilitateur->getId(); /*********Ne fonctionne pas si la requete getDispo($id_dispo) retourne rien***************/
}

// Set l'id de l'emplacement
$id_emplacement = null;
if(!empty($no_adresse) && !empty($rue) && !empty($ville)){ // Champs remplis, donc service 'À domicile'; requiert un emplacement
  $id_emplacement = $gReservation->insertEmplacement($no_adresse, $rue, $ville);
}

//Calculer l'heure_fin de la réservation
$dispo = $gHoraire->getDispo($id_dispo);
$heure_fin = date("Y-m-d H:i:s", strtotime($dispo->getHeureDebut() . "+".$duree." minutes"));

// Créer la réservation
$reservation = new Reservation(null, $id_paiement, $id_emplacement, null, $id_activite, null, $date_rendez_vous, $id_region, $heure_fin, $id_facilitateur);
// Insert la reservation et get l'id de son suivi
$suivi_id = $gReservation->insertReservationIndividuelle($groupe, $reservation, $_SESSION['logged_in_user_id']);



  //Réserver la disponibilité choisi
  $gHoraire->reserverDispo($id_dispo);
  $disponibilites = $facilitateur->getDisponibilite();

  //Réserver les autres dispo dépendament de la durée
  $heure_debut = date("Y-m-d H:i:s", strtotime($dispo->getHeureDebut() . "-30 minutes"));

  if($duree == "30"){
    for ($i=0; $i < sizeof($disponibilites); $i++) {
      if($disponibilites[$i]->getHeureDebut() == $heure_fin){           //Réserver 30 minutes après dispo
        $gHoraire->reserverDispo($disponibilites[$i]->getId());
      }else if($disponibilites[$i]->getHeureDebut() == $heure_debut){   //réservé 30 minutes avant dispo
        $gHoraire->reserverDispo($disponibilites[$i]->getId());
      }
    }
  }else if ($duree == "60") {
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
  }else if($duree == "90"){
    $heure_dispo_milieu = date("Y-m-d H:i:s", strtotime($dispo->getHeureDebut() . "+30 minutes"));
    $heure_après = date("Y-m-d H:i:s", strtotime($dispo->getHeureDebut() . "+60 minutes"));

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

 // L'activité ne contient pas de questionnaire
 if(($questionnaireArray = $gReservation->questionnaireSelectAllWithActiviteId($id_activite)) == null){

 }

// L'activité contient un questionnaire

  $questionnaire = $questionnaireArray[0];


$_SESSION['questionnaire'] = $questionnaire;

header('Location: /Project-Ekah/affichage/client/questionnaire.php?res_id='.$suivi_id);
?>
