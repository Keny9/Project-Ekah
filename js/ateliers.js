/**
 * Page JS pour la reservation
 *
 * Nom :         reservation.js
 * Catégorie :   JavaScript
 * Auteur :      Guillaume Côté
 * Version :     1.0
 * Date de la dernière modification : 2019-11-14
 */

var calendrier = null;



 //Fonction pour afficher les events du calendrier dans le calendrier
 function callAjax(){

   var idFacilitateur = null;
   idFacilitateur = $('.facilitateur-select').attr("id");
   // idFacilitateur = 1;

   if(idFacilitateur == null){
     idFacilitateur = -1;
   }

   duree = $('#duree').val();


   return $.ajax({
     type: "POST",
     async: false,
     dataType: "json",
     url: "../../php/script/Horaire/afficherAllEvents.php",
     data: {idFacilitateur: idFacilitateur, duree: duree}
   });
 }

 //Les event on click pour les boutons
 function calendrierReady(calendrier){
   $('#0').toggleClass("selectionne");

   //Les boutons pour naviger dans le calendrier
   $( "#next" ).click(function() {
     $("#dispo").empty();
     var $this = $(this);
     calendrier.navigate($this.data('calendar-nav'));
     changerBackground();
     enleverDayView();
     selectionnerJour();
   });
   $( "#prev" ).click(function() {
     $("#dispo").empty();
     var $this = $(this);
     calendrier.navigate($this.data('calendar-nav'));
     changerBackground();
     enleverDayView();
     selectionnerJour();
   });
 }

 //Load le calendrier avec tous les events (De base)
 function loadCalendrier(events){
   // console.log("Load");
  calendrier = $("#calendar").calendar(
     {
       tmpl_path: "../../utils/bootstrap-calendar/tmpls/",
       weekbox: false,
       events_source: events,

       onAfterViewLoad: function(view) {
         $('.page-header h3').text(this.getTitle());
       }
     });
     calendrierReady(calendrier);

     return calendrier;
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
           getAllDispo();
           $("#dispo").empty();

         }else{
           $('.selectionne').toggleClass("selectionne");
           $(this).toggleClass("selectionne");
           getAllDispo();

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

 //Afficher les dispo du facilitateur choisi
 function getEvents(){
   callAjax();
 }

//Toujours mettre après getEvents
 function apresAjax(){
   $.when(callAjax()).done(function(response){
     calendrier = loadCalendrier(response.result);
     calendrier.view();
     return calendrier;
   });
 }

 //get les dispo du jour selectionné pour les mettres dans un combobox
 function getAllDispo(){
   var idFacilitateur = null;
   var date = null;
   var duree = null;

   idFacilitateur = $('.facilitateur-select').attr("id");
   // idFacilitateur = 1;

   duree = $('#duree').val();

   if(idFacilitateur == null){
     idFacilitateur = -1;
   }

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
             date: date,
             duree: duree
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


//Page est chargé
$(document).ready(function() {
  apresAjax();

  getEvents();

  calendrier.view();

  changerBackground();
  enleverDayView();
  selectionnerJour();

  choisirFacilitateur();

});
