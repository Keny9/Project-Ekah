/**
 * Page consulter-reservation.php, un admin consulte toutes les réservations d'un client
 *
 * Nom :        consulter-reservation_client.js
 * Catégorie :   JS script
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-30
 */

$(document).ready(function(){
  selectedLine = null; //La ligne sélectionné

  $('#table_reservation_client').DataTable({
    "ajax":{
      "url": "../../php/script/Reservation/dataReservationClient.php?id="+CLIENT_ID,
      "dataSrc": ""
    },
    "columns" : [
      {"data": "nom"},
      {"data": "client"},
      {"data": "nom_lieu"},
      {"data": "date_rendez_vous"},
      {"data": "montant"},
      {"data": "facilitateur"}
    ],
    "language":{
      "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
    },
    responsive: false
  });
  jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');

  $('#table_reservation_client tbody').on('click', 'tr', function (){ //Lors du click sur une ligne du tableau
    $("#suivi").slideDown("slow"); //Afficher le block dui suivi avec une animation

    if(selectedLine != null){

      if(selectedLine.css("background-color") == $(this).css("background-color")){ //La meme ligne est sélectionné
        selectedLine.css("background-color", "#FFFFFF");
        selectedLine.hover(function(){ //Ajoute le hover qui disparraissait lors du click
          $(this).css("background-color", "whitesmoke");
          },function(){
          $(this).css("background-color", "#FFFFFF");
        });
        selectedLine = null;
        $("#suivi").slideUp("slow"); //Cacher le block dui suivi de la réservation avec animation
      }
      else{ //Une autre ligne est sélectionné
        selectedLine.css("background-color", "#FFFFFF");
        selectedLine.hover(function(){ //Ajoute le hover qui disparraissait lors du click
          $(this).css("background-color", "whitesmoke");
          },function(){
          $(this).css("background-color", "#FFFFFF");
        });
        $(this).css("background-color", "#b0bed9");
        $(this).off('mouseenter mouseleave'); //Enleve le hover pour que la ligne reste sélectionné
        selectedLine = $(this);
      }
    }
    else{ //Premiere fois qu'on selectionne une ligne
      document.querySelector('#suivi').scrollIntoView({ //Animation du scroll au block suivi (smooth)
        behavior: 'smooth'
      });
      $(this).off('mouseenter mouseleave'); //Enleve le hover pour que la ligne reste sélectionné
      $(this).css("background-color", "#b0bed9");
      selectedLine = $(this);
    }

  });

});
