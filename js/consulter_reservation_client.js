$(document).ready(function(){
  selectedLine = null; //La ligne sélectionné

  $('#table_reservation_client').DataTable({
    "ajax":{
      "url": "../../php/script/Reservation/dataReservationClient.php",
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
        selectedLine = null;
        $("#suivi").slideUp("slow"); //Cacher le block dui suivi de la réservation avec animation
      }
      else{ //Une autre ligne est sélectionné
        selectedLine.css("background-color", "#FFFFFF");
        $(this).css("background-color", "#b0bed9");
        selectedLine = $(this);
      }
    }
    else{ //Premiere fois qu'on selectionne une ligne
      document.querySelector('#suivi').scrollIntoView({ //Animation du scroll au block suivi (smooth)
        behavior: 'smooth'
      });
      $(this).css("background-color", "#b0bed9");
      selectedLine = $(this);
    }

  });

});
