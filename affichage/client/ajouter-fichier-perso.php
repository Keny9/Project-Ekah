<?php
/*
* Page à insérer qui contient une fenêtre modale pour ajouter des fichiers perso
*
*
*
*
*
* Auteur : Maxime Lussier
*/
 ?>


   <head>
     <meta charset="utf-8">
     <title></title>

     <link rel="stylesheet" href="../../css/main.css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

     <link rel="stylesheet" href="../../css/modal.css">


     <script type="text/javascript" src="../../js/jquery-3.4.1.slim.js"></script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   </head>

   <!-- Trigger the modal with a button -->
   <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ajouter-fichier-perso-modal">Open Modal</button>
   <!-- Modal -->
   <div id="ajouter-fichier-perso-modal" class="modal fade" role="dialog">
     <div class="modal-dialog">

       <!-- Modal content-->
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title">Mes fichiers</h4>
           <button type="button"id="ajouter-fichier-perso-btn-close" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
           <p>Vous souhaitez ajouter des fichiers personnels à votre dossier?</p>

           <span>Formulaire médical</span>
           <div class="custom-file">
             <input type="file" class="custom-file-input" id="formulaire-medical-fichier" name="fichier_un">
             <label class="custom-file-label" id="formulaire-medical-label" for="formulaire-medical-fichier">Choisir fichier...</label>
             <div class="invalid-feedback">Example invalid custom file feedback</div>
           </div>






<!--
           <span>Insérez votre mot de passe <b>actuel</b></span>
           <input type="password" name="mot-de-passe-actuel" id="mot-de-passe-actuel" value="">
           <span>Insérez votre <b>nouveau</b> mot de passe</span>
           <input type="text" name="mot-de-passe-nouveau" id="mot-de-passe-nouveau" value="">
           <span>Confirmez votre nouveau mot de passe</span>
           <input type="text" class="mb-2" name="mot-de-passe-confirmation" id="mot-de-passe-confirmation" value="">
-->
         </div>
         <div class="modal-footer">
           <button type="button" id="ajouter-fichier-perso-btn-sauvegarder"class="btn btn-default mr-auto" data-dismiss="modal">Sauvegarder le changement</button>
           <button type="button" id="ajouter-fichier-perso-btn-fermer"class="btn btn-default" data-dismiss="modal">Fermer</button>
         </div>
       </div>
     </div>
   </div>

   <script type="text/javascript">
    // Ce script affiche le nom du fichier dans le label pour la selection
    var fichier = document.getElementById('formulaire-medical-fichier');
    var label = document.getElementById('formulaire-medical-label');
    var nomfichier;
    fichier.addEventListener('change', function(){
       let nomfichierFullPath = fichier.value;

       if(nomfichierFullPath){
         nomfichierFullPath = nomfichierFullPath.replace(/\//g, '\\');
         let nomfichierSplit = nomfichierFullPath.split("\\");
         nomfichier = nomfichierSplit[nomfichierSplit.length-1];
         alert(nomfichier);
         label.innerHTML = nomfichier;
       }
       else{
         label.innerHTML="Choisir fichier...";
       }
     });
   </script>

   <script type="text/javascript">
   let btn_sauvegarder = document.getElementById('ajouter-fichier-perso-btn-sauvegarder');

   btn_sauvegarder.addEventListener('click', function(event){
     var xhr = new XMLHttpRequest();

     // Setup our listener to process completed requests
     xhr.onload = function () {

       // Process our return data
       if (xhr.status >= 200 && xhr.status < 300) {
         // This will run when the request is successful
         console.log('success!', xhr);
       } else {
         // This will run when it's not
         console.log('The request failed!');
       }

       // This will run either way
       // All three of these are optional, depending on what you're trying to do
       console.log('This always runs...');
     };

     // Lorsque la xhr recoit une réponse
     xhr.onreadystatechange = function(){
       if (this.readyState == 4 && this.status == 200) {
         console.log(this.responseText);
         alert("done");
       }
     };

     // Create and send a GET request
     // The first argument is the post type (GET, POST, PUT, DELETE, etc.)
     // The second argument is the endpoint URL
  //   let nom_fichier = nomfichier;
     xhr.open('GET',
              '../../php/script/Client/ajouterFichierPerso.php?nom_fichier='+nomfichier,
              false
              );
     xhr.send();
   });
   </script>
