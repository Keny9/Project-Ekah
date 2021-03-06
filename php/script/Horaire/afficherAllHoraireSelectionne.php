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
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Activite/GestionActivite.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/Activite.php";
   include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";

  $idFacilitateur = $_POST['idFacilitateur'];
  $date = $_POST['date'];
  $duree = $_POST['duree'];
  $region = $_POST['region'];
  $service = $_POST['service'];

  // $idFacilitateur = -1;
  // $date = "2019-11-29";
  // $duree = "30";
  // $region = 1;
  // $service = 11;

  $gestionFacilitateur = new GestionFacilitateur();

  $facilitateur = null;
  if($idFacilitateur == -1){
    $facilitateur = $gestionFacilitateur->getAllFacilitateurActifAvecDispoGroup();
  }else{
    $facilitateur = $gestionFacilitateur->getFacilitateurActifAvecDispoGroup($idFacilitateur);
  }

  // print_r($facilitateur);

  date_default_timezone_set('America/Toronto');

  $out = null;
  $ga = new GestionActivite();
  $activite = $ga->getActivite($service);

  for ($i=0; $i < sizeof($facilitateur); $i++) {    //Pour tous les faciltiatateurs
    $dispo = $facilitateur[$i]->getDisponibilite();

    if (isset($dispo)) {
      for ($j=0; $j < sizeof($facilitateur[$i]->getDisponibilite()); $j++) {    //Pour toutes les dispo
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

        // $date = "2019-10-31";
        $date = strtotime($date);
        $date = date('Y-m-d', $date);

        // echo "Date : " . $date . "<br />";

        $start = date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut()));
        $end = date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureFin()));

        //Pour retourner que les journées qui corresponde à la journée sélectionné
        $startTemp = DateTime::createFromFormat('Y-m-d H:i:s', $start)->format('Y-m-d');

        if($activite != null){
          if($activite->getId_type() == 3){                   //Si c'est en ligne, pas de region dans le if
            if($startTemp == $date && $dispo[$j]->getEtat() == 0){
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
          }else{                                              //Si pas en ligne, ajouter region
            if($startTemp == $date && $dispo[$j]->getEtat() == 0 && $dispo[$j]->getRegion() == $region){
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
  }


  echo json_encode(array('success' => 1, 'result' => $out));
  exit;

?>
