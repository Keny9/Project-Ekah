<?php
/**
 * Fait appel à la méthode getDisponibiliteFacilitateur
 *
 * Nom :         AfficherHoraireFacilitateur
 * Catégorie :   scriptPhp
 * Auteur :      Guillaume Côté
 * Version :     1.0
 * Date de la dernière modification : 2019-10-10
 */

 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Facilitateur/gestionFacilitateur.php";

 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";


$gestionFacilitateur = new GestionFacilitateur();

$facilitateur = $gestionFacilitateur->getAllFacilitateurActif();
// print_r($facilitateur[1]->getNom());


date_default_timezone_set('America/Toronto');

// $disponibilite = $facilitateur->getDisponibilite();
// print_r($disponibilite);

for ($i=0; $i < sizeof($facilitateur); $i++) {
  // print_r($facilitateur[$i]);
  $dispo = $facilitateur[$i]->getDisponibilite();

  if(sizeof($dispo) != 0){
    for ($j=0; $j < sizeof($dispo); $j++) {
      // print_r($dispo[$j][$j]);

      echo $j;

      $start = date("Y-m-d H:i:s", strtotime($dispo[$j][$j]->getHeureDebut()));
      $end = date("Y-m-d H:i:s", strtotime($dispo[$j][$j]->getHeureFin()));

      $out[] = array(
        'id' => $dispo[$j][$j]->getId(),
        'title' => $dispo[$j][$j]->getId(),
        'url' => "URL",
        'start' => strtotime($start) . '000',
        'end' => strtotime($end) .'000'
      );
    }
  }
}


// echo json_encode(array('success' => 1, 'result' => $out));
exit;

 ?>
