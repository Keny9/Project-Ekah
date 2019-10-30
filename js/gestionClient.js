$(document).ready(function(){
  selectedLine = null; //La ligne sélectionné

$('#table_client').DataTable({
    "ajax":{
      "url": "../../php/script/Client/getDataClient.php",
      "dataSrc": ""
    },
    "columns" : [
      {"data": "nom"},
      {"data": "prenom"},
      {"data": "courriel"},
      {"data": "telephone"},
      {"data": "date_inscription"},
      {"data": null,
      render: function(data, type, row){
        return '<a href="../admin/consulter-reservation-client.php?id=5" target="_blank"><span class="calendar"></span></a>';
      }},
    ],
    "language":{
      "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
    },
    responsive: false,
  });

  $('#table_client').DataTable().draw();
  jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');

  $('#table_client tbody').on('click', 'tr', function (){ //Lors du click sur une ligne du tableau
    $("#profil").slideDown("slow"); //Afficher le block du profil avec une animation

    var index = $('#table_client').DataTable().cell(this, 0).index();
    var data = $('#table_client').DataTable().row(index.row ).data();
    console.log(data);
    console.log(selectedLine);

    $("#nomClient").text(data.prenom + " " + data.nom);

    if(selectedLine != null){

      if(selectedLine.css("background-color") == $(this).css("background-color")){ //La meme ligne est sélectionné
        selectedLine.css("background-color", "#FFFFFF");
        selectedLine = null;
        $("#profil").slideUp("slow"); //Cacher le block du profil avec animation
      }
      else{ //Une autre ligne est sélectionné
        selectedLine.css("background-color", "#FFFFFF");
        $(this).css("background-color", "#b0bed9");
        selectedLine = $(this);
      }
    }
    else{ //Premiere fois qu'on selectionne une ligne
      document.querySelector('#profil').scrollIntoView({ //Animation du scroll au block profil (smooth)
        behavior: 'smooth'
      });
      $(this).css("background-color", "#b0bed9");
      selectedLine = $(this);
    }

  });

});

//Change la couleur du texte lorsqu'on sélectionne un élément de la liste mois
function changeMois(){
  var list = document.getElementById("mois");
  var selectedValue = list.options[list.selectedIndex].value;

  if(selectedValue != "vide"){
    list.style.color = "#000000";
  }
}

//Change la couleur du texte lorsqu'on sélectionne un élément de la liste pays
function changePays(){
  var list = document.getElementById("pays");
  var selectedValue = list.options[list.selectedIndex].value;

  if(selectedValue != "vide"){
    list.style.color = "#000000";
  }
}
