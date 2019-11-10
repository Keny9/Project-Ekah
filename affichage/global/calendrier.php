<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/underscore/underscore-min.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/bootstrap2/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/components/jstimezonedetect/jstz.min.js"></script>

  <script type="text/javascript" src="../../utils/bootstrap-calendar/js/calendar.js"></script>
  <script type="text/javascript" src="../../utils/bootstrap-calendar/js/app.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

</head>
<body>
  <main>

    <select class="" name="" id="dispo">
      <option value="" disabled selected>Choissiez une date d'abord</option>
    </select>

    <div class="page-header">
      <h3 class=" h3"></h3>
    </div>

      <div class="btnsCalandrier">
        <button type="button" class="bouton-re-que" name="button" id="prev"  data-calendar-nav="prev"><< Prev</button>
        <button type="button" class="bouton-re-que" name="button" id="next"  data-calendar-nav="next">Next >></button>
      </div>

<br><br>

      <div id="calendar"></div>

        <br><br>
      </main>

  </body>
</html>
