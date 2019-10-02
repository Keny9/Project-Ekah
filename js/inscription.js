/**
 * Page JS pour inscription
 *
 * Nom :         inscription.js
 * Catégorie :   JavaScript
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-09-30
 */

//Lorsque le document est prêt
window.onload = function(){
  prenom = document.getElementById("prenom");
  nom = document.getElementById("nom");
  courriel = document.getElementById("courriel");
  telephone = document.getElementById("telephone");
  motDePasse = document.getElementById("motDePasse");

  prenom.addEventListener("blur", function(){inputRequired(prenom);});
  nom.addEventListener("blur", function(){inputRequired(nom);});
  courriel.addEventListener("blur", function(){inputRequired(courriel);});
  telephone.addEventListener("blur", function(){inputRequired(telephone);});
  motDePasse.addEventListener("blur", function(){inputRequired(motDePasse);});
};

//Fonction si input vide qui montre que le champ est requis
 function inputRequired(e){
   if(siVide(e)){
      e.style.borderBottomColor = "#ff0000";
      e.placeholder = e.placeholder + " requis *";
      e.style.setProperty("--color", "#ff0000");
   }
 }

 //Change la couleur du texte lorsqu'on sélectionne un élément de la liste mois
 function changeMois(){
   var list = document.getElementById("mois");
   var selectedValue = list.options[list.selectedIndex].value;

   if(selectedValue != "vide"){
     list.style.color = "#000000";
   }
 }

//Change la couleur du texte lorsqu'on sélectionne un élément de la liste pays
 function changePays(){
   var list = document.getElementById("pays");
   var selectedValue = list.options[list.selectedIndex].value;

   if(selectedValue != "vide"){
     list.style.color = "#000000";
   }
 }

 //Fonction qui valide le formulaire avant de submit
 function validerFormInscription(){

   if(siVide(prenom) || siVide(nom) || siVide(courriel) || siVide(telephone) || siVide(motDePasse)){
     return false;
   }


   return true;
 }

 //Verifie si le champ de l'element est vide
 function siVide(e){
   if(e.value == null || e.value == ""){
     return true;
   }
   return false;
 }
