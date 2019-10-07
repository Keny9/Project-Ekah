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
  <link rel="stylesheet" href="../../css/gestionReservation.css">
  <link rel="stylesheet" href="../../css/main.css">
  <link href="images/century.ttf" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="../../js/gestionReservation.js"></script>
  <title>Gestion Reservation</title>
</head>

<body>
  <div class="background">
<main class="centré">
    <div class="field_set_Promo">
    <?php
                   require '../../gestionnaire/Activite/gestionAffichageReservation.php';
                   $gagr = new GestionAffichageGestionReservation();
                   echo $gagr->getAllActivite();
                 ?>
    </div>
    </div>
</main>
</body>

</html>

<?php
  unset($_SESSION["error"]);
 ?>
