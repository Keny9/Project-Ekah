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

  // $idFacilitateur = $_POST['idFacilitateur'];
  $idFacilitateur = 1;

  $gestionFacilitateur = new GestionFacilitateur();

  $facilitateur = null;
  // echo $idFacilitateur;
  if($idFacilitateur == -1){
    $facilitateur = $gestionFacilitateur->getAllFacilitateurActifAvecDispoGroup();
  }else{
    $facilitateur = $gestionFacilitateur->getFacilitateurActifAvecDispoGroup($idFacilitateur);
  }
  // print_r($facilitateur);


  date_default_timezone_set('America/Toronto');

  $out = null;

  for ($i=0; $i < sizeof($facilitateur); $i++) {
    $dispo = $facilitateur[$i]->getDisponibilite();

    if (isset($dispo)) {
      for ($j=0; $j < sizeof($facilitateur[$i]->getDisponibilite()); $j++) {

        $start = date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut()));
        $end = date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureFin()));

        $out[] = array(
          'id' => $dispo[$j]->getId(),
          'title' => $dispo[$j]->getId(),
          'url' => "URL",
          'start' => strtotime($start) . '000',
          'end' => strtotime($end) .'000'
        );
      }
    }
  }


  echo json_encode(array('success' => 1, 'result' => $out));
  exit;

?>
