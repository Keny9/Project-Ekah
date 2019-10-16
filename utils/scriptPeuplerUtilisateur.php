<?php

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Client/GestionClientAjout.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Client/Client.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";

$conn = new Connexion();


$utilisateurId = 1;
$courriel = "test1@admin.ca";
$motDePasseHash = password_hash("Qwertyu1", PASSWORD_ARGON2ID);
$stmt = $conn->do()->prepare("INSERT INTO compte_utilisateur
  (fk_utilisateur, courriel, mot_de_passe)
  VALUES (?, ?, ?);");
  $stmt->bind_param('iss', $utilisateurId, $courriel, $motDePasseHash);
  $stmt->execute();

$utilisateurId = 2;
$courriel = "test2@admin.ca";
$motDePasseHash = password_hash("Qwertyu1", PASSWORD_ARGON2ID);
$stmt = $conn->do()->prepare("INSERT INTO compte_utilisateur
  (fk_utilisateur, courriel, mot_de_passe)
  VALUES (?, ?, ?);");
  $stmt->bind_param('iss', $utilisateurId, $courriel, $motDePasseHash);
  $stmt->execute();

$utilisateurId = 3;
$courriel = "test3@admin.ca";
$motDePasseHash = password_hash("Qwertyu1", PASSWORD_ARGON2ID);
$stmt = $conn->do()->prepare("INSERT INTO compte_utilisateur
  (fk_utilisateur, courriel, mot_de_passe)
  VALUES (?, ?, ?);");
  $stmt->bind_param('iss', $utilisateurId, $courriel, $motDePasseHash);
  $stmt->execute();

$utilisateurId = 4;
$courriel = "test4@client.ca";
$motDePasseHash = password_hash("Qwertyu1", PASSWORD_ARGON2ID);
$stmt = $conn->do()->prepare("INSERT INTO compte_utilisateur
  (fk_utilisateur, courriel, mot_de_passe)
  VALUES (?, ?, ?);");
  $stmt->bind_param('iss', $utilisateurId, $courriel, $motDePasseHash);
  $stmt->execute();

echo "peuplement effectué";
?>
