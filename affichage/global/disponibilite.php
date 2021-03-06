<?php

// Page accessible seulement par les admins?
$page_type=2;
include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Minimum Setup</title>
  <link rel="stylesheet" href="/Project-Ekah/utils/bootstrap-calendar/components/bootstrap2/css/bootstrap.css">
	<link rel="stylesheet" href="/Project-Ekah/utils/bootstrap-calendar/components/bootstrap2/css/bootstrap-responsive.css">
	<link rel="stylesheet" href="/Project-Ekah/utils/bootstrap-calendar/css/calendar.css">

  <script src="/Project-Ekah/utils/bootstrap-calendar/components/jquery/jquery.min.js"></script>
  <script src="/Project-Ekah/utils/bootstrap-calendar/components/underscore/underscore-min.js"></script>
  <script src="/Project-Ekah/utils/bootstrap-calendar/components/bootstrap2/js/bootstrap.min.js"></script>
  <script src="/Project-Ekah/utils/bootstrap-calendar/components/jstimezonedetect/jstz.min.js"></script>

  <script src="/Project-Ekah/utils/bootstrap-calendar/js/calendar.js"></script>
  <script src="/Project-Ekah/utils/bootstrap-calendar/js/app.js"></script>
  <script src="/Project-Ekah/utils/bootstrap-calendar/js/language/fr-FR.js"></script>

  <script src="/disponibilite.js"></script>

  <link rel="stylesheet" href="/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <script src="/global.js"></script>

</head>
<body>

  <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/header.php' ?>

  <main>


    <div class="page-header">
      <h3 class=" h3"></h3>
    </div>

      <div class="btnsCalandrier">
        <button type="button" class="bouton-re-que" name="button" id="prev"  data-calendar-nav="prev"><< Prev</button>
        <button type="button" class="bouton-re-que" id="day" name="button" data-calendar-view="day">Day</button>
        <button type="button" class="bouton-re-que" name="button" id="month"  data-calendar-view="month">MONTH</button>
        <button type="button" class="bouton-re-que" name="button" id="next"  data-calendar-nav="next">Next >></button>
      </div>

<br><br>

      <div id="calendar"></div>

      <script>

        var calendar = $("#calendar").calendar(
          {
            language: 'fr-FR',
            tmpl_path: "/Project-Ekah/utils/bootstrap-calendar/tmpls/",
            weekbox: false,
            events_source: "/Project-Ekah/php/script/Horaire/afficherHoraireFacilitateur.php",

            onAfterViewLoad: function(view) {
        			$('.page-header h3').text(this.getTitle());
            }
          });
        </script>

        <br><br>
      </main>

    <?php include 'footer.php' ?>

  </body>
</html>
