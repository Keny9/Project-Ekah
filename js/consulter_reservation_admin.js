/**
 * Page consulter-reservation.php, un admin consulte les réservations
 *
 * Nom :        consulter-reservation.php
 * Catégorie :   Page
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-30
 */


var id_suivi = null;
var currentRowData = null;

$(document).ready(function(){
  selectedLine = null; //La ligne sélectionné
  var today = new Date(); //Obtenir la date d'aujourd'hui
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0');
  var yyyy = today.getFullYear();

  today = yyyy + '-' + mm + '-' + dd;

  table = $('#table_reservation').DataTable({
    "ajax":{
      "url": "../../php/script/Reservation/dataReservationAdmin.php",
      "dataSrc": ""
    },
    "columns" : [
      {"data": "nom"},
      {"data": null,
      render: function(data, type, row){
        return '<a class="link-client" href="../admin/gestion-client.php?client='+data.client_id+'" target="_blank">'+ data.client +'</a>';
      }},
      {"data": "nom_lieu"},
      {"data": "date_rendez_vous"},
      {"data": "montant"},
      {"data": "facilitateur"},
      {"data": null,
    render: function(data, type, row){
      return '<span class="cog" id='+data.id+' onclick="openModal()"></span>';
    }},
    ],
    "language":{
      "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
    },
    responsive: false,
  });
  jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');

// Sur un clique d'une row
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
    date = data.date_rendez_vous.slice(0,10);

    /*if(date < today){ //Choix de la couleur selon si le rendez-vous est déja passé ou non
      color = "#cefdce";
    }
    else{                   //A REVOIR
      color = "#FFFFFF";
    }*/

    id_suivi = data.id_suivi;

    // Met les infos du suivi dans les cases
    printSuivi(id_suivi);

    $("#suivi").slideDown("slow"); //Afficher le block du suivi avec une animation

    if(selectedLine != null){

      if(selectedLine.css("background-color") == $(this).css("background-color")){ //La meme ligne est sélectionné
        selectedLine.css("background-color", "#FFFFFF");
        selectedLine.hover(function(){ //Ajoute le hover qui disparraissait lors du click
          $(this).css("background-color", "whitesmoke");
          },function(){
          $(this).css("background-color", "#FFFFFF");
        });
        selectedLine = null;
        $("#suivi").slideUp("slow"); //Cacher le block du suivi de la réservation avec animation
      }
      else{ //Une autre ligne est sélectionnée
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

  setTimeout(function(){
    table.rows().every( function ( rowIdx, tableLoop, rowLoop ) { //Loop au travers de chaque ligne de dataTable
        var data = this.data();
        var row = table.row(rowIdx);
        date = data.date_rendez_vous.slice(0,10);

        tr = table.row(rowIdx).node(); //Recupere le tr (la ligne en html)

        if(date < today){
         tr.setAttribute("id", "row" + rowIdx);
         tr.style.backgroundColor = "#cefdce";

         $("#row" + rowIdx).hover(function(){ //Effet de hover sur les lignes
           $(this).css("background-color", "whitesmoke");
           },function(){
           $(this).css("background-color", "#cefdce");
         });
        }
    });
  }, 500);

setTimeout(function(){
  listCog = document.querySelectorAll(".cog"); //Liste de tous les boutons modifier
  listCog.forEach(function(e){ //Pour chaque bouton ajouter le click
    e.addEventListener("click", openModal);
  });
  },500);

  $("#btn-annuler").click(closeModal);


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

// Retourne les données de la case selectionnée
function getData(){
  var index = $('#table_reservation').DataTable().cell(selectedLine, 0).index();
  var data = $('#table_reservation').DataTable().row(index.row).data();

  return data;
}

// Sauvegarde les changements dans la BD
function sauvegarder(){
  var fait = $('#fait').val();
  var commentaire = $('#commentaire').val();
  updateSuivi(id_suivi, fait, commentaire);
}

//Fermer la fenetre modale de modification d'une réservation
function closeModal(){
  $("#modal-modif-reservation").css("display", "none");
}

//Ouvrir la fenêtre modal
function openModal(){
  $("#modal-modif-reservation").css("display", "block");
}
