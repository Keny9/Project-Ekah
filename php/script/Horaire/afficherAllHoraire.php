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

 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Horaire/gestionHoraire.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Facilitateur/gestionFacilitateur.php";

 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";


$gestionFacilitateur = new GestionFacilitateur();

$facilitateur = $gestionFacilitateur->getAllFacilitateurActif();
// print_r($facilitateur[0]->getDisponibilite());   -> fonctionne


date_default_timezone_set('America/Toronto');

// $disponibilite = $facilitateur->getDisponibilite();
// print_r($disponibilite);

//Je dois faire 2 boucles, une pour les disponibilité (deja fait) et une pour les
//facilitateurs (pas encore fais)
foreach ($disponibilite as $row) {
  $start = date("Y-m-d H:i:s", strtotime($row->getHeureDebut()));
  $end = date("Y-m-d H:i:s", strtotime($row->getHeureFin()));

  $out[] = array(
    'id' => $row->getId(),
    'title' => $row->getId(),
    'url' => "URL",
    'start' => strtotime($start) . '000',
    'end' => strtotime($end) .'000'
  );
}

echo json_encode(array('success' => 1, 'result' => $out));
exit;

 ?>
