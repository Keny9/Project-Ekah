<?php
  /**
   * Fait appel à la méthode getAllFacilitateurActifAvecDispoGroup
   *
   * Nom :         afficherAllEvents
   * Catégorie :   scriptPhp
   * Auteur :      Guillaume Côté
   * Version :     1.0
   * Date de la dernière modification : 2019-10-10
   */

   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Facilitateur/GestionFacilitateur.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";

  $idFacilitateur = $_POST['idFacilitateur'];
  $duree = $_POST['duree'];

  // $idFacilitateur = -1;
  // $duree = "90";

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
  $dispo = $facilitateur[0]->getDisponibilite();
  // print_r($dispo);

  for ($i=0; $i < sizeof($facilitateur); $i++) {
    $dispo = $facilitateur[$i]->getDisponibilite();

    if (isset($dispo)) {
      for ($j=0; $j < sizeof($facilitateur[$i]->getDisponibilite()); $j++) {

        if($dispo[$j]->getId() == 1){
          $dispo[$j]->setEtat(0);
        }

        //Ajout de la durée
        if($duree != "vide"){
          $dispo = $facilitateur[$i]->getDisponibilite();

          for ($k=0; $k < sizeof($dispo); $k++) {
            if ($duree == "60") {
              if (date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut() . "+30 minutes")) == $dispo[$k]->getHeureDebut()) {
                // echo $dispo[$k]->getHeureDebut() . " = " .  date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut() . "+30 minutes"));
                // echo $dispo[$j]->getHeureDebut();
                // echo "60";
                // echo "<br />";
                $dispo[$j]->setEtat(0);
              }
            }elseif ($duree == "90") {
              if (date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut() . "+60 minutes")) == $dispo[$k]->getHeureDebut()) {
                // echo $dispo[$k]->getHeureDebut() . " = " .  date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut() . "+30 minutes"));
                // echo $dispo[$j]->getHeureDebut();
                // echo "90";
                // echo "<br />";
                $dispo[$j]->setEtat(0);
              }
            }else{
              $dispo[$j]->setEtat(0);
            }
          }
        }


        $start = date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut()));
        $end = date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureFin()));

        if($dispo[$j]->getEtat() == 0){
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
  }


  echo json_encode(array('success' => 1, 'result' => $out));
  exit;

?>
