<!DOCTYPE html>
<?php
// Accueil du client

session_start();

//Si un admin n'est pas connecté,
if($_SESSION['userTypeId'] != 2){
  header('Location: /Project-Ekah/affichage/global/main.php');
}
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <script type="text/javascript" src="../../js/jquery-3.4.1.slim.js"></script>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script type="text/javascript" src="../../js/global.js"></script>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/header.php' ?>

    <main>
      <nav>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/nav_client.php' ?>
      </nav>
      <article class="">
        Accueil de l'admin
      </article>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/footer.php' ?>
  </body>
</html>
