<?php
/**
 * Nom :         ajouterHoraire
 * Catégorie :   scriptPhp
 * Auteur :      Guillaume Côté
 * Version :     1.0
 * Date de la dernière modification : 2019-10-07
 */

  $d=mktime(11, 14, 54, 10, 8, 2019);
  $start = date("Y-m-d h:i:s", $d / 1000);

  $d=mktime(13, 14, 54, 10, 8, 2019);
  $end = date("Y-m-d h:i:s", $d / 1000);

   $out[] = array(
      'id' => 1,
      'title' => "Titre",
      'url' => "www.URL.com",
      'start' => strtotime($start) . '000000',
      'end' => strtotime($end) .'000000'
  );

  echo json_encode(array('success' => 1, 'result' => $out));
  exit;

 ?>
