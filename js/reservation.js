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
  listInput = document.querySelectorAll("input, textarea");


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

  service = document.getElementById("service-groupe");
  entreprise = document.getElementById("entreprise");
  nom = document.getElementById("nom");
  courriel = document.getElementById("courriel");
  telephone = document.getElementById("telephone");
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
    clickSuivant();
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

//Lors de l'envoi d'une demande pour une reservation de groupe.
function sendEmail(){

  if(siSelectVide(service) && siVide(entreprise) && siVide(nom) && siVide(courriel) && siVide(telephone) && siVide(vous) && siVide(message)){
    indiqueChampVideGroupe();
    return false;
  }

  $.ajax({
    url: '../../php/script/Reservation/demandeGroupe.php',
    method: 'POST',
    dataType: 'json',
    data: {
      service: service.options[service.selectedIndex].value,
      entreprise: entreprise.value,
      nom: nom.value,
      courriel: courriel.value,
      telephone: telephone.value,
      vous: vous.value,
      message: message.value
    }, success: function(response){
      console.log("Success");
      console.log(response);
    }, error: function(response){
      console.log("Error :");
      console.log(response);
    }
  });
  console.log("What happened...");
  return false;
}

//Indique quels champs sont vides à l'utilisateur
 function indiqueChampVideGroupe(){

   if(siSelectVide(service)){
    inputRequired(service);
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

 function changeListe(e){
   var selectedValue = e.options[e.selectedIndex].value;

   if(selectedValue != "vide"){
     e.style.color = "#000000";
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
