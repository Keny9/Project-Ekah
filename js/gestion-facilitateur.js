/**
 * Page JS pour la gestion des facilitateurs
 *
 * Nom :         gestion-facilitateur.js
 * Catégorie :   JavaScript
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-11-18
 */

$(document).ready(function(){

//Initialiser Data table
  table = $('#table_client').DataTable({
      "ajax":{
        "url": "../../php/script/Facilitateur/getDataFacilitateur.php",
        "dataSrc": ""
      },
      "columns" : [
        {"data": "nom"},
        {"data": "prenom"},
        {"data": "courriel"},
        {"data": "telephone"},
        {"data": "etat"},
        {"data": null,
        render: function(data, type, row){
          // Set la référence vers l'agenda d'un facilitateur
          return '<a href="../admin/disponibilite.php?id='+data.id+'" target="_blank"><span class="calendar"></span></a>';
        }},
        {"data": null,
        render: function(data, type, row){
          return '<span class="cog" id=modif'+data.id+' onclick="openModal()"></span>';
        }},
      ],
      "language":{
        "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
      },
      responsive: false,
    });

    $('#table_client').DataTable().draw();
    jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');

});
