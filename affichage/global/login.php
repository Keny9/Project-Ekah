<?php
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") { // Set le https
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}
session_start();
session_destroy();
  /**
   * Page login, lorsqu'un client veut se connecter sur le site d'Ekah
   *
   * Nom :         login.php
   * Catégorie :   Page
   * Auteur :      Karl Boutin
   * Version :     1.0
   * Date de la dernière modification : 2019-10-03
   */

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Ekah est un collectif de facilitateurs, de thérapeutes, de professionnels de la santé et de yogis, qui vise le développement humain holistique.">
    <meta name="keywords" content="Ekah,ekah,ekah login,login ekah,ekah connexion,facilitateur,">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/favicon-ekah.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/inscription.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/login.css">
    <script src="../../js/jquery-3.4.1.slim.js"></script>
    <script src="../../js/login.js"></script>
    <title>Ekah - Bienvenue</title>
  </head>
  <body>

    <main>
      <div class="inscription">
        <div class="logo-inscr" id="logo">
          <img src="../../img/logo_ekah_header.png" alt="Ekah">
        </div>
        <form class="" id="formulaireLogin" action="" method="post">
          <div class="group-input-inscr">
            <input type="text" name="courriel" id="courriel" class="input-inscr" placeholder="Adresse courriel" value="">
          </div>
          <div class="group-input-inscr">
            <input type="password" name="motDePasse" id="motDePasse" class="input-inscr" placeholder="Mot de passe" value="">
          </div>
          <div class="group-input-inscr">
            <button type="submit" name="btnlogin" id="btnlogin" class="btn-confirmer input-long">Se connecter</button>
          </div>
          <div class="group-input-inscr">
            <div class="link-box">
              <a href="./inscription.php" class="link-inscr">Créer un compte</a>
            </div>
          </div>
          <div class="group-input-inscr mt-less">
            <div class="link-box">
              <a href="/Project-Ekah/affichage/global/password-reset.php" class="link-inscr">Mot de passe oublié ?</a>
            </div>
          </div>
        </form>
      </div>
    </main>

  </body>
</html>
