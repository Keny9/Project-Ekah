/**
 * Page JS pour la gestion de Reservation
 *
 * Nom :         gestionReservation.js
 * Catégorie :   JavaScript
 * Auteur :      William Gonin
 * Version :     1.0
 * Date de la dernière modification : 2019-09-30
 */
 function selectionne(x){
   for (i = 0; i <= 18; i++){
   //  let divTitre = document.getElementById("Titre-"+i);
   //  let divRabais = document.getElementById("Rabais-"+i);
     let divSelection = document.getElementById("Activite-"+i);
   //  divTitre.classList.remove("selectionne");
   //  divRabais.classList.remove("selectionne");
     divSelection.classList.remove("selectionne");
   }
   let divSelection = document.getElementById("Activite-"+x);
   //let divTitre = document.getElementById("Titre-"+x);
  // let divRabais = document.getElementById("Rabais-"+x);
       divSelection.classList.add("selectionne");
     //  divTitre.classList.add("selectionne");
     //  divRabais.classList.add("selectionne");

   //document.getElementById('nom').value = divTitre.innerHTML;
  //document.getElementById('rabais').value = divRabais.innerHTML;
 }
 function selectionneDuree(x){
   let divSelection = document.getElementById("Duree-"+x);
   if(divSelection.classList.contains("selectionne")){
     divSelection.classList.remove("selectionne");
   }
   else{
     divSelection.classList.add("selectionne");
   }
 }
