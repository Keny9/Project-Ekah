var id_suivi = null;
var currentRowData = null;
$(document).ready(function(){
  //var id_suivi = null;
  selectedLine = null; //La ligne sélectionné

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
      {"data": "facilitateur"}
    ],
    "language":{
      "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
    },
    responsive: false
  });
  jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');

  $('#table_reservation tbody').on('click', 'tr', function (){ //Lors du click sur une ligne du tableau
    // Une ligne est selectionnée
    if (selectedLine != null){
      // Il y a eu changement dans les textareas
      if (!(currentRowData['fait'] == $('#fait').val() && currentRowData['commentaire'] == $('#commentaire').val())){
        // Demande de confirmation de sauvegarde
        if(confirm("Voulez-vous sauvegarder les changements?")){
          sauvegarder();
        }
      }
    }
    //Get les données de la réservation
    var index = $('#table_reservation').DataTable().cell(this, 0).index();
    var data = $('#table_reservation').DataTable().row(index.row ).data();
    id_suivi = data.id_suivi;

    // Met les infos du suivi dans les cases
    printSuivi(id_suivi);




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

function printSuivi(id_suivi){
  $.ajax({
    url: "../../php/script/Reservation/dataSuivi.php",
    data: {id_suivi : id_suivi},
    async:false,
    success: function(result){

      currentRowData = JSON.parse(result);
      $('#commentaire').val(currentRowData['commentaire']);
      $('#fait').val(currentRowData['fait']);
    },
  });
}

function updateSuivi(id_suivi, fait, commentaire){

  $.ajax({
    url: "../../php/script/Reservation/updateSuivi.php",
    data: {id_suivi: id_suivi, fait: fait, commentaire: commentaire},
    async:false,
    success: function(result){
      location.reload();
    },
  });
}

function getData(){
  var index = $('#table_reservation').DataTable().cell(selectedLine, 0).index();
  var data = $('#table_reservation').DataTable().row(index.row ).data();

  return data;
}

function sauvegarder(){
  var fait = $('#fait').val();
  var commentaire = $('#commentaire').val();
  updateSuivi(id_suivi, fait, commentaire);

}
