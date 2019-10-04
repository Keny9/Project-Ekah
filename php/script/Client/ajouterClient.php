<?php
/**
 * Fait appel à la méthode ajouterClient de la classe GestionClientAjout.
 * // TODO: retourne...
 *
 *
 * Nom :         ajouterClient
 * Catégorie :   scriptPhp
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-04
 */
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Client/GestionClientAjout.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Client/Client.php";

$gestion = new GestionClientAjout();
$client;
$pays = $_POST['pays'];
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$jourNaissance = $_POST['jour'];
$moisNaissance = $_POST['mois'];
$anneeNaissance = $_POST['annee'];
// Crée la date de naissance en format date
$dateNaissance = date_create($anneeNaissance."-".$moisNaissance."-".$jourNaissance);
$dateNaissanceString = $dateNaissance->format('Y-m-d');
$codePostal = $_POST['codePostal'];
$numeroAdresse = $_POST['noAdresse'];
$rue = $_POST['rue'];
$ville = $_POST['ville'];
$telephone = $_POST['telephone'];
$courriel = $_POST['courriel'];
// TODO: Hash le mot de passe ici?
$motDePasse = $_POST['motDePasse'];

//Test
echo "Pays : ".$pays."<br>
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

echo $temp;


$client = new Client(NULL, $nom, $prenom, NULL, $courriel,
$dateNaissanceString, $telephone, $rue, $codePostal, $numeroAdresse,
$ville, NULL, NULL, $pays);

$gestion->ajouterClient($client, $motDePasse);
?>
