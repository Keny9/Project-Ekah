$(document).ready( function () {
    $('#table_reservation').DataTable({
      "language":{
        "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
      },
      responsive: true
    });
} );

// TODO: laisser en stand by
/*
$(function($) {
    $.ajax({
      url: "../../php/script/Reservation/getReservations.php",
      type:"POST",
      async: false,
      data: {id: 1},
      dataType: 'json',
      success: function(data) {
        //data est un array
        data.forEach(function(e) {
          var output = "Réservation " + e['reservation_id'] + ": " + e['activite_nom'] + "<br>";
          $('#demo').append(output);
        });
      } ,
      error: function() {
        alert('Error occured');
      }
    });
  });

*/
