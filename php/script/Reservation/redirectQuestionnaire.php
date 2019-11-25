<?php
/**
 * Redirect la page de réservation selon le service choisit
 *
 * Nom :         redirectQuestionnaire
 * Catégorie :   scriptPhp
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-14
 */
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

 if (session_status() === PHP_SESSION_NONE){session_start();}

$paiement_effectue = true;

/****   BLOC POUR LE PAIEMENT ****/
require $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/stripe-php-7.13.0/vendor/autoload.php';
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey('sk_test_NZqmLN0M3rIysRWEpo5xza8J00PZodFzrb');

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];
$prix = $_POST['total'];
$charge = \Stripe\Charge::create([
    'amount' => $prix,
    'currency' => 'cad',
    'description' => 'Example charge',
    'source' => $token,
]);
$_SESSION['recu_paiement_url'] = $charge['receipt_url'];

/****   FIN BLOC PAIEMENT  ****/

if($paiement_effectue == true){
  $gReservation = new GestionReservation();
  $gAffichageReservation = new GestionAffichageReservation();
  $gHoraire = new GestionHoraire();
  $gFacilitaeur = new GestionFacilitateur();

  $questionnaireArray = null;
  $questionnaire = null;

  // Init les variables
  $groupe = new Groupe(null, 1, null, null, 1);
  $id_activite = $_SESSION['id_activite'];
  $date_rendez_vous = $_SESSION['date_rendez_vous'];
  $id_facilitateur = $_SESSION['id_facilitateur'];
  $id_dispo = $_SESSION['id_dispo'];
  $no_adresse = $_SESSION['no_adresse'];
  $rue = $_SESSION['rue'];
  $ville = $_SESSION['ville'];
  $duree = $_SESSION['duree'];
  $id_region = $_SESSION['id_region'];
  $type_paiement_id = 1;
  $now = date('Y-m-d H:i:s');
  $recu_url = $charge['receipt_url'];

  //Insert paiement
  $conn = ($connexion = new Connexion())->do();
  $requ = "INSERT INTO paiement (id_type_paiement, montant, date_paiement, recu_url)
          VALUES (?,?,?,?)";
  $stmt = $conn->prepare($requ);
  $stmt->bind_param('iiss', $type_paiement_id, $prix, $now, $recu_url);
  $stmt->execute();
  $id_paiement = $conn->insert_id;


  if($id_facilitateur == -1){ // veut dire pas de facilitateur choisit?? indiquer svp
    $facilitateur = $gFacilitaeur->getDispo($id_dispo);
    $id_facilitateur = $facilitateur->getId(); /*********Ne fonctionne pas si la requete getDispo($id_dispo) retourne rien***************/
  }

 // Set l'id de l'emplacement
  $id_emplacement = null;
  if(isset($no_adresse) && isset($rue) && isset($ville)){ // Champs remplis, donc service 'À domicile'; requiert un emplacement
    $id_emplacement = $gReservation->insertEmplacement($no_adresse, $rue, $ville);
  }



 //Calculer l'heure_fin de la réservation
 $dispo = $gHoraire->getDispo($id_dispo);
 $heure_fin = date("Y-m-d H:i:s", strtotime($dispo->getHeureDebut() . "+".$duree." minutes"));


  // Créer la réservation
  $reservation = new Reservation(null, $id_paiement, $id_emplacement, null, $id_activite, null, $date_rendez_vous, $id_region, $heure_fin, $id_facilitateur);
  // Insert la reservation et get l'id de son suivi
  $suivi_id = $gReservation->insertReservationIndividuelle($groupe, $reservation, $_SESSION['logged_in_user_id']);

 //Réserver la disponibilité
   $gHoraire->reserverDispo($id_dispo);

 // L'activité ne contient pas de questionnaire
 if(($questionnaireArray = $gReservation->questionnaireSelectAllWithActiviteId($id_activite)) == null){
   echo "Il n'y a pas de questionnaire pour cette activité\n";
   echo "Réservation complétée";

   // Redirect
 }

// L'activité contient un questionnaire
   $questionnaire = $questionnaireArray[0];
   $_SESSION['questionnaire'] = $questionnaire;

   header('Location: /Project-Ekah/affichage/client/questionnaire.php?res_id='.$suivi_id);

}
else{ // Le payement n'est pas effectué
  echo "Le paiement n'est pas effectuée";

  // redirect
}
 ?>
