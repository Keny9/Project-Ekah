$(document).ready(function() {


  $('#0').toggleClass("selectionne");


  //Les boutons pour naviger dans le calendrier
  $( "#next" ).click(function() {
    var $this = $(this);
    calendar.navigate($this.data('calendar-nav'));
    changerBackground();
    enleverDayView();
    selectionnerJour();
  });
  $( "#prev" ).click(function() {
    var $this = $(this);
    calendar.navigate($this.data('calendar-nav'));
    changerBackground();
    enleverDayView();
    selectionnerJour();
  });


  changerBackground();
  enleverDayView();
  selectionnerJour();

  getAllDispo();
});


function selectionnerJour(){
  //Lorsqu'on clique sur une journée, la selectionne (ajout class selectionne)
    $( ".cal-day-inmonth" ).each(function(index) {
      $(this).on("click", function(){
        //Si on clique clique sur lui selectionné
        // console.log("click");
        if($(this).hasClass("selectionne")){
          $(this).toggleClass("selectionne");
        }else{
          $('.selectionne').toggleClass("selectionne");
          $(this).toggleClass("selectionne");

          getAllDispo();
        }
      });
  });
}

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

//Change les couleurs de background (vert quand dispo et enleve vert pour today)
function changerBackground(){
  //Changer la couleur du background si y'a des dispos
    $.each($('.events-list'), function(index, $event){
      var $this = $(this);
      $this.parent().css("background-color", "#e8fde7");
    });

    //Enlever le CSS inutile pour la réservation
    var $today = $(".cal-day-today");
    $today.removeClass("cal-day-today");

    var $todayTxt = $today.find("span");
    $todayTxt.css("color", "#333333");
    $todayTxt.css("font-size", "1.2em");
}



//get tous les dispo pour les mettres dans un combobox
function getAllDispo(){
  var idFacilitateur = 1;
  var date = null;

  // console.log($('.selectionne').children().data('calDate'));
  date = $('.selectionne').children().data('calDate');

  if(date == null){
    date = "2000-01-01";
  }


  $.ajax({
    type: "POST",
    async: false,
    dataType: "json",
    url: "../../php/script/Horaire/afficherAllHoraireSelectionne.php",
    data: {idFacilitateur: idFacilitateur,
            date: date
         },
    success: function(data){
        // console.log(data);
        //Puisque les dispo sont en Ms je vais devoir les convertir
        $("#dispo").empty();

        $.each(data.result, function (index) {
          var time = data.result[index].date_debut;
          var date = new Date(time);
          // alert(date.toString());

          var heure = date.getHours() + ":" + date.getMinutes();

          if(date.getHours().toString().length == 1){
            heure = "0" + heure;
          }
          if(date.getMinutes().toString().length == 1){
            heure = heure + "0";
          }

          $("#dispo").append($("<option></option>").val(this['id']).html(heure));
        });

    },
    error: function (jQXHR, textStatus, errorThrown) {
        console.warn(jQXHR.responseText);
        alert("An error occurred whilst trying to contact the server: " + jQXHR.status + " " + textStatus + " " + errorThrown);
    }
  });
}
