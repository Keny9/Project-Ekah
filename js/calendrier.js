var calendrier = null;
$(document).ready(function() {

  calendrier = loadCalendrier(calendrier);
  calendrierReady(calendrier);

  getEvents(calendrier);

  console.log(calendrier);

  getAllDispo();

  calendrier.view();

  changerBackground();
  enleverDayView();
  selectionnerJour();

});

//Les event on click pour les boutons
function calendrierReady(calendrier){
  $('#0').toggleClass("selectionne");

  //Les boutons pour naviger dans le calendrier
  $( "#next" ).click(function() {
    var $this = $(this);
    calendrier.navigate($this.data('calendar-nav'));
    changerBackground();
    enleverDayView();
    selectionnerJour();
  });
  $( "#prev" ).click(function() {
    var $this = $(this);
    calendrier.navigate($this.data('calendar-nav'));
    changerBackground();
    enleverDayView();
    selectionnerJour();
  });
}

//Load le calendrier avec tous les events (De base)
function loadCalendrier(calendrier){
 calendrier = $("#calendar").calendar(
    {
      tmpl_path: "../../utils/bootstrap-calendar/tmpls/",
      weekbox: false,
      events_source: "../../php/script/Horaire/afficherAllHoraire.php",

      onAfterViewLoad: function(view) {
        $('.page-header h3').text(this.getTitle());
      }
    });
    return calendrier;
}


function selectionnerJour(){
  //Lorsqu'on clique sur une journée, la selectionne (ajout class selectionne)
    $( ".cal-day-inmonth" ).each(function(index) {
      $(this).on("click", function(){
        //Si on clique clique sur lui selectionné
        // console.log("click");
        if($(this).hasClass("selectionne")){
          $(this).toggleClass("selectionne");
          getAllDispo();
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

    //Enlever le CSS inutile pour la réservation (css today)
    var $today = $(".cal-day-today");
    $today.removeClass("cal-day-today");

    var $todayTxt = $today.find("span");
    $todayTxt.css("color", "#333333");
    $todayTxt.css("font-size", "1.2em");
}


function getEvents(calendrier){
  var idFacilitateur = null;
  var date = null;

  idFacilitateur = $('.facilitateur-select').attr("id");
  idFacilitateur = 1;

  // console.log($('.selectionne').children().data('calDate'));

  if(idFacilitateur == null){
    idFacilitateur = -1;
  }

  $.ajax({
    type: "POST",
    async: false,
    dataType: "json",
    url: "../../php/script/Horaire/afficherAllEvents.php",
    data: {idFacilitateur: idFacilitateur
         },
    success: function(data){

      // console.log([data]);
      calendrier = $("#calendar").calendar(
         {
           tmpl_path: "../../utils/bootstrap-calendar/tmpls/",
           weekbox: false,
           events_source: [data],

           onAfterViewLoad: function(view) {
             $('.page-header h3').text(this.getTitle());
           }
         });

        // console.log(calendrier);
        return calendrier;
    },
    error: function (jQXHR, textStatus, errorThrown) {
        console.warn(jQXHR.responseText);
        alert("An error occurred whilst trying to contact the server: " + jQXHR.status + " " + textStatus + " " + errorThrown);
    }
  });
}


//get les dispo du jour selectionné pour les mettres dans un combobox
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
