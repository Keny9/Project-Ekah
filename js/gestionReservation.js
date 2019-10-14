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
