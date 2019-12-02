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

 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Region/Region.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";

 if (session_status() === PHP_SESSION_NONE){session_start();}

// $id = 2;
$id = $_POST['idFacilitateur'];

if($id == -1){
  $id = $_SESSION['logged_in_user_id'];
}
// print_r($id);


$gestionFacilitateur = new GestionFacilitateur();

$facilitateur = $gestionFacilitateur->getFacilitateur($id);
// print_r($facilitateur->getDisponibilite());
$regions = $gestionFacilitateur->getRegion();


date_default_timezone_set('America/Toronto');

$disponibilite[] = $facilitateur->getDisponibilite();
$out = null;

$regionNom = null;

foreach ($disponibilite as $row) {

  if(isset($row)){
    for ($i=0; $i < sizeof($row); $i++) {
      $start = date("Y-m-d H:i:s", strtotime($row[$i]->getHeureDebut()));
      $end = date("Y-m-d H:i:s", strtotime($row[$i]->getHeureFin()));

      for ($k=0; $k < sizeof($regions); $k++) {
        if($regions[$k]->getId() == $row[$i]->getRegion()){
          $regionNom = $regions[$k]->getNom();
        }
      }


      if($row[$i]->getEtat() == 1 || $row[$i]->getEtat() == 2)
      $out[] = array(
        'id' => $row[$i]->getId(),
        'title' => $row[$i]->getId(),
        'url' => "URL",
        'start' => strtotime($start) . '000',
        'end' => strtotime($end) .'000',
        'etat' => $row[$i]->getEtat(),
        'region' => $regionNom
      );
    }
  }
}

if($out == null){
  $out[] = array(
    'id' => 0,
    'title' => 0,
    'url' => "URL",
    'start' => '2556075600000',
    'end' => '2556077400000',
    'etat' => 2,
    'region' => 'Ceci n est pas une vrai dispo'
  );
}

echo json_encode(array('success' => 1, 'result' => $out));
exit;

 ?>
