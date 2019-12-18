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

   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Facilitateur/GestionFacilitateur.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";

  // $idFacilitateur = $_POST['idFacilitateur'];
  // $date = $_POST['date'];

  $gestionFacilitateur = new GestionFacilitateur();


  $facilitateur = $gestionFacilitateur->getAllFacilitateurActifAvecDispo();
  // print_r($facilitateur[1]->getNom());


  date_default_timezone_set('America/Toronto');

  $out = null;

  for ($i=0; $i < sizeof($facilitateur); $i++) {
    $dispo = $facilitateur[$i]->getDisponibilite();

    if (isset($facilitateur[$i]->getDisponibilite())) {
      for ($j=0; $j < sizeof($facilitateur[$i]->getDisponibilite()); $j++) {

        $start = date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut()));
        $end = date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureFin()));

        $today = date("Y-m-d H:i:s", strtotime('now'));

        if($start > $today){
          $out[] = array(
            'id' => $dispo[$j]->getId(),
            'title' => $dispo[$j]->getId(),
            'url' => "URL",
            'start' => strtotime($start) . '000',
            'end' => strtotime($end) .'000',
            'date_debut' => $dispo[$j]->getHeureDebut(),
            'date_fin' => $dispo[$j]->getHeureFin()
          );
        }
      }
    }
  }

  if($out == null){
    $out[] = array(
      'id' => 0,
      'title' => 0,
      'url' => "URL",
      'start' => '2556075600000',
      'end' => '2556077400000'
    );
  }

  echo json_encode(array('success' => 1, 'result' => $out));
  exit;

?>
