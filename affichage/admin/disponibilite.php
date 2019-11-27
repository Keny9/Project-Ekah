<?php
session_start();
// Page accessible seulement par les admins?
$page_type=2;
include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" content="">
  <title>Mes disponibilités</title>
  <link rel="shortcut icon" href="../../img/favicon-ekah.ico" type="image/x-icon">
  <link rel="stylesheet" href="../../utils/bootstrap-calendar/components/bootstrap2/css/bootstrap.css">
	<link rel="stylesheet" href="../../utils/bootstrap-calendar/components/bootstrap2/css/bootstrap-responsive.css">
	<link rel="stylesheet" href="../../utils/bootstrap-calendar/css/calendar.css">
  <link rel="stylesheet" href="../../css/fix.css">

  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/underscore/underscore-min.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/bootstrap2/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/jstimezonedetect/jstz.min.js"></script>

  <script type="text/javascript" src="../../utils/bootstrap-calendar/js/calendar.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/js/app.js"></script>

  <script type="text/javascript" src="../../js/disponibilite.js"></script>

  <link rel="stylesheet" href="../../css/inscription.css">
  <link rel="stylesheet" href="../../css/disponibilite.css">

  <link rel="stylesheet" href="../../css/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <link rel="stylesheet" href="../../css/fix.css">
  <script type="text/javascript" src="../../js/global.js"></script>

</head>
<body>

  <?php include '../global/header.php' ?>

  <main>
    <div class="reservation">
      <div class="txt-consulter">Mes disponibilités</div>
      <br>

      <div class="page-header">
        <h3 class="h3"></h3>
      </div>

      <div class="">
        <select class="select-inscr input" name="region" id="region">
          <?php
            echo "<option class=\"option-vide\" value=\"0\" selected=\"selected\">Choisir une région</option>";
            require_once '../../php/gestionnaire/Horaire/gestionAffichageDispo.php';
            $gad = new GestionAffichageDispo();
            echo $gad->getAllRegion();
          ?>
        </select>
      </div>

        <div class="btnsCalandrier">
          <button type="button" class="bouton-re-que" name="button" id="prev"  data-calendar-nav="prev"><< Prev</button>
          <button type="button" class="bouton-re-que" name="button" id="month"  data-calendar-view="month">MONTH</button>
          <button type="button" class="bouton-re-que" name="button" id="next"  data-calendar-nav="next">Next >></button>
        </div>

        <br><br>

        <div class="">
          <select class="select-inscr input" name="facilitateur" id="facilitateur">
            <?php
              // echo "<option class=\"option-vide\" value=".$_SESSION['logged_in_user_id']." selected=\"selected\">Choisir un facilitateur</option>";
              require_once '../../php/gestionnaire/Horaire/gestionAffichageDispo.php';
              $gad = new GestionAffichageDispo();
              echo $gad->getAllFacilitateur();
            ?>
          </select>
        </div><br>

        <div id="calendar"></div>

          <br><br>
        </div>

      </main>

    <?php include '../global/footer.php' ?>

  </body>
</html>
