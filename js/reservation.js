/**
 * Page JS pour la reservation
 *
 * Nom :         reservation.js
 * Catégorie :   JavaScript
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-11
 */

$(document).ready(function() {
  var calendar = null;
  $(".block-photo-facilitateur").each(function(index) {
    $(this).on("click", function(){
      //Cliquer sur un facilitateur
      // console.log("click");

      if($(this).hasClass("facilitateur-select")){
        $(this).toggleClass("facilitateur-select");

        calendar = loadCalendrier(calendar);
        calendrierReady(calendar);
        // getEvents();
        changerBackground();
        enleverDayView();
        selectionnerJour();
      }else{
        $('.facilitateur-select').toggleClass("facilitateur-select");
        $(this).toggleClass("facilitateur-select");

        calendar = loadCalendrier(calendar);
        // calendrierReady(calendar);
        getEvents(calendar);
        changerBackground();
        enleverDayView();
        selectionnerJour();
      }
    });
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
  duree = document.getElementById("duree");

  //Input de la page reservation groupe
  serviceGroupe = document.getElementById("service-groupe");
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

  //Fermer la fenetre modale
  $('#close-demande').click(function(){
    $(this).css("display", "none");
    window.location.href = "/Project-Ekah/affichage/client/accueil_client.php";
  });

});


function clickSuivant(){
  $('#form-reservation').attr('action', '/Project-Ekah/php/script/Reservation/redirectQuestionnaire.php');
  $('#form-reservation').submit();
}

//Fonction si input vide qui montre que le champ est requis
 function inputRequired(e){
    e.style.borderBottomColor = "#ff0000";
    e.style.setProperty("--color", "#ff0000");
 }

 //Fonction pour montrer que le textArea est requis
 function textAreaRequired(e){
   e.style.borderColor = "#ff0000";
 }

//Valider le formulaire de réservation
 function valideReservation(){
   if(siSelectVide(service) || siSelectVide(duree)){
     indiqueChampVideReservation();
     window.scrollTo({ top: 0, behavior: 'smooth' });
     return false;
   }
   return true;
 }

//Lors de l'envoi d'une demande pour une reservation de groupe.
function sendEmail(){

  if(siSelectVide(serviceGroupe) || siVide(entreprise) || siVide(nom) || siVide(courriel) || siVide(telephone) || siVide(vous) || siVide(message)){
    indiqueChampVideGroupe();
    return false;
  }

  document.getElementById("confirmerDemandeGroupe").disabled = true;
  window.scrollTo(0,-300);
  $("#loader").css("display", "block");
  $("#form-reservation-groupe").css("display", "none");

  $.ajax({
    url: '../../php/script/Reservation/demandeGroupe.php',
    method: 'POST',
    dataType: 'json',
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data: {
      service: serviceGroupe.options[serviceGroupe.selectedIndex].value,
      entreprise: entreprise.value,
      nom: nom.value,
      courriel: courriel.value,
      telephone: telephone.value,
      poste: poste.value,
      vous: vous.value,
      message: message.value
    }, success: function(response){
      console.log(response);
      if(response.status == "success"){
        $("#loader").css("display", "none");
        $('#modal-demande').css("display", "block");
        $("#form-reservation-groupe").css("display", "block");
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

   if(siSelectVide(serviceGroupe)){
    inputRequired(serviceGroupe);
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
  if(siSelectVide(duree)){inputRequired(duree);}
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
