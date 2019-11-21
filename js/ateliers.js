/**
 * Page JS pour les ateliers
 *
 * Nom :         ateliers.js
 * Catégorie :   JavaScript
 * Auteur :      Guillaume Côté
 * Version :     1.0
 * Date de la dernière modification : 2019-11-14
 */

var calendar = null;

 //Les event on click pour les boutons
 function calendrierReady(){
   $('#0').toggleClass("selectionne");

   //Les boutons pour naviger dans le calendrier
   $( "#next" ).click(function() {
     $("#dispo").empty();
     var $this = $(this);
     calendar.navigate($this.data('calendar-nav'));
     changerBackground();
     enleverDayView();
     selectionnerJour();
   });
   $( "#prev" ).click(function() {
     $("#dispo").empty();
     var $this = $(this);
     calendar.navigate($this.data('calendar-nav'));
     changerBackground();
     enleverDayView();
     selectionnerJour();
   });
 }

 //Permet de sélectionner une date
 function selectionnerJour(){
   //Lorsqu'on clique sur une journée, la selectionne (ajout class selectionne)
     $( ".cal-day-inmonth" ).each(function(index) {
       $(this).on("click", function(){
         //Si on clique clique sur lui selectionné
         // console.log("click");
         if($(this).hasClass("selectionne")){
           $(this).toggleClass("selectionne");
           closeModal();
         }else{
           $('.selectionne').toggleClass("selectionne");
           $(this).toggleClass("selectionne");

           if($(this).find('div').hasClass('events-list')){
             openModal();
           }
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


//Page est chargé
$(document).ready(function() {
  calendrierReady();
  changerBackground();
  enleverDayView();
  selectionnerJour();


});

//Fermer la fenetre modale de modification d'une réservation
function closeModal(){
  $("#modal").css("display", "none");
  $('.selectionne').toggleClass('selectionne');
}

//Ouvrir la fenêtre modal
function openModal(){
  getInfoModal();
  $("#modal").css("display", "block");
}

//Fermer la fenetre modale de modification d'une réservation
function closeModalFin(){
  $("#modal-inscription").css("display", "none");
  $('.selectionne').toggleClass('selectionne');
}

//Ouvrir la fenêtre modal
function openModalFin(){
  $("#modal-inscription").css("display", "block");
}


//Recevoir les infos à mettre dans la modal
function getInfoModal(){
  let id = $('.selectionne').find('a').data("eventId");
  $.ajax({
    type: "POST",
    async: false,
    dataType: "json",
    url: "../../php/script/Horaire/afficherInfoAtelierModal.php",
    data: {"id": id},
    success: function(data){
        bool = true;
        // console.log(data);

        $('#modal-titre').text(data.title);
        $('#modal-description').text(data.description);
        $('#modal-date').text("Date : " + data.date);


        $('#modal-start').text("Heure : " + data.heure);
        $('#modal-fin').text("Duree : " + data.duree + " minutes");

        $('#modal-adresse').text("Lieu : " + data.emplacement);
        $('#modal-prix').text("Prix : " + data.prix + "$");

    },
    error: function (jQXHR, textStatus, errorThrown) {
        alert("An error occurred whilst trying to contact the server: " + jQXHR.status + " " + textStatus + " " + errorThrown);
    }
  });
  return bool;
}

//S'inscrire à l'atelier
function inscrireAtelier(){
  let id = $('.selectionne').find('a').data("eventId");
  $.ajax({
    type: "POST",
    async: false,
    dataType: "json",
    url: "../../php/script/Reservation/inscrireAtelier.php",
    data: {"id": id},
    success: function(data){
        bool = true;
        closeModal();
        openModalFin();
    },
    error: function (jQXHR, textStatus, errorThrown) {
        alert("An error occurred whilst trying to contact the server: " + jQXHR.status + " " + textStatus + " " + errorThrown);
    }
  });
  return bool;
}
