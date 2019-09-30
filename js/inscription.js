/**
 * Page JS pour inscription
 *
 * Nom :         inscription.js
 * Catégorie :   JavaScript
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-09-30
 */

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
