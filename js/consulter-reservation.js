/**
 * Page consulter-reservation.php, un client consulte toutes ses réservations
 *
 * Nom :        consulter-reservation.js
 * Catégorie :   JS script
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-30
 */
 var currentRowData = null;
 var idReservation = null;

$(document).ready( function () {
  $('#txtConsulter').css('margin-top',30);

  selectedLine = null; //La ligne sélectionné
  today = new Date(); //Obtenir la date d'aujourd'hui
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0');
  var yyyy = today.getFullYear();

  today = yyyy + '-' + mm + '-' + dd;

table = $('#table_reservation').DataTable({
  "ajax":{
    "url": "/Project-Ekah/php/script/Reservation/dataReservationClient.php",
    "dataSrc": ""
  },
  "columns" : [
    {"data": "nom"},
    {"data": "date_rendez_vous"},
    {"data": "nom_lieu"},
    {"data": null,
    render: function(data, type, row){
      return data.montant + " $";
    }},
    {"data": "facilitateur"},
    {"data": null,
    render: function(data, type, row){
      if(data.recu_url != null){
        return '<a class="link-client" href="'+data.recu_url+'" target="_blank">Reçu</a>';
      }
      else{
        return 'Paiement Test';
      }
    }},
  ],
  "language":{
    "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
  },
  responsive: false
});
jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');

setTimeout(function(){
  table.rows().every(function(rowIdx,tableLoop,rowLoop){ //Loop au travers de chaque ligne de dataTable
    var data = this.data();
    var row = table.row(rowIdx);
    var dateL = data.date_rendez_vous.slice(0,10);

    tr = table.row(rowIdx).node(); //Recupere le tr (la ligne en html)
    child = tr.children; //Obtenir les elements de la ligne

    if(dateL < today && data.id_etat == 1){
      tr.setAttribute("id", "row" + rowIdx);
      tr.style.backgroundColor = "#cefdce";

      $("#row" + rowIdx).hover(function(){ //Effet de hover sur les lignes
        $(this).css("background-color", "whitesmoke");
        },function(){
        $(this).css("background-color", "#cefdce");
      });
    }
    else if(data.id_etat == 2){
      tr.setAttribute("id", "row" + rowIdx);
      tr.style.backgroundColor = "#ffc2b3";

      $("#row" + rowIdx).hover(function(){ //Effet de hover sur les lignes
        $(this).css("background-color", "whitesmoke");
        },function(){
        $(this).css("background-color", "#ffc2b3");
      });
    }
   });
}, 250);


});
