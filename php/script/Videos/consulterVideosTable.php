<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Video/GestionVideo.php";

$gVideo = new GestionVideo();
// print_r($gVideo->consulterVideosTable());
return $gVideo->consulterVideosTable();
?>
