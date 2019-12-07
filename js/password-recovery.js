/**
* Script js pour password-recovery
*
* Nom :         password-reset.js
* Catégorie :   Script js
* Auteur :      Karl Boutin
* Version :     1.0
* Date de la dernière modification : 2019-11-27
*/

$(document).ready(function(){
  courriel = document.getElementById("courriel");

});

//valider le formulaire pour la recuperation de mot de passe
function validerFormRecovery(){

  if(siVide(courriel)){
    indiqueChampVide();
    return false;
  }

  if(!verifieCourriel(courriel)){
    indiqueChampInvalide();
    return false;
  }

  // Change l'attribut Action du Formulaire
  $('#form-reco-pass').attr('action', '/Project-Ekah/php/script/Login/passwordReset.php');

  return true;
}

//Fonction si input vide qui montre que le champ est requis
 function inputRequired(e){
    e.style.borderBottomColor = "#ff0000";
    e.classList.add('redPlaceholder');
 }

//Verifier que le courriel est valide
 function verifieCourriel(e){
   var courrielRegex = /^\S+@\S+\.\S+$/;
   return courrielRegex.test(e.value);
 }

//Indiquer le champ vide
 function indiqueChampVide(){

   if(siVide(courriel)){
     inputRequired(courriel);
   }

 }

 //Indique quels champs sont invalides a l'utilisateur
  function indiqueChampInvalide(){

    if(!verifieCourriel(courriel)){
      inputRequired(courriel);
      courriel.value = null;
      courriel.placeholder = "Courriel invalide *";
    }

  }

 //Verifie si le champ de l'element est vide
 function siVide(e){
   if(e.value == null || e.value == ""){
     return true;
   }
   return false;
 }
