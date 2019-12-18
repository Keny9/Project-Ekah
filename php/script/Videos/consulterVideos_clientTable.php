<?php
/*
  Retourne un array:
  Array
  (
      [0] => Array
          (
              [utilisateur_id] => 4
              [videos_id] => 1
          )

  )
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";

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

  // echo "<pre>";
  // print_r($videos_clientTable);
}

//echo "$conn->error;"; Afficher les erreurs mysql

return $videos_clientTable;
?>
