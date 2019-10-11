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

  <script type="text/javascript" src="../../js/calendrier.js"></script>

</head>
<body>

<div class="page-header">
  <h3 class=" h3"></h3>
</div>

  <div class="">
    <button type="button" name="button" id="prev"  data-calendar-nav="prev"><< Prev</button>
    <button type="button" id="day" name="button" data-calendar-view="day">Day</button>
    <button type="button" name="button" id="month"  data-calendar-view="month">MONTH</button>
    <button type="button" name="button" id="next"  data-calendar-nav="next">Next >></button>
  </div>



  <div id="calendar"></div>

  <script type="text/javascript">
    var calendar = $("#calendar").calendar(
      {
        tmpl_path: "../../utils/bootstrap-calendar/tmpls/",
        weekbox: false,
        onAfterViewLoad: function(view) {
    			$('.page-header h3').text(this.getTitle());
        },
        events_source: "../../php/script/Horaire/ajouterHoraire.php"
      });
  </script>

</body>
</html>
