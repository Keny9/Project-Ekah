<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>

  <script>
  $(function($) {
    $.ajax({
      url: "getReservations.php",
      type:"POST",
      async: false,
      data: {id : 1},
      dataType: 'json',
      success: function(data) {
        //data est un array
        data.forEach(function(e) {
        //  var output = "Réservation " + e['reservation_id'] + ": " + e['activite_nom'] + "<br>";
          $('#demo').append(e);
          console.log(e);
        });
      } ,
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus); alert("Error: " + XMLHttpRequest.responseText);
      }
    });
  });
  </script>

  <body id="demo">

  </body>
</html>
