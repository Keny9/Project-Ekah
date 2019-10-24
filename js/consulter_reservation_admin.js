$(document).ready( function () {

  $('#table_reservation').DataTable({
    "ajax":{
      "url": "../../php/script/Reservation/dataReservationAdmin.php",
      "dataSrc": ""
    },
    "columns" : [
      {"data": "nom"},
      {"data": "client"},
      {"data": "nom_lieu"},
      {"data": "date_rendez_vous"},
      {"data": "montant"},
      {"data": "facilitateur"},
    ],
    "language":{
      "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
    },
    responsive: true
  });

} );
