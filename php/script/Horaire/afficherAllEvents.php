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

   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Facilitateur/gestionFacilitateur.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Activite/gestionActivite.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/activite.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";

  $idFacilitateur = $_POST['idFacilitateur'];
  $duree = $_POST['duree'];
  $region = $_POST['region'];
  $service = $_POST['service'];

  // $idFacilitateur = -1;
  // $duree = "30";
  // $region = 3;
  // $service = "1";


  $gestionFacilitateur = new GestionFacilitateur();

  $facilitateur = null;
  // echo $idFacilitateur;
  if($idFacilitateur == -1){
    $facilitateur = $gestionFacilitateur->getAllFacilitateurActifAvecDispoGroup();
  }else{
    $facilitateur = $gestionFacilitateur->getFacilitateurActifAvecDispoGroup($idFacilitateur);
  }

  date_default_timezone_set('America/Toronto');

  $out = null;

  if($service == "vide"){
    $service = 1;
  }

  $ga = new GestionActivite();
  $activite = $ga->getActivite($service);

  $dispo = $facilitateur[0]->getDisponibilite();
  // print_r($dispo);

  for ($i=0; $i < sizeof($facilitateur); $i++) {
    $dispo = $facilitateur[$i]->getDisponibilite();
    // print_r($dispo);


    if (isset($dispo)) {
      for ($j=0; $j < sizeof($facilitateur[$i]->getDisponibilite()); $j++) {

        if($dispo[$j]->getId() == 1){
          $dispo[$j]->setEtat(0);
        }

        //Ajout de la durée
        if($duree != "vide"){
          $dispo = $facilitateur[$i]->getDisponibilite();

          for ($k=0; $k < sizeof($dispo); $k++) {       //Pour toutes les dispo, compare dispo[$j] avec dispo[k] pour 30 minutes après la dispo

            for ($l=0; $l < sizeof($dispo); $l++) {     //Pour toutes les dispo, compare dispo[$j] avec dispo[l] pour 30 minutes avant la dispo
              if($duree == "30"){
                if (date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut() . "+30 minutes")) == $dispo[$k]->getHeureDebut()) {   //Si y'a une dispo 30 minutes avant (deplacement)
                  if (date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut() . "-30 minutes")) == $dispo[$l]->getHeureDebut()) { //Si y'a une dispo 30 minutes avant (deplacement)
                    $dispo[$j]->setEtat(0);
                  }
                }
              }else if ($duree == "60") {
                if (date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut() . "+60 minutes")) == $dispo[$k]->getHeureDebut()) {   //Si il y a une autre dispo pour le déplacement

                  if (date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut() . "-30 minutes")) == $dispo[$l]->getHeureDebut()) { //Si y'a une dispo 30 minutes avant (deplacement)
                    $dispo[$j]->setEtat(0);
                  }
                }
              }elseif ($duree == "90") {
                if (date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut() . "+90 minutes")) == $dispo[$k]->getHeureDebut()) {
                  if (date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut() . "-30 minutes")) == $dispo[$l]->getHeureDebut()) { //Si y'a une dispo 30 minutes avant (deplacement)
                    $dispo[$j]->setEtat(0);
                  }
                }
              }
            }
          }
        }

        $start = date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut()));
        $end = date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureFin()));

        if($activite->getId_type() == 3){                   //Si c'est en ligne
          if($dispo[$j]->getEtat() == 0){
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
        }else{                                            //Si c'est pas en ligne, pas besoin de la region dans le if
          if($dispo[$j]->getEtat() == 0 && $dispo[$j]->getRegion() == $region){
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
