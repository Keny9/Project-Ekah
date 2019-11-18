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

   let divFin = document.getElementById("AjoutActivite").getAttribute('value');
   for (i = 0; i < divFin; i++){
     let divSelection = document.getElementById("Activite-"+i);
     divSelection.classList.remove("selectionne");
   }

   if (x==divFin)
   {
     let divFin = document.getElementById("AjoutActivite");
     divFin.classList.add("selectionne");
     clearFields();
   }
   else{
     let divFin = document.getElementById("AjoutActivite");
     divFin.classList.remove("selectionne");
     let divSelection = document.getElementById("Activite-"+x);
         divSelection.classList.add("selectionne");
       remplirNom(x);
       remplirDescription(x);
       remplirType(x);
       remplirDuree(x);
       remplirQuestion(x);
       afficherDuree();
        }
 }

 async function afficherDuree(){
   await sleep(100);
   for(i=0;i<5;i++){
   let divSelectionner = document.getElementById("Duree-"+i);
   divSelectionner.classList.remove("selectionne");
 }
 let divVer=null;
     for(i=30;i<180;i+=30){
     if(document.getElementById("Durees-"+i) !== null){
     divVer = document.getElementById("Durees-"+i).value;

     if(divVer.includes("30")){
         let divSelectionner = document.getElementById("Duree-0");
         divSelectionner.classList.add("selectionne");
       }

       else if(divVer.includes("60")){
         let divSelectionner = document.getElementById("Duree-1");
         divSelectionner.classList.add("selectionne");
       }

     else if(divVer.includes("90")){
         let divSelectionner = document.getElementById("Duree-2");
         divSelectionner.classList.add("selectionne");
       }

     else if(divVer.includes("120")){
         let divSelectionner = document.getElementById("Duree-3");
         divSelectionner.classList.add("selectionne");
       }

     else if(divVer.includes("150")){
         let divSelectionner = document.getElementById("Duree-4");
         divSelectionner.classList.add("selectionne");
       }
     }
   }
 }

 function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}


 function clearFields(){
document.getElementById('nom').innerHTML = "";
document.getElementById('titre').innerHTML = "Nom du Service";
//document.getElementById("Type-"+2).attr('selected','selected');
document.getElementById('descriptionC').innerHTML = "";
document.getElementById('duree').innerHTML = "";
document.getElementById('nom').focus();
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

                    var titre=document.getElementById("titre");
                    var nom=document.getElementById("nom");
                    titre.innerHTML=data;
                    nom.innerHTML=data;
                    titre.innerHTML = titre.innerHTML.replace(/"/g, '');
                    titre.innerHTML = titre.innerHTML.replace(/u00e9/g, 'é');
                    titre.innerHTML = titre.innerHTML.replace(/\\/g, '');
                    titre.innerHTML = titre.innerHTML.replace(/u2019/g, '\'');
                    titre.innerHTML = titre.innerHTML.replace(/u00ea/g, 'ê');
                    titre.innerHTML = titre.innerHTML.replace(/u00e7/g, 'ç');
                    titre.innerHTML = titre.innerHTML.replace(/u00e0/g, 'à');
                    titre.innerHTML = titre.innerHTML.replace(/u00e2/g, 'â');
                    titre.innerHTML = titre.innerHTML.replace(/u00ee/g, 'î');
                    titre.innerHTML = titre.innerHTML.replace(/u00e8/g, 'è');
                    titre.innerHTML = titre.innerHTML.replace(/u00c9/g, 'É');
                    console.log(titre.innerHTML);
                    let titreValue = document.getElementById("titre").innerHTML;
                    document.getElementById("titre").innerHTML=titreValue;

                    nom.innerHTML = nom.innerHTML.replace(/"/g, '');
                    nom.innerHTML = nom.innerHTML.replace(/u00e9/g, 'é');
                    nom.innerHTML = nom.innerHTML.replace(/\\/g, '');
                    nom.innerHTML = nom.innerHTML.replace(/u2019/g, '\'');
                    nom.innerHTML = nom.innerHTML.replace(/u00ea/g, 'ê');
                    nom.innerHTML = nom.innerHTML.replace(/u00e7/g, 'ç');
                    nom.innerHTML = nom.innerHTML.replace(/u00e0/g, 'à');
                    nom.innerHTML = nom.innerHTML.replace(/u00e2/g, 'â');
                    nom.innerHTML = nom.innerHTML.replace(/u00ee/g, 'î');
                    nom.innerHTML = nom.innerHTML.replace(/u00e8/g, 'è');
                    nom.innerHTML = nom.innerHTML.replace(/u00c9/g, 'É');
                    console.log(nom.innerHTML);
                    let nomValue = document.getElementById("nom").innerHTML;
                    document.getElementById("nom").innerHTML=nomValue;

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
function remplirDuree(x){
  var id = x+1;
  myData={id:id};
  var url="../../php/script/Activite/remplirActiviteDuree.php";
              $(function($) {
                $.ajax({
                  url: url,
                  type:"POST",
                  async: false,
                  data: myData,
                  success: function(data) {
                    //console.log(data);
                    document.getElementById("duree").innerHTML=data;
                    document.getElementById("duree").innerHTML = document.getElementById("duree").innerHTML.replace(/"/g, '');
                    document.getElementById("duree").innerHTML = document.getElementById("duree").innerHTML.replace(/select/g, '');
                    document.getElementById("duree").innerHTML = document.getElementById("duree").innerHTML.replace(/<>/g, '');
                    document.getElementById("duree").innerHTML = document.getElementById("duree").innerHTML.replace(/V/g, '');
                    document.getElementById("duree").innerHTML = document.getElementById("duree").innerHTML.replace(/\\/g, '');
                    document.getElementById("duree").innerHTML = document.getElementById("duree").innerHTML.replace(/\//g, '');
                    document.getElementById("duree").innerHTML = document.getElementById("duree").innerHTML.replace(/&lt;/g, '');
                    document.getElementById("duree").innerHTML = document.getElementById("duree").innerHTML.replace(/&gt;rn/g, '');
                    document.getElementById("duree").innerHTML = document.getElementById("duree").innerHTML.replace(/option             &gt;<\/option><option>/g, '');
                    document.getElementById("duree").innerHTML = document.getElementById("duree").innerHTML.replace(/option             rn               <\/option><option>/g, '');
                  } ,
                  error: function() {
                    alert('Error occured');
                  }
                });
              });
}
function remplirQuestion(x){
  var id = x+1;
  myData={id:id};
  var url="../../php/script/Activite/remplirActiviteQuestionnaire.php";
              $(function($) {
                $.ajax({
                  url: url,
                  type:"POST",
                  async: false,
                  data: myData,
                  success: function(data) {

                    document.getElementById("questionnaire").innerHTML=data;
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/"/g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/select/g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/<>/g, '');

                    //document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/>/g, '');
                    //document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/&gt;/g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/V/g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/\\/g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/\//g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/&lt;/g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/rn/g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/&gt;rn/g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/option&gt;/g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/option&gt;              &gt;/g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/option              &gt;/g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/option             &gt;<\/option><option>/g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/option             rn               <\/option><option>/g, '');


                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/"/g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/u00e9/g, 'é');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/\\/g, '');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/u2019/g, '\'');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/u00ea/g, 'ê');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/u00e7/g, 'ç');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/u00e0/g, 'à');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/u00e2/g, 'â');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/u00ee/g, 'î');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/u00e8/g, 'è');
                    document.getElementById("questionnaire").innerHTML = document.getElementById("questionnaire").innerHTML.replace(/u00c9/g, 'É');


                    //console.log(document.getElementById("questionnaire").innerHTML);

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
                    document.getElementById("typeSelect").value=data;
                    document.getElementById("typeSelect").value = document.getElementById("typeSelect").value.replace(/"/g, '');

                    if(document.getElementById("typeSelect").value==1)
                    {
                    document.getElementById("type").selectedIndex="0";
                    }
                    else if(document.getElementById("typeSelect").value==2)
                    {
                      document.getElementById("type").selectedIndex="1";
                    }
                    else if(document.getElementById("typeSelect").value==3)
                    {
                        document.getElementById("type").selectedIndex="2";
                    }
                    else if(document.getElementById("typeSelect").value==4)
                    {
                      document.getElementById("type").selectedIndex="3";
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
  let divFin = document.getElementById("AjoutActivite").getAttribute('value');
  for (i = 0; i < divFin; i++){
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
    //window.location.reload();
}
 function enleveDuree(x){
   var hr = new XMLHttpRequest();
   var url="../../php/script/Activite/supprimerActiviteDuree.php";
   let divFin = document.getElementById("AjoutActivite").getAttribute('value');
   for (i = 0; i < divFin; i++){
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
     //window.location.reload();
   }

   function supprimerQuestion(){
     var hr = new XMLHttpRequest();
     var url="../../php/script/Question/supprimerQuestion.php";
     let divSelection = document.getElementById("idQuestionSupprimer").value;
     console.log(divSelection);
     var id=divSelection;
     let divFin = document.getElementById("AjoutActivite").getAttribute('value');
     for (i = 0; i < divFin; i++){
       let divSelection = document.getElementById("Activite-"+i);
       if(divSelection.classList.contains("selectionne")){
         var idActivite = i+1;
       }
     }
     console.log(divSelection);
     console.log(idActivite);

     $(function($) {
         $.ajax({
           url: url,
           type:"POST",
           async: false,
           data: {id: id,idQuestionnaire:idActivite},
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
       //window.location.reload();
     }

function ajouterQuestionnaire(){
let divFin = document.getElementById("AjoutActivite").getAttribute('value');
  for (i = 0; i < divFin; i++){
    let divSelection = document.getElementById("Activite-"+i);
    if(divSelection.classList.contains("selectionne")){
      var idActivite = i+1;
    }
  }
  idActivite = idActivite+1;
  var nomQuestionnaire = document.getElementById('nom').value;

  // Create our XMLHttpRequest object
  var hr = new XMLHttpRequest();
  // Create some variables we need to send to our PHP file
  var url="../../php/script/Question/ajouterQuestionnaire.php";

  $(function($) {
      $.ajax({
        url: url,
        type:"POST",
        async: false,
        data: {id:idActivite,nomQuestionnaire:nomQuestionnaire},
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
    ajouterActiviteQuestionnaire(idActivite);
    ajouterQuestion();
    ajouterQuestionQuestionnaire(idActivite);
}

function ajouterActiviteQuestionnaire(id){
  // Create our XMLHttpRequest object
  var hr = new XMLHttpRequest();
  // Create some variables we need to send to our PHP file
  var url="../../php/script/Question/ajouterActiviteQuestionnaire.php";

  $(function($) {
      $.ajax({
        url: url,
        type:"POST",
        async: false,
        data: {id:id},
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


function ajouterQuestion(){
  var id = document.getElementById('idQuestion').value;
  var question = document.getElementById('question').value;
  var idType = document.getElementById('typeQuestion').value;
  var nbLigne = document.getElementById('nbLigne').value;
  let divFin = document.getElementById("AjoutActivite").getAttribute('value');
  for (i = 0; i < divFin; i++){
    let divSelection = document.getElementById("Activite-"+i);
    if(divSelection.classList.contains("selectionne")){
      var idActivite = i+1;
    }
  }

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
    //window.location.reload();
}

function ajouterQuestionQuestionnaire(id){
  var idQues = document.getElementById('idQuestion').value;
  console.log(id);
  console.log(idQues);
  // Create our XMLHttpRequest object
  var hr = new XMLHttpRequest();
  // Create some variables we need to send to our PHP file
  var url="../../php/script/Question/ajouterQuestionQuestionnaire.php";
  var ordre=1;
  $(function($) {
      $.ajax({
        url: url,
        type:"POST",
        async: false,
        data: {id:id,idQues:idQues,ordre:ordre},
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
   let divFin = document.getElementById("AjoutActivite").getAttribute('value');
   // Create our XMLHttpRequest object
   var hr = new XMLHttpRequest();
   // Create some variables we need to send to our PHP file
   var url="../../php/script/Activite/ajouterActivite.php";

   var nom = document.getElementById('nom').value;
   var idType = document.getElementById('type').value;
   console.log(idType);
  var descriptionC = document.getElementById('descriptionC').value;
  var descriptionL = "LONGUE";
  var cout=0;
  for (i = 0; i <= divFin; i++){
    let divAjout = document.getElementById("AjoutActivite");
    if(divAjout.classList.contains("selectionne")){
      var id = i+1;
      $(function($) {
          $.ajax({
            url: url,
            type:"POST",
            async: false,
            data: {id:id,nom: nom, idType:idType, descriptionC: descriptionC, descriptionL: descriptionL, cout:cout},
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
        window.location.reload();
    }
  }

 }

 function modifier(){
   let divFin = document.getElementById("AjoutActivite").getAttribute('value');
   // Create our XMLHttpRequest object
   var hr = new XMLHttpRequest();
   // Create some variables we need to send to our PHP file
   var url="../../php/script/Activite/modifierActivite.php";

   var nom = document.getElementById('nom').value;
   var idType = document.getElementById('type').value;
   console.log(idType);
  var descriptionC = document.getElementById('descriptionC').value;
  var descriptionL = "LONGUE";
  for (i = 0; i < divFin; i++){
    let divSelection = document.getElementById("Activite-"+i);
    if(divSelection.classList.contains("selectionne")){
      var id = i+1;
      $(function($) {
          $.ajax({
            url: url,
            type:"POST",
            async: false,
            data: {id:id,nom: nom, idType:idType, descriptionC: descriptionC, descriptionL: descriptionL},
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
        window.location.reload();
    }
  }


 }
 function supprime(){
   let divFin = document.getElementById("AjoutActivite").getAttribute('value');
   // Create our XMLHttpRequest object
   var hr = new XMLHttpRequest();
   // Create some variables we need to send to our PHP file
   var url="../../php/script/Activite/supprimerActivite.php";
   for (i = 0; i < divFin; i++){
     let divSelection = document.getElementById("Activite-"+i);
     if(divSelection.classList.contains("selectionne")){
       var id = i+1;
       $(function($) {
           $.ajax({
             url: url,
             type:"POST",
             async: false,
             data: {id: id},
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
         window.location.reload();
     }
   }


}
