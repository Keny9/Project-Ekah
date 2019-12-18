<?php
/*
  Retourne un array de chaques videos
  Array
(
    [0] => Array
        (
            [id] => 1
            [nom] => nom
            [fichier] => fichier
            [poster] => poster
            [prix] => 1000
        )

    [1] => Array
        (
            [id] => 2
            [nom] => nom
            [fichier] => fichier
            [poster] => poster
            [prix] => 1000
        )
)
*/

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";

$videosTable = null;

$conn = ($temp = new Connexion())->do();
$req = "SELECT * FROM videos";
$stmt = $conn->prepare($req);

if($stmt) {
  $stmt->execute();
  $result = $stmt->get_result();

  while($row = $result->fetch_assoc()){
    $videosTable[] = $row;
  }

  //echo "<pre>";
  //print_r($videosTable);
}

//echo "$conn->error;"; Afficher les erreurs mysql

return $videosTable;
?>
