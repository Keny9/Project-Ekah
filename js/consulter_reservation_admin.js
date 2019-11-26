/**
 * Page consulter-reservation.php, un admin consulte les réservations de tous les clients
 *
 * Nom :        consulter-reservation_admin.js
 * Catégorie :   script JS
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-30
 */


var id_suivi = null;
var currentRowData = null;
var idReservation = null;

$(document).ready(function(){
  selectedLine = null; //La ligne sélectionné
  today = new Date(); //Obtenir la date d'aujourd'hui
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
      {"data": null,
      render: function(data, type, row){
        return '<span class="cancel" id=cancel'+data.id+' onclick="openCancelModal('+data.id+');"></span>';
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

    id_suivi = data.id_suivi;

    // Met les infos du suivi dans les cases
    printSuivi(id_suivi);

    $("#suivi").slideDown("slow"); //Afficher le block du suivi avec une animation

    if(selectedLine != null){

      if(selectedLine.css("background-color") == $(this).css("background-color")){ //La meme ligne est sélectionné
        couleurLigne(data,selectedLine);
        selectedLine = null;
        selectedData = null;
        $("#suivi").slideUp("slow"); //Cacher le block du suivi de la réservation avec animation
      }
      else{ //Une autre ligne est sélectionnée
        couleurLigne(selectedData,selectedLine);
        $(this).css("background-color", "#b0bed9");
        $(this).off('mouseenter mouseleave'); //Enleve le hover pour que la ligne reste sélectionné
        selectedLine = $(this); //Devient l'ancienne ligne
        selectedData = data; //Les anciennes données
      }
    }
    else{ //Premiere fois qu'on selectionne une ligne
      document.querySelector('#suivi').scrollIntoView({ //Animation du scroll au block suivi (smooth)
        behavior: 'smooth'
      });
      $(this).off('mouseenter mouseleave'); //Enleve le hover pour que la ligne reste sélectionné
      $(this).css("background-color", "#b0bed9");
      selectedLine = $(this); //Devient l'ancienne ligne pour le prochain clic
      selectedData = data;  //Les anciennes données pour le prochain clic
    }

  });

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

        child[7].children[0].onclick = function(){alreadyDone();}; //Fenêtre modal

        $("#row" + rowIdx).hover(function(){ //Effet de hover sur les lignes
          $(this).css("background-color", "whitesmoke");
          },function(){
          $(this).css("background-color", "#cefdce");
        });
      }
      else if(data.id_etat == 2){
        tr.setAttribute("id", "row" + rowIdx);
        tr.style.backgroundColor = "#ffc2b3";

        child[7].children[0].onclick = function(){alreadyCancelled();}; //Fenêtre modal

        $("#row" + rowIdx).hover(function(){ //Effet de hover sur les lignes
          $(this).css("background-color", "whitesmoke");
          },function(){
          $(this).css("background-color", "#ffc2b3");
        });
      }
     });
  }, 250);

  setTimeout(function(){
    listCog = document.querySelectorAll(".cog"); //Liste de tous les boutons modifier
    listCog.forEach(function(e){ //Pour chaque bouton ajouter le click
      e.addEventListener("click", openModal);
    });
    },500);

    $("#btn-annuler").click(closeModal);
    $("#btn-annuler-cancel").click(closeCancelModal);
    $("#btn-confirm-cancel").click(cancelReservation);
    $("#btn-already-cancel").click(closeAlreadyModal);
    $("#btn-already-done").click(closeAlreadyDoneModal);
});

//Afficher les informations du suivi dans les textarea
function printSuivi(id_suivi){
  $.ajax({
    url: "../../php/script/Reservation/dataSuivi.php",
    data: {id_suivi : id_suivi},
    async:false,
    success: function(result){

      currentRowData = JSON.parse(result);
      $('#commentaire').val(currentRowData.commentaire);
      $('#fait').val(currentRowData.fait);
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

//Change la couleur du texte lorsqu'on sélectionne un élément de la liste mois
function changeFacilitateur(){
  var list = document.getElementById("facilitateur");
  var selectedValue = list.options[list.selectedIndex].value;

  if(selectedValue != "vide"){
    list.style.color = "#000000";
  }
}

//Ouvrir fenetre modal en lien avec l'annulation d'une réservation
// id: L'id de la reservation sélectionner pour l'annulation
function openCancelModal(id){
  $("#modal-cancel-reservation").css("display", "block");
  idReservation = id;
}

//Fermer fenetre modal en lien avec l'annulation d'une réservation
function closeCancelModal(){
  $("#modal-cancel-reservation").css("display", "none");
  idReservation = null;
}

//La réservation est déjà annulé
function alreadyCancelled(){
  $("#modal-cancel-already").css("display", "block");
}

//La réservation est déjà complété
function alreadyDone(){
  $("#modal-done-already").css("display", "block");
}

//La réservation est déjà annulé : Fermer fenetre modale.
function closeAlreadyModal(){
  $("#modal-cancel-already").css("display", "none");
}

//La réservation est déjà complété : Fermer fenetre modale.
function closeAlreadyDoneModal(){
  $("#modal-done-already").css("display", "none");
}

//Fonction qui annule une réservations
function cancelReservation(){
  $.ajax({
    url: "../../php/script/Reservation/cancelReservation.php",
    type: "post",
    data: {id_reservation: idReservation},
    async:false,
    success: function(result){
      location.reload();
    }
  });
}

//Chosir la bonne couleur pour une ligne
function couleurLigne(data, line){
  if(data.date_rendez_vous.slice(0,10) < today && data.id_etat == 1 ){
    line.css("background-color", "#cefdce");
    line.hover(function(){ //Ajoute le hover qui disparraissait lors du click
      $(this).css("background-color", "whitesmoke");
      },function(){
      line.css("background-color", "#cefdce");
    });
  }
  else if(data.id_etat == 2){
    line.css("background-color", "#ffc2b3");
    line.hover(function(){ //Ajoute le hover qui disparraissait lors du click
      $(this).css("background-color", "whitesmoke");
      },function(){
      line.css("background-color", "#ffc2b3");
    });
  }
  else{
    line.css("background-color", "#FFFFFF");
    line.hover(function(){ //Ajoute le hover qui disparraissait lors du click
      $(this).css("background-color", "whitesmoke");
      },function(){
      line.css("background-color", "#FFFFFF");
    });
  }
}
