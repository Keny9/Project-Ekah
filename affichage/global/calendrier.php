<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/underscore/underscore-min.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/bootstrap2/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/jstimezonedetect/jstz.min.js"></script>

  <script type="text/javascript" src="../../utils/bootstrap-calendar/js/calendar.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/js/app.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/js/language/fr-FR.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

</head>
<body>
  <main class="main-calendar">

    <select class="select-inscr" name="dispo" id="dispo" onchange="changeListe(this);">
      <option value="" disabled selected>Commencer par choisir une date!</option>
    </select>

    <div class="btnCalandrier">
      <div class="legend">
        <div class="legend-vert"></div>
        <p class="legend-txt">= Disponible</p>
      </div>
      <div class="page-header">
        <h3 class=" h3"></h3>
      </div>
      <div class="">
        <button type="button" class="bouton-re-que bouton-nav" name="button" id="next"  data-calendar-nav="next">Suivant >></button>
        <button type="button" class="bouton-re-que bouton-nav" name="button" id="prev"  data-calendar-nav="prev"><< Précédent</button>
      </div>
    </div>


<br><br>

      <div id="calendar"></div>

        <br><br>
      </main>

  </body>
</html>
