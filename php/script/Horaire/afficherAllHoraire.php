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

$facilitateur = $gestionFacilitateur->getAllFacilitateurActifAvecDispo();
// print_r($facilitateur[1]->getNom());


date_default_timezone_set('America/Toronto');

$out = null;

// $dispo1 = $facilitateur[0]->getDisponibilite();
// $dispo2 = $facilitateur[1]->getDisponibilite();
// $dispo3 = $facilitateur[2]->getDisponibilite();
//
// print_r($dispo1);
// echo "<br />";echo "<br />";
//
// print_r($dispo2);
// echo "<br />";echo "<br />";
//
// print_r($dispo3);
// echo "<br />";echo "<br />";



// $disponibilite = $facilitateur->getDisponibilite();
// print_r($disponibilite);

for ($i=0; $i < sizeof($facilitateur); $i++) {
  // print_r($facilitateur[$i]);
  $dispo = $facilitateur[$i]->getDisponibilite();

  $k = -1;

      // echo $i;
      // print_r($dispo);
      // echo "<br />";

    if($dispo != null){
      for ($j=0; $j < sizeof($dispo); $j++) {

        if(isset($dispo[$j])){
          echo "SET";
          if ($k < sizeof($dispo[$j])) {
            $k++;
          }
        }

        echo $k;

        echo $dispo[$j][$k]->getId();
        echo "<br />";

        // echo $j;
        // echo "Size : ";
        // echo sizeof($dispo[$j]);
        echo "<br />";
        // print_r($dispo);
        // echo "<br />";

        $start = date("Y-m-d H:i:s", strtotime($dispo[$j][$j]->getHeureDebut()));
        $end = date("Y-m-d H:i:s", strtotime($dispo[$j][$j]->getHeureFin()));

        $out[] = array(
          'id' => $dispo[$j][$j]->getId(),
          'title' => $dispo[$j][$j]->getId(),
          'url' => "URL",
          'start' => strtotime($start) . '000',
          'end' => strtotime($end) .'000'
        );
        if($j++ == sizeof($dispo)){
          echo "Break";
          break;
        }
      }
  }
}


echo json_encode(array('success' => 1, 'result' => $out));
exit;

 ?>
