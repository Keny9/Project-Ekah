<?php
  session_start();

  require_once("../../php/gestionnaire/Activite/gestionActivite.php");

  //if(!isset($_SESSION["admin"]) || !isset($_SESSION["user"])){
  //  header("location: page_connexion.php");
  //}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <link rel="stylesheet" href="../../css/gestionReservation.css">
  <link rel="stylesheet" href="../../css/main.css">
  <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
  <script type="text/javascript" src="../../js/gestionReservation.js"></script>
  <title>Gestion Reservation</title>
</head>

<body>
<main>

  <h1 class="titreReservation">Gestion des Réservation</h1>
    <div class="tableauActivite">
    <?php
                   require 'gestionAffichageGestionReservation.php';
                   $gagr = new GestionAffichageGestionReservation();
                   echo $gagr->getAllActivite();
                 ?>
    </div>
    <div class="reservationMain">
      <div class="reservationHeader"><img class="imgHeader"src="../../img/logo_ekah_header.png" alt="Ekah"></div>
      <div class="reservationImg"><img class="imgPrincipal"src="../../img/imgDehors.jpg" alt="Soins a domicile"> <div class="titreImg">Soins a domicile</div></div>

    </div>
</main>
</body>

</html>

<?php
  unset($_SESSION["error"]);
 ?>
