<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Video/GestionVideo.php";
/*
$videos_clientTable = null;

$conn = ($temp = new Connexion())->do();
$req = "SELECT * FROM videos_client";
$stmt = $conn->prepare($req);

if($stmt) {
  $stmt->execute();
  $result = $stmt->get_result();

  while($row = $result->fetch_assoc()){
    $videos_clientTable[] = $row;
  }

}

return $videos_clientTable;
*/
$gVideo = new GestionVideo();
print_r(json_encode($gVideo->consulterVideos_clientTable()));
?>
