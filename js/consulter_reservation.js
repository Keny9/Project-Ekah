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
