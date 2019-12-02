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

    <div id="modal-inscription" class="modal-inscription">
      <div class="modal-content">
        <div class="modal-align-middle-insc img-conf-insc">
           <img src="../../img/crochet.png" alt="Confirmation inscription">
        </div>
        <div class="modal-align-middle-insc txt-bravo-insc">
          <p>Attention !</p>
        </div>
        <div class="modal-align-middle-insc txt-modal-bienv-insc">
          <p>Cette disponibilite est déjà réservée. Vous devez annuler la réservation avant de supprimer cette disponibilité.</p>
        </div>
        <div class="modal-align-middle-insc btn-modal-insc">
          <button type="submit" onclick="closeModal()" class="btn-confirmer input-court" name="button">Fermer</button>
        </div>
      </div>
    </div>


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

        <br><br>

        <div class="">
          <select class="select-inscr input" name="facilitateur" id="facilitateur">
            <?php
              require_once '../../php/gestionnaire/Horaire/gestionAffichageDispo.php';
              $gad = new GestionAffichageDispo();
              echo $gad->getAllFacilitateur();
            ?>
          </select>
        </div><br>

        <div class="btnsCalandrier">
          <button type="button" class="bouton-re-que" name="button" id="prev"  data-calendar-nav="prev"><< Prev</button>
          <button type="button" class="bouton-re-que" name="button" id="month"  data-calendar-view="month">MONTH</button>
          <button type="button" class="bouton-re-que" name="button" id="next"  data-calendar-nav="next">Next >></button>
        </div>

        <div class="legend">
          <div class="legend">
            <div class="legend-vert"></div>
            <p class="legend-txt">= Des disponibilités</p>
          </div>

          <div class="legend">
            <div class="legend-bleu"></div>
            <p class="legend-txt">= Disponibilite vide</p>
          </div>

          <div class="legend">
            <div class="legend-orange"></div>
            <p class="legend-txt">= Réservé par un client</p>
          </div>

          <div class="legend">
            <div class="legend-jaune"></div>
            <p class="legend-txt">= Aujourd'hui</p>
          </div>
        </div>

<br><br><br>

        <div id="calendar"></div>

          <br><br>
        </div>

      </main>

    <?php include '../global/footer.php' ?>

  </body>
</html>
