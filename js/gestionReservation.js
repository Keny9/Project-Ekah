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
       remplirNom(x);
       remplirDescription(x);
       remplirType(x);

 }

function remplirNom(x){
  var id = x+1;
  myData={id:id};
  var url="../../php/script/Activite/remplirActiviteNom.php";
              $(function($) {
                $.ajax({
                  url: url,
                  type:"POST",
                  async: false,
                  data: myData,
                  success: function(data) {

                    console.log(data);
                    document.getElementById("titre").innerHTML=data;
                    document.getElementById("nom").innerHTML=data;
                    document.getElementById("titre").innerHTML = document.getElementById("titre").innerHTML.replace(/"/g, '');
                    document.getElementById("titre").innerHTML = document.getElementById("titre").innerHTML.replace(/u00e9/g, 'é');
                    document.getElementById("titre").innerHTML = document.getElementById("titre").innerHTML.replace(/\\/g, '');
                    document.getElementById("titre").innerHTML = document.getElementById("titre").innerHTML.replace(/u2019/g, '\'');
                    document.getElementById("titre").innerHTML = document.getElementById("titre").innerHTML.replace(/u00ea/g, 'ê');
                    document.getElementById("titre").innerHTML = document.getElementById("titre").innerHTML.replace(/u00e7/g, 'ç');
                    document.getElementById("titre").innerHTML = document.getElementById("titre").innerHTML.replace(/u00e0/g, 'à');
                    document.getElementById("titre").innerHTML = document.getElementById("titre").innerHTML.replace(/u00e2/g, 'â');
                    document.getElementById("titre").innerHTML = document.getElementById("titre").innerHTML.replace(/u00ee/g, 'î');
                    document.getElementById("titre").innerHTML = document.getElementById("titre").innerHTML.replace(/u00e8/g, 'è');
                    document.getElementById("titre").innerHTML = document.getElementById("titre").innerHTML.replace(/u00c9/g, 'É');

                    document.getElementById("nom").innerHTML = document.getElementById("nom").innerHTML.replace(/"/g, '');
                    document.getElementById("nom").innerHTML = document.getElementById("nom").innerHTML.replace(/u00e9/g, 'é');
                    document.getElementById("nom").innerHTML = document.getElementById("nom").innerHTML.replace(/\\/g, '');
                    document.getElementById("nom").innerHTML = document.getElementById("nom").innerHTML.replace(/u2019/g, '\'');
                    document.getElementById("nom").innerHTML = document.getElementById("nom").innerHTML.replace(/u00ea/g, 'ê');
                    document.getElementById("nom").innerHTML = document.getElementById("nom").innerHTML.replace(/u00e7/g, 'ç');
                    document.getElementById("nom").innerHTML = document.getElementById("nom").innerHTML.replace(/u00e0/g, 'à');
                    document.getElementById("nom").innerHTML = document.getElementById("nom").innerHTML.replace(/u00e2/g, 'â');
                    document.getElementById("nom").innerHTML = document.getElementById("nom").innerHTML.replace(/u00ee/g, 'î');
                    document.getElementById("nom").innerHTML = document.getElementById("nom").innerHTML.replace(/u00e8/g, 'è');
                    document.getElementById("nom").innerHTML = document.getElementById("nom").innerHTML.replace(/u00c9/g, 'É');


                  } ,
                  error: function() {
                    alert('Error occured');
                  }
                });
              });
}
function remplirDescription(x){
  var id = x+1;
  myData={id:id};
  var url="../../php/script/Activite/remplirActiviteDescription.php";
              $(function($) {
                $.ajax({
                  url: url,
                  type:"POST",
                  async: false,
                  data: myData,
                  success: function(data) {

                    console.log(data);
                    document.getElementById("descriptionC").innerHTML=data;
                    document.getElementById("descriptionC").innerHTML = document.getElementById("descriptionC").innerHTML.replace(/"/g, '');
                    document.getElementById("descriptionC").innerHTML = document.getElementById("descriptionC").innerHTML.replace(/u00e9/g, 'é');
                    document.getElementById("descriptionC").innerHTML = document.getElementById("descriptionC").innerHTML.replace(/\\/g, '');
                    document.getElementById("descriptionC").innerHTML = document.getElementById("descriptionC").innerHTML.replace(/u2019/g, '\'');
                    document.getElementById("descriptionC").innerHTML = document.getElementById("descriptionC").innerHTML.replace(/u00ea/g, 'ê');
                    document.getElementById("descriptionC").innerHTML = document.getElementById("descriptionC").innerHTML.replace(/u00e7/g, 'ç');
                    document.getElementById("descriptionC").innerHTML = document.getElementById("descriptionC").innerHTML.replace(/u00e0/g, 'à');
                    document.getElementById("descriptionC").innerHTML = document.getElementById("descriptionC").innerHTML.replace(/u00e2/g, 'â');
                    document.getElementById("descriptionC").innerHTML = document.getElementById("descriptionC").innerHTML.replace(/u00ee/g, 'î');
                    document.getElementById("descriptionC").innerHTML = document.getElementById("descriptionC").innerHTML.replace(/u00e8/g, 'è');
                    document.getElementById("descriptionC").innerHTML = document.getElementById("descriptionC").innerHTML.replace(/u00c9/g, 'É');

                  } ,
                  error: function() {
                    alert('Error occured');
                  }
                });
              });
}
function remplirType(x){
  var id = x+1;
  myData={id:id};
  var url="../../php/script/Activite/remplirActiviteType.php";
              $(function($) {
                $.ajax({
                  url: url,
                  type:"POST",
                  async: false,
                  data: myData,
                  success: function(data) {

                    if(data=="1")
                    {
                        console.log(data);
                      document.getElementById("type").value="En Atelier";
                    }
                    else if(data=="2")
                    {
                        console.log(data);
                      document.getElementById("type").value="Services à Domicile";
                    }
                    else if(data=="3")
                    {
                        console.log(data);
                      document.getElementById("type").value="En ligne";
                    }
                    else if(data=="4")
                    {
                        console.log(data);
                      document.getElementById("type").value="En Groupe";
                    }

                  } ,
                  error: function() {
                    alert('Error occured');
                  }
                });
              });
}
 function selectionneDuree(x){

   let divSelection = document.getElementById("Duree-"+x);

   if(divSelection.classList.contains("selectionne")){
     divSelection.classList.remove("selectionne");
     enleveDuree(x);
   }
   else{
     divSelection.classList.add("selectionne");
     ajoutDuree(x);
   }
 }
function ajoutDuree(x){
  // Create our XMLHttpRequest object
  var hr = new XMLHttpRequest();
  // Create some variables we need to send to our PHP file
  var url="../../php/script/Activite/ajouterActiviteDuree.php";
  for (i = 0; i <= 18; i++){
    let divSelection = document.getElementById("Activite-"+i);
    if(divSelection.classList.contains("selectionne")){
      var id = i+1;
    }
  }
  var idDuree=x+1;

  $(function($) {
      $.ajax({
        url: url,
        type:"POST",
        async: false,
        data: {idActivite:id,idDuree: idDuree},
        success: function(data) {
          console.log(data);
          if(!data){
              //alert("La modification s'est effectuée avec succès!");
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
 function enleveDuree(x){
   var hr = new XMLHttpRequest();
   var url="../../php/script/Activite/supprimerActiviteDuree.php";
   for (i = 0; i <= 19; i++){
     let divSelection = document.getElementById("Activite-"+i);
     if(divSelection.classList.contains("selectionne")){
       var id = i+1;
     }
   }
   var idDuree=x+1;

   $(function($) {
       $.ajax({
         url: url,
         type:"POST",
         async: false,
         data: {idActivite: id, idDuree:idDuree},
         success: function(data) {
           if(!data){
               //alert("La modification s'est effectuée avec succès!");
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

function ajouterQuestion(){
  var id = document.getElementById('idQuestion').value;
  var question = document.getElementById('question').value;
  var idType = document.getElementById('typeQuestion').value;
  var nbLigne = document.getElementById('nbLigne').value;
  // Create our XMLHttpRequest object
  var hr = new XMLHttpRequest();
  // Create some variables we need to send to our PHP file
  var url="../../php/script/Question/ajouterQuestion.php";

  $(function($) {
      $.ajax({
        url: url,
        type:"POST",
        async: false,
        data: {id:id,idType:idType, question:question, nbLigne: nbLigne},
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
