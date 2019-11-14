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
           $("#dispo").empty();

         }else{
           $('.selectionne').toggleClass("selectionne");
           $(this).toggleClass("selectionne");

           if($("#dispo").is(':empty')){
             $("#dispo").append($("<option></option>").val("-1").html("Aucune disponibilité"));
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
