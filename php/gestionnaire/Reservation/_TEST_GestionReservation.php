<?php
include_once 'GestionReservation.php';



$gestionReservation = new GestionReservation();
//$reservation = $gestionReservation->selectReservation(1);

/*$no_groupe = null;
$id_type_groupe = 1;
$nom_entreprise = "Sherweb";
$nom_organisateur = "Monsieur kokokiki";
$nb_participant = 2;

$groupe = new Groupe(null, $id_type_groupe, $nom_entreprise,
                     $nom_organisateur, $nb_participant);

$heure_debut = 13;
$heure_fin = 12;
$date_rendez_vous = "2019-01-01";

$reservation = new Reservation(null, null, null, null, null, null, $date_rendez_vous, $heure_debut, $heure_fin);*/
/*if(isset($reservation)){
  $reservation->print();
}
else{
  echo "\$reservaton is not set";
}*/

/*
  TEST insert reservation individuelle
*/
/*$client = new Client(1, "Test", "Client", "2019-01-03",
 "client@test.ca", "1996-09-01", 2341237869,
"Boukina", "j1n-2u5", "123", "Sherbrooke", "Québec", "1", "Canada");
$emplacement = new Emplacement(null, 1, "4000 rue MickeyBOOM");

$gestionReservation->insertReservationIndividuelle($groupe, $reservation, $client, $emplacement);*/

//$gestionReservation->groupeSelectAll();

/*$tous_les_groupes = $gestionReservation->groupeSelectAll();

foreach ($tous_les_groupes as $groupe){
  $groupe->print();
  echo "<br>";
}*/

/*$questions = $gestionReservation->questionSelectAll();

$questions = $gestionReservation->questionSelectAllWithQuestionnaireId(2);


foreach ($questions as $question){
  $question->print();
  echo "<br>";
}*/

$questionnaires = $gestionReservation->questionnaireSelectAllWithActiviteId(13);

if($questionnaires == null){
  echo "Aucun questionnaire";
}

foreach ($questionnaires as $questionnaire){
  $questionnaire->print();
}

 ?>
