<!DOCTYPE html>
<html>
<head>
  <title>Minimum Setup</title>
  <link rel="stylesheet" href="../../utils/bootstrap-calendar/components/bootstrap2/css/bootstrap.css">
	<link rel="stylesheet" href="../../utils/bootstrap-calendar/components/bootstrap2/css/bootstrap-responsive.css">
	<link rel="stylesheet" href="../../utils/bootstrap-calendar/css/calendar.css">

  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/underscore/underscore-min.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/bootstrap2/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/jstimezonedetect/jstz.min.js"></script>

  <script type="text/javascript" src="../../utils/bootstrap-calendar/js/calendar.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/js/app.js"></script>

  <script type="text/javascript" src="../../js/disponibilite.js"></script>

  <link rel="stylesheet" href="../../css/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <script type="text/javascript" src="../../js/global.js"></script>

</head>
<body>

  <?php include 'header.php' ?>

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

      <script type="text/javascript">
        var calendar = $("#calendar").calendar(
          {
            tmpl_path: "../../utils/bootstrap-calendar/tmpls/",
            weekbox: false,
            events_source: "../../php/script/Horaire/afficherHoraireFacilitateur.php",

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
