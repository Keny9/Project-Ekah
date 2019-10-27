$(document).ready( function () {
//  getReservations();

$('#table_reservation').DataTable({
  "ajax":{
    "url": "../../php/script/Reservation/dataReservationClient.php",
    "dataSrc": ""
  },
  "columns" : [
    {"data": "nom"},
    {"data": "date_rendez_vous"},
    {"data": "nom_lieu"},
    {"data": "montant"},
    {"data": "facilitateur"},
  ],
  "language":{
    "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
  },
  responsive: true
});

} );

/*function getReservations(user_id){
  $(function($) {
    $.ajax({
      url: "/Project-Ekah/php/script/Reservation/getReservations.php",
      type:"POST",
      async: true,
      data: {user_id : user_id},
      dataType: 'json',
      success: function(data) {
        //data est un array
        data.forEach(function(e) {
          console.log(e);

          var html =
          "<tr>" +
              "<td>" + e['activite_nom'] + "</td>" +
              "<td>" + e['reservation_datetime'] + "</td>" +
              "<td>" + e['emplacement_nomlieu'] + "</td>" +
              "<td>" + e['activite_cout'] + "</td>" +
              "<td>" + e['facilitateur_prenom'] + " " + e['facilitateur_nom'] + "</td>" +
          "</tr>";

          $('#tbody').append(html)
        });
      } ,
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus); alert("Error: " + XMLHttpRequest.responseText);
      }
    });
  });
  //$('#temp-tr').remove();
}*/
