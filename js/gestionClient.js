var index = null;
var data = null;
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

// Sur un clique d'une ligne
  $('#table_client tbody').on('click', 'tr', function (){ //Lors du click sur une ligne du tableau
    $("#profil").slideDown("slow"); //Afficher le block du profil avec une animation
    // Une ligne est selectionnée
    if(selectedLine != null){
      // Il y a eu changement dans les textareas
      if(profilUpdated()){
        // Demande de confirmation de sauvegarde
        if(confirm("Voulez-vous sauvegarder les changements?")){
          updateProfil();
        }
      }
    }

    //Get les données du client et de son profil
    index = $('#table_client').DataTable().cell(this, 0).index();
    data = $('#table_client').DataTable().row(index.row ).data();
    console.log(data);
    //console.log(selectedLine);

    // Set le titre du suivi
    $("#nomClient").text(data.prenom + " " + data.nom);

    // Prépare les données pour la date de naissance
    var annee = jour = date_naissance = null;
    var mois = "vide";
    if(data.date_naissance != null) { // Date naissance n'est pas null
      var date_naissance = data.date_naissance;
      var date_array = date_naissance.split("-");
      var annee = date_array[0];
      var mois = date_array[1];
      var jour = date_array[2];

      if (mois[0] == 0){ // La valeur du mois commence par un 0  (01, 02, ..)
        // Enlève le 0
        mois = mois.slice(1);
      }
    }
    // Set les données du profil du client séléctionné dans les cases
    $('#jour').val(jour);
    $('#mois').val(mois);
    $('#annee').val(annee);
    $('#noAdresse').val(data.no_civique);
    $('#rue').val(data.rue);
    $('#ville').val(data.ville);
    $('#codePostal').val(data.code_postal);
    $('#pays').val(data.pays);
    $('#telephone').val(data.telephone);
    $('#courriel').val(data.courriel);

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

// Update le profil du client et reload la page
function updateProfil(){
  var date_naissance = null; // TODO: arranger ça

  var dataClient = {
    id_client: data.id,
    id_adresse: data.id_adresse,
    telephone: $('#telephone').val(),
    date_naissance: date_naissance,
    no_civique: $('#noAdresse').val(),
    rue: $('#rue').val(),
    ville: $('#ville').val(),
    code_postal: $('#codePostal').val(),
    pays: $('#pays').val(),
    courriel: $('#courriel').val()
  };

  var dataClientJson = JSON.stringify(dataClient);

  $.ajax({
    url: "../../php/script/Client/updateProfilClient.php",
    data: {data: dataClientJson},
    async:false,
    success: function(result){
      console.log(result);
      location.reload();
    },
  });
}

// Retourne si les champs du profil ont été changés
function profilUpdated(){
  bool = false;
  let lTelephone = $('#telephone').val();
  let lDataTelephone = data.telephone;
  if(!lTelephone) lTelephone = null;
  if(!lDataTelephone) lDataTelephone = null;

  // TODO: comparer la date de naissance
  if(!($('#noAdresse').val() == data.no_civique)){bool = true;}
  if(!($('#rue').val() == data.rue)){bool = true;}
  if(!($('#ville').val() == data.ville)){bool = true;}
  if(!($('#codePostal').val() == data.code_postal)){;bool = true;}
  if(!($('#pays').val() == data.pays)){bool = true;}
  if(!(lTelephone == lDataTelephone)){bool = true;}
  if(!($('#courriel').val() == data.courriel)){bool = true;}

  return bool;
}

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
