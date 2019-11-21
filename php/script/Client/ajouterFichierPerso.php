<?php
session_start();
/**
 * Ajoute un fichier sur le serveur
 *
 * Nom :         ajouterFichierPerso.php
 * Catégorie :   script
 * Auteur :      Maxime Lussier
 * Version :     1.1
 * Date de la dernière modification : 2019-11-21
 */

//include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";

if($_FILES["file"]["name"] != '')
{
 $test = explode('.', $_FILES["file"]["name"]);
 $ext = end($test);
 $name = $_SESSION['logged_in_user_id']."_form-medical" . '.' . $ext;
 $location = '../../../upload/client/' . $name;
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 echo '<img src="'.$location.'" height="150" width="225" class="img-thumbnail" />';
}




/*
//SQL
$conn = ($temp = new Connexion)->do();
$request = "SELECT mot_de_passe FROM compte_utilisateur WHERE fk_utilisateur = ?";
$stmt = $conn->prepare($request);
$stmt->bind_param('i', $client_id);
$stmt->execute();
$result = $stmt->get_result();
if($result == false){
  die($conn->errno.$conn->error);
}

$row = $result->fetch_assoc();

// TEST
echo password_verify($mot_de_passe, $row['mot_de_passe']) ? 'true' : 'false';
*/
 ?>
