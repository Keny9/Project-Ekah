/**
 * Page JS pour la reservation
 *
 * Nom :         reservation.js
 * Catégorie :   JavaScript
 * Auteur :      Karl Boutin & Guillaume Côté
 * Version :     1.0
 * Date de la dernière modification : 2019-10-11
 */

 var calendrier = null;


 $(function(ready){
   // Set le onChange du select pour les services
   $("#service").change(function() {
     $.ajax({url: "/Project-Ekah/php/script/Client/reservationInputComplementaire.php",
     data: {service_id : $("#service").val()},
     success: function(result){
       $("#question-complementaire").css("display", result);
     }});
   });
 });

 //Fonction pour afficher les events du calendrier dans le calendrier
 function callAjax(){

   var idFacilitateur = null;
   idFacilitateur = $('.facilitateur-select').attr("id");
   // idFacilitateur = 1;

   if(idFacilitateur == null){
     idFacilitateur = -1;
   }

   duree = $('#duree').val();
   region = $('#region').val();
   id_service = $('#service').val();

   // console.log(idFacilitateur + " " + duree + " " + region);

   return $.ajax({
     type: "POST",
     async: false,
     dataType: "json",
     url: "../../php/script/Horaire/afficherAllEvents.php",
     data: {idFacilitateur: idFacilitateur, duree: duree, region: region, service: id_service}
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
       language: 'fr-FR',
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
   var region = null;

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

   region = $('#region').val();
   id_service = $('#service').val();


   $.ajax({
     type: "POST",
     async: false,
     dataType: "json",
     url: "../../php/script/Horaire/afficherAllHoraireSelectionne.php",
     data: {idFacilitateur: idFacilitateur,
             date: date,
             duree: duree,
             region: region,
             service: id_service
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

//Click pour choisir un facilitateur
function choisirFacilitateur(){

  $('#facilitateur').on('click', function(){
    let $this = $('.facilitateur-select');
    // console.log($this.length);
    if($this.length > 0){
      console.log("Pas null");
      $this.toggleClass("facilitateur-select");
      getEvents();
      apresAjax();
      calendrier.view();
      changerBackground();
      enleverDayView();
      selectionnerJour();
      $("#dispo").empty();
    }
  });


  $(".block-photo-facilitateur").each(function(index) {

    $(this).on("click", function(){
      $("#dispo").empty();

      //Cliquer sur un facilitateur
      if($(this).hasClass("facilitateur-select")){
        //Fonctionne (enlever le facilitateur choisi si on reclique dessu)
        $(this).toggleClass("facilitateur-select");
        getEvents();
        apresAjax();
        calendrier.view();
        changerBackground();
        enleverDayView();
        selectionnerJour();
      }else{
        $('.facilitateur-select').toggleClass("facilitateur-select");
        $(this).toggleClass("facilitateur-select");
        getEvents();
        apresAjax();
        calendrier.view();
        changerBackground();
        enleverDayView();
        selectionnerJour();
      }
    });
  });
}

 ///////////////////////////////////////////////
//Page est chargé
$(document).ready(function() {
  apresAjax();                //Envent listener When sur la fonction ajax
  getEvents();                //Appel la fonction ajax
  calendrier.view();          //Refresh le calendrier (les events)
  changerBackground();        //Change le css
  enleverDayView();           //Enleve la possibilité d'aller sur le calendrier en mode "jour"
  selectionnerJour();         //Permettre de cliquer sur une journée

  choisirFacilitateur();      //Events pour choisir le facilitateur

  $("#service").change(function() {
    getEvents();
    apresAjax();
    calendrier.view();
    changerBackground();
    enleverDayView();
    selectionnerJour();
    $("#dispo").empty();
  });

  $("#duree").change(function() {
    getEvents();
    apresAjax();
    calendrier.view();
    changerBackground();
    enleverDayView();
    selectionnerJour();
    $("#dispo").empty();
  });

  $("#region").change(function() {
    getEvents();
    apresAjax();
    calendrier.view();
    changerBackground();
    enleverDayView();
    selectionnerJour();
    $("#dispo").empty();
  });

  listInput = document.querySelectorAll("input, textarea, select");

  listInput.forEach(function(e){
    e.addEventListener("focusin", function(){
      if(e.tagName == "TEXTAREA" || e.tagName == "textarea"){
        e.style.borderColor = "#f0592a";
      }
      else{
        e.style.borderBottomColor = "#f0592a";
      }
      e.style.transition = "all 0.4s";
    });
  });

  listInput.forEach(function(e){
    e.addEventListener("focusout", function(){
      if(e.tagName == "TEXTAREA" || e.tagName == "textarea"){
        e.style.borderColor = "#9E9E9E";
      }
      else{
        e.style.borderBottomColor = "#9E9E9E";
      }
    });
  });

  //Input de la page reservation
  service = document.getElementById("service");
  dureeInput = document.getElementById("duree");

  //Input de la page reservation groupe
  serviceGroupeInput = document.getElementById("serviceGroupe");
  entreprise = document.getElementById("entreprise");
  nom = document.getElementById("nom");
  courriel = document.getElementById("courriel");
  telephone = document.getElementById("telephone");
  poste = document.getElementById("poste");
  vous = document.getElementById("vous");
  message = document.getElementById("message");

  $(window).keydown(function(event){ //S'assure que le user ne peut pas envoyer le form avec un enter
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });

  // FORM SUBMIT
  $('#btnSuivant').click(function(){
    if(valideReservation()){
        clickSuivant();
    }
    return;
  });

  // fenetre modale?
  //Fermer la fenetre modale
  $('#close-demande').click(function(){
    $(this).css("display", "none");
    window.location.href = "/Project-Ekah/affichage/client/accueil_client.php";
  });

  $("#btn-confirm-reservation").click(closeModal); //Click pour fermer la fenetre modal

});


// TODO: Guillaume
function clickSuivant(){
  let facilitateur_id = $('.facilitateur-select').attr("id");
  let date_rendez_vous = $('.selectionne').children().data('calDate');
  let heure = $('#dispo').find('option:selected').text();
  let id_dispo = $('#dispo').find('option:selected').val();
  let id_region = $('#region').find('option:selected').val();
  let duree = $('#duree').find('option:selected').val();


  if(facilitateur_id == null){
    facilitateur_id = -1;
  }
  if(date_rendez_vous == null){
    date_rendez_vous = "2000-01-01";
  }

  date_rendez_vous = date_rendez_vous + " " + heure;
  // console.log(date_rendez_vous);


  // let urlRedirectQuestionnaire = '/Project-Ekah/php/script/Reservation/redirectQuestionnaire.php?';
  let urlRedirectQuestionnaire = 'paiement.php?';
  // TODO: Insérer les bonnes valeurs pour facilitateur_id et date_rendez_vous
  let paramRedirectQuestionnaire = 'facilitateur_id='+facilitateur_id+'&date_rendez_vous='+date_rendez_vous+'&id_dispo='+id_dispo+'&id_region='+id_region+'&duree='+duree;
  urlRedirectQuestionnaire += paramRedirectQuestionnaire;
  $('#form-reservation').attr('action', urlRedirectQuestionnaire);
  $('#form-reservation').submit();
}

//Fonction si input vide qui montre que le champ est requis
 function inputRequired(e){
   console.log(e);
    e.style.borderBottomColor = "#ff0000";
    e.style.setProperty("--color", "#ff0000");
 }

 //Fonction pour montrer que le textArea est requis
 function textAreaRequired(e){
   e.style.borderColor = "#ff0000";
 }

//Valider le formulaire de réservation
 function valideReservation(){
   if(siSelectVide(service) || siSelectVide(dureeInput) || siRegionVide() || calendrierVide()){
     indiqueChampVideReservation();
     document.querySelector('.reservation').scrollIntoView({ //Animation scroll smooth au debut du form
       behavior: 'smooth'
     });
     return false;
   }
   return true;
 }

//Lors de l'envoi d'une demande pour une reservation de groupe.
function sendEmail(){
  serviceGroupeInput = document.getElementById("serviceGroupe");
  if(siSelectVide(serviceGroupeInput) || siVide(entreprise) || siVide(nom) || siVide(courriel) || siVide(telephone) || siVide(vous) || siVide(message)){
    indiqueChampVideGroupe();
    return false;
  }

  document.getElementById("confirmerDemandeGroupe").disabled = true;
  window.scrollTo(0,-300);
  $("#loader").css("display", "block");
  $("#form-reservation-groupe").css("display", "none");

  $.ajax({
    url: '../../php/script/Reservation/mail_groupe.php',
    method: 'POST',
    dataType: 'json',
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data: {
      service: serviceGroupeInput.options[serviceGroupeInput.selectedIndex].value,
      entreprise: entreprise.value,
      nom: nom.value,
      courriel: courriel.value,
      telephone: telephone.value,
      poste: poste.value,
      vous: vous.value,
      message: message.value
    }, success: function(response){
      console.log(response);
      if(response['success']['response'] == "Message has been sent"){
        $("#loader").css("display", "none");
        $('#modal-demande').css("display", "block");
        $("#form-reservation-groupe").css("display", "block");
      }
      else{
        $("#loader").css("display", "none");
        alert("Il y a eu un problème lors de l'envoi du courriel.");
        window.location.href = "/Project-Ekah/affichage/client/reservation_groupe.php";
      }
    }, error: function(response){
      console.log(response);
      $("#loader").css("display", "none");
      alert("Il y a eu un problème lors de l'envoi du courriel.");
      document.getElementById("confirmerDemandeGroupe").disabled = false;
      $("#form-reservation-groupe").css("display", "block");
    }
  });
}

//Indique quels champs sont vides à l'utilisateur
 function indiqueChampVideGroupe(){

   if(siSelectVide(serviceGroupeInput)){
    inputRequired(serviceGroupeInput);
   }

   if(siVide(entreprise)){
     inputRequired(entreprise);
   }

   if(siVide(nom)){
     inputRequired(nom);
   }

   if(siVide(courriel)){
     inputRequired(courriel);
   }

   if(siVide(telephone)){
     inputRequired(telephone);
   }

   if(siVide(vous)){
     textAreaRequired(vous);
   }

   if(siVide(message)){
     textAreaRequired(message);
   }
 }

//Indique les champos invalide dans la page de reservation
function indiqueChampVideReservation(){
  if(siSelectVide(service)){inputRequired(service);}
  if(siSelectVide(dureeInput)){inputRequired(dureeInput);}
  if(siRegionVide()){inputRequired(document.getElementById("region"));}
  if(calendrierVide()){inputRequired(document.getElementById("dispo"));}
}

//Verifie si le champ de l'element est vide
function siVide(e){
  if(e.value == null || e.value == ""){
    return true;
  }
  return false;
}

//Verifie si la selection de la liste est vide
 function siSelectVide(e){
   if(e.options[e.selectedIndex].value == null || e.options[e.selectedIndex].value == "" || e.options[e.selectedIndex].value == "vide"){
     return true;
   }
   return false;
 }

 //Verifie si la région a été choisi
  function siRegionVide(){
    e = document.getElementById("region");
    if(e.options[e.selectedIndex].value == null || e.options[e.selectedIndex].value == 0 || e.options[e.selectedIndex].value == "0"){
      return true;
    }
    return false;
  }

//Vérifie si une date et heure à bien été choisi
 function calendrierVide(){
   e = $('#dispo');
   if(e.find('option:selected').val() == "" || e.find('option:selected').val() == -1 || e.find('option:selected').val() == null){
     return true;
   }
   return false;
 }

//Lorsque l'item de la liste change
 function changeListe(e){
   var selectedValue = e.options[e.selectedIndex].value;
   var option = document.getElementsByClassName("select-section");

   if(selectedValue != "vide"){
     e.style.color = "#000000";
     for(i = 0;i < option.length; i++){
       option[i].style.color = "#000000";
     }
   }
 }

 //Check si on veut choisir un specialiste ou pas du tout
 function check(){
   if(document.getElementById("facilitateur").checked == true){
     document.getElementById("photo-facilitateur").style.display = "block";
   }
   else{
     document.getElementById("photo-facilitateur").style.display = "none";
   }
 }

 //Fermer la fenetre modale de modification d'une réservation
 function closeModal(){
   $("#modal-complete-reservation").css("display", "none");
 }

 //Ouvrir la fenêtre modal
 function openModal(){
   $("#modal-complete-reservation").css("display", "block");
 }
