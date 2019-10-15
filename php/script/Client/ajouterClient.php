<?php
/**
 * Fait appel à la méthode ajouterClient de la classe GestionClientAjout.
 * Une fois l'ajout fait, REDIRECT vers la page de login.
 *
 *
 * Nom :         ajouterClient
 * Catégorie :   scriptPhp
 * Auteur :      Maxime Lussier
 * Version :     1.1
 * Date de la dernière modification : 2019-10-07
 */
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Client/GestionClientAjout.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Client/Client.php";
$preMessageErreur = "script ajouterClient mouru : ";

$gestion = new GestionClientAjout();
$client;
$pays = null;
$codePostal = null;
$numeroAdresse = null;
$ville = null;
$rue = null;
$jourNaissance = null;
$moisNaissance = null;
$anneeNaissance = null;
$dateNaissanceString = null;

/*
  Vérifie si les $_POST sont set.
*/
if(isset($_POST['pays'])) {$pays = $_POST['pays'];}
if(isset($_POST['codePostal'])) {$codePostal = $_POST['codePostal'];}
if(isset($_POST['noAdresse'])) {$numeroAdresse = $_POST['noAdresse'];}
if(isset($_POST['ville'])) {$ville = $_POST['ville'];}
if(isset($_POST['rue'])) {$rue = $_POST['rue'];}
if(isset($_POST['jour'])) {$jourNaissance = $_POST['jour'];}
if(isset($_POST['mois'])) {$moisNaissance = $_POST['mois'];}
if(isset($_POST['annee'])) {$anneeNaissance = $_POST['annee'];}

// Crée la date de naissance en format date
$dateNaissance = date_create($anneeNaissance."-".$moisNaissance."-".$jourNaissance);
if(!empty($dateNaissance)){$dateNaissanceString = $dateNaissance->format('Y-m-d');}

/*
  Les $_POST çi-dessous DOIVENT être set.
  Sinon, die();
*/

if (isset($_POST['prenom'])) {$prenom = $_POST['prenom'];}
else {die($preMessageErreur."Le prenom est vide");}

if (isset($_POST['nom'])) {$nom = $_POST['nom'];}
else {die($preMessageErreur."Le nom est vide");}

if (isset($_POST['courriel'])) {$courriel = $_POST['courriel'];}
else {die($preMessageErreur."Le courriel est vide");}

if (isset($_POST['motDePasse'])) {$motDePasse = $_POST['motDePasse'];}
else {die($preMessageErreur."Le mot de passe est vide");}

if (isset($_POST['telephone'])) {$telephone = $_POST['telephone'];}
else {die($preMessageErreur."Le telephone est vide");}



//Test
/*echo "Pays : ".$pays."<br>
Prenom : ".$prenom."<br>
Nom : ".$nom."<br>
Jour naissance : ".$jourNaissance."<br>
Mois naissance : ".$moisNaissance."<br>
Annee naissance : ".$anneeNaissance."<br>
Code postal : ".$codePostal."<br>
No adresse : ".$numeroAdresse."<br>
Rue : ".$rue."<br>
Ville : ".$ville."<br>
Telephone : ".$telephone."<br>
Courriel : ".$courriel."<br>
Mot de passe : ".$motDePasse."<br>";
$temp = password_hash($motDePasse, PASSWORD_ARGON2ID);

echo $temp;*/


$client = new Client(NULL, $nom, $prenom, NULL, $courriel,
$dateNaissanceString, $telephone, $rue, $codePostal, $numeroAdresse,
$ville, NULL, NULL, $pays);

// Si l'ajout est un succès (si ajouterClient() retourne true)
// TODO on dirait que la méthode ajouterClient ne fonctionne pas correctement.
    // retourne TRUE même si les inserts fail
if($gestion->ajouterClient($client, $motDePasse)){
  //Afficher que l'inscription fut un succès, ensuite va à la page login
  header('Location: ../../../affichage/client/login.php');
}
?>
