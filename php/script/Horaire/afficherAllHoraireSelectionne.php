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


  $idFacilitateur = $_POST['idFacilitateur'];
  $date = $_POST['date'];
  $duree = $_POST['duree'];

  // $idFacilitateur = 1;
  // $date = "2019-12-20";
  // $duree = "60";

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

  for ($i=0; $i < sizeof($facilitateur); $i++) {
    $dispo = $facilitateur[$i]->getDisponibilite();

    if (isset($dispo)) {
      for ($j=0; $j < sizeof($facilitateur[$i]->getDisponibilite()); $j++) {
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



        // $date = "2019-10-31";
        $date = strtotime($date);
        $date = date('Y-m-d', $date);

        // echo "Date : " . $date . "<br />";

        $start = date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureDebut()));
        $end = date("Y-m-d H:i:s", strtotime($dispo[$j]->getHeureFin()));

        //Pour retourner que les journées qui corresponde à la journée sélectionné
        $startTemp = DateTime::createFromFormat('Y-m-d H:i:s', $start)->format('Y-m-d');

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
      }
    }
  }


  echo json_encode(array('success' => 1, 'result' => $out));
  exit;

?>
