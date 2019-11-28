
<?php
// Script qui reset le mot de passe d'un utilisateur
// 2019-10-27
// Maxime

include_once  $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/connexion.php';

/*Commenter ces variables lorsqu'elles seront set dans le fichier qui appel ce script*/
if(isset($_POST['courriel'])){
  $courriel = $_POST['courriel'];
}
else{
  $courriel = null;
}

/*Fin des variables à commenter*/

/* Créer un password aléatoire de 8 charactère avec au moins 1 chiffre et 1 lettre majuscule */
$minuscule = 'abcefghijklmnopqrstuvwxyz';
$majuscule = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$nombre = '0123456789';
$mix = substr(str_shuffle($minuscule), 0, 7).substr(str_shuffle($nombre),0,1).substr(str_shuffle($majuscule),0,1);
$password_clair = str_shuffle($mix);
$password_hash = password_hash($password_clair, PASSWORD_ARGON2I);

/* Change le mot de passe dans la BD */
$conn = ($ctemp = new Connexion())->do();
$stmt = $conn->prepare("UPDATE compte_utilisateur SET mot_de_passe = ? WHERE courriel = ?");
$stmt->bind_param('ss', $password_hash, $courriel);
$stmt->execute();

echo $password_clair;
echo "<br>";
echo $password_hash;
?>
