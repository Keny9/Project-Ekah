<?php
session_start();
// Accueil du client
$page_type=1;
include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="shortcut icon" href="../../img/favicon-ekah.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../utils/bootstrap-calendar/components/bootstrap2/css/bootstrap.css">
  	<link rel="stylesheet" href="../../utils/bootstrap-calendar/components/bootstrap2/css/bootstrap-responsive.css">
  	<link rel="stylesheet" href="../../utils/bootstrap-calendar/css/calendar.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/inscription.css">
    <link rel="stylesheet" href="../../css/reservation.css">
    <link rel="stylesheet" href="../../css/fix.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script type="text/javascript" src="../../js/jquery-3.4.1.slim.js"></script>
    <script type="text/javascript" src="../../utils/bootstrap-calendar/components/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../../utils/bootstrap-calendar/components/underscore/underscore-min.js"></script>
    <script type="text/javascript" src="../../utils/bootstrap-calendar/components/bootstrap2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../utils/bootstrap-calendar/components/jstimezonedetect/jstz.min.js"></script>

    <script type="text/javascript" src="../../utils/bootstrap-calendar/js/calendar.js"></script>
    <script type="text/javascript" src="../../utils/bootstrap-calendar/js/app.js"></script>

    <script type="text/javascript" src="../../js/global.js"></script>
    <script type="text/javascript" src="../../js/ateliers.js"></script>

  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/header.php' ?>

    <main>

      <div class="reservation">
        <div class="">
          <div class="page-header">
            <h3 class=" h3"></h3>
          </div>
          <div class="btnsCalandrier">
            <button type="button" class="bouton-re-que" name="button" id="prev"  data-calendar-nav="prev"><< Prev</button>
            <button type="button" class="bouton-re-que" name="button" id="next"  data-calendar-nav="next">Next >></button>
          </div>
        </div>
        <br><br>

        <div id="calendar"></div>
        <br><br>


        <script type="text/javascript">

        var calendar = $("#calendar").calendar(
          {
            tmpl_path: "../../utils/bootstrap-calendar/tmpls/",
            weekbox: false,
            events_source: "../../php/script/Horaire/AfficherAllAteliers.php",

            onAfterViewLoad: function(view) {
              $('.page-header h3').text(this.getTitle());
            }
          });
        </script>

<!-- MODAL -->
        <div id="modal-modif-reservation" class="modal-modif-reservation">
          <div class="modal-content">
              <div class="modal-align-middle-mr">
                 <label class="label-reservation" for="activite">Facilitateur</label>
                 <div class="box-select">
                   <select class="select-inscr input-long" name="service" id="service" onchange="changeListe(this);">
                     <option class="option-vide" value="vide" selected="selected">Facilitateur</option>
                     <?php
                     foreach ($arrFacilitateur as $facilitateur){
                       echo "<option value=\"".$facilitateur->getId()."\">".$facilitateur->getPrenom()." ".$facilitateur->getNom()."</option>";
                     }
                     ?>
                   </select>
                 </div>
              </div>
            <div class="modal-align-middle btn-modal-insc modal-align-middle-mr">
              <button type="submit" class="btn-confirmer input-court btn-coller" name="button">Sauvegarder</button>
              <button id="btn-annuler" type="button" class="btn-confirmer input-long btn-compte-existant btn-coller" name="button">Annuler</button>
            </div>
          </div>
        </div>

      </div>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/footer.php' ?>
  </body>
</html>
