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
     let divSelection = document.getElementById("Activite-"+i);
     divSelection.classList.remove("selectionne");
   }
   let divSelection = document.getElementById("Activite-"+x);
       divSelection.classList.add("selectionne");
       remplir(x);

 }

function remplir(x){

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

 function ajouter(){
   // Create our XMLHttpRequest object
   var hr = new XMLHttpRequest();
   // Create some variables we need to send to our PHP file
   var url="../../php/script/Activite/ajouterActivite.php";
   for (i = 0; i <= 18; i++){
     let divSelection = document.getElementById("Activite-"+i);
     if(divSelection.classList.contains("selectionne")){
       var id = i+1;
     }
   }
   var nom = document.getElementById('nom').value;
   var idType = document.getElementById('type').value;
   console.log(idType);
  var descriptionC = document.getElementById('descriptionC').value;
  var descriptionL = "LONGUE";

   $(function($) {
       $.ajax({
         url: url,
         type:"POST",
         async: false,
         data: {id:id,nom: nom, idType:idType, descriptionC: descriptionC, descriptionL: descriptionL},
         success: function(data) {
           console.log(data);
           if(!data){
               alert("La modification s'est effectuée avec succès!");
           }
           else{
             //  document.getElementById('erreurIdentifiant').innerHTML="L'identifiant existe déjà";
               console.log(data);
           }
         } ,
         error: function() {
           alert('Error occured');
         }
       });
     });
 }

 function modifier(){
   // Create our XMLHttpRequest object
   var hr = new XMLHttpRequest();
   // Create some variables we need to send to our PHP file
   var url="../../php/script/Activite/modifierActivite.php";
   for (i = 0; i <= 18; i++){
     let divSelection = document.getElementById("Activite-"+i);
     if(divSelection.classList.contains("selectionne")){
       var id = i+1;
     }
   }
   var nom = document.getElementById('nom').value;
   var idType = document.getElementById('type').value;
   console.log(idType);
  var descriptionC = document.getElementById('descriptionC').value;
  var descriptionL = "LONGUE";

   $(function($) {
       $.ajax({
         url: url,
         type:"POST",
         async: false,
         data: {id:id,nom: nom, idType:idType, descriptionC: descriptionC, descriptionL: descriptionL},
         success: function(data) {
           console.log(data);
           if(!data){
               alert("La modification s'est effectuée avec succès!");
           }
           else{
             //  document.getElementById('erreurIdentifiant').innerHTML="L'identifiant existe déjà";
               console.log(data);
           }
         } ,
         error: function() {
           alert('Error occured');
         }
       });
     });
 }
 function supprime(){
   // Create our XMLHttpRequest object
   var hr = new XMLHttpRequest();
   // Create some variables we need to send to our PHP file
   var url="../../php/script/Activite/supprimerActivite.php";
   for (i = 0; i <= 19; i++){
     let divSelection = document.getElementById("Activite-"+i);
     if(divSelection.classList.contains("selectionne")){
       var id = i+1;
     }
   }

   $(function($) {
       $.ajax({
         url: url,
         type:"POST",
         async: false,
         data: {id: id},
         success: function(data) {
           console.log(data);
           if(!data){
               alert("La modification s'est effectuée avec succès!");
           }
           else{
             //  document.getElementById('erreurIdentifiant').innerHTML="L'identifiant existe déjà";
               console.log(data);
           }
         } ,
         error: function() {
           alert('Error occured');
         }
       });
     });
}
