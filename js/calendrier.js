$(document).ready(function() {
  //Les boutons pour naviger dans le calendrier
  $( "#month" ).click(function() {
    var $this = $(this);
    calendar.view($this.data('calendar-view'));
    enleverDayView();
  });
  $( "#next" ).click(function() {
    var $this = $(this);
    calendar.navigate($this.data('calendar-nav'));
    enleverDayView();
  });
  $( "#prev" ).click(function() {
    var $this = $(this);
    calendar.navigate($this.data('calendar-nav'));
    enleverDayView();
  });

//Changer la couleur du background si y'a des dispos
  $.each($('.events-list'), function(index, $event){
    var $this = $(this);
    $this.parent().css("background-color", "red");
  });

  enleverDayView();

  //Enlever le CSS inutile pour la réservation
  var $today = $(".cal-day-today");
  $today.css("background-color", "#FFFFFF");

  var $todayTxt = $today.find("span");
  $todayTxt.css("color", "#333333");
  $todayTxt.css("font-size", "1.2em");

  getAllDispo();
});

//Enleve le click sur une journée pour afficher la view "Day"
function enleverDayView(){
  // console.log("Enlever");
  var i = 0;
  $.each($('.cal-cell'), function(index, $event){
    var $this = $(this);
    $this.attr('id', i);
    $this.prop("onclick", null).off("click");
    i++;
  });

  $.each($('.pull-right'), function(index, $event){
    var $this = $(this);
    $this.prop("onclick", null).off("click");
  });
}


//get tous les dispo pour les mettres dans un combobox
function getAllDispo(idFacilitateur){
  idFacilitateur = 1;

  $.ajax({
    type: "POST",
    async: false,
    dataType: "json",
    url: "../../php/script/Horaire/afficherAllHoraire.php",
    data: {idFacilitateur: idFacilitateur
         },
    success: function(data){
        console.log(data);
        //Puisque les dispo sont en Ms je vais devoir les convertir
        $("#dispo").empty();

        var time = data.result[0].date_debut;
        var date = new Date(time);
        alert(date.toString());

        $.each(data.result, function (index) {
          $("#dispo").append($("<option></option>").val(this['id']).html(this['title']));
        });

    },
    error: function (jQXHR, textStatus, errorThrown) {
        console.warn(jQXHR.responseText);
        alert("An error occurred whilst trying to contact the server: " + jQXHR.status + " " + textStatus + " " + errorThrown);
    }
  });
}


//Covertir les mois anglais en chiffre
function convertirMois(mois){
  switch(mois) {
  case "January,":
    return "01";
  case "February,":
    return "02";
  case "March,":
    return "03";
  case "April,":
    return "04";
  case "May,":
    return "05";
  case "June,":
    return "06";
  case "July,":
    return "07";
  case "August,":
    return "08";
  case "September,":
    return "09";
  case "October,":
    return "10";
  case "November,":
    return "11";
  case "December,":
    return "12";
  }
}
