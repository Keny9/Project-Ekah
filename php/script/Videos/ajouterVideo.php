<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Video/GestionVideo.php';

$conn;
$gVideo = new GestionVideo();

$nom = $fichier = $poster = $prix = "";
$nomErr = $fichierErr = $posterErr = $prixErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST['nom'])) {
    $nomErr = "Le nom est requis";
  } else {
    $nom = test_input($_POST['nom']);
  }

  if (empty($_POST['fichier'])) {
    $fichierErr = "Le fichier est requis";
  } else {
    $fichier = test_input($_POST['fichier']);
  }

  if (empty($_POST['poster'])) {
    $posterErr = "Le poster est requis";
  } else {
    $poster = test_input($_POST['poster']);
  }

  if (empty($_POST['prix'])) {
    $prixErr = "Le prix est requis";
  } else {
    $prix = test_input($_POST['prix']);
  }

  if(($nomErr === $fichierErr) && ($posterErr === $prixErr)){

    $gVideo->ajouterVideo($nom, $fichier, $poster, $prix);

    //header("Location: ./TESTvideoAdded.php");
  } else {
    // erreurs dans les champs
  }
} else {
  // Méthode de requête n'est pas POST
}

echo "<br><br>done<br><br>";


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
