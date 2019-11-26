/**
 * Page consulter-reservation.php, un client consulte toutes ses réservations
 *
 * Nom :        consulter-reservation.js
 * Catégorie :   JS script
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-30
 */

$(document).ready( function () {
  $('#txtConsulter').css('margin-top',30);

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
  responsive: false
});

} );
