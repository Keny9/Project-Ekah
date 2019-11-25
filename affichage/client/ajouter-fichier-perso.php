<?php
/*
* Page à insérer qui contient une fenêtre modale pour ajouter des fichiers perso
*
* Auteur : Maxime Lussier
*/
 ?>


   <!-- <head> -->
     <!-- <meta charset="utf-8"> -->
     <!-- <title></title> -->

     <!-- <link rel="stylesheet" href="../../css/main.css"> -->
     <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

     <!-- <link rel="stylesheet" href="../../css/modal.css"> -->


     <!-- <script type="text/javascript" src="../../js/jquery-3.4.1.slim.js"></script> -->


     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
     <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
   <!-- </head> -->

   <!-- Trigger the modal with a button -->
   <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ajouter-fichier-perso-modal">Open Modal</button> -->
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
         </div>
         <div class="modal-footer">
           <button type="button" id="ajouter-fichier-perso-btn-sauvegarder"class="btn btn-default mr-auto" data-dismiss="modal">Sauvegarder le changement</button>
           <button type="button" id="ajouter-fichier-perso-btn-fermer"class="btn btn-default" data-dismiss="modal">Fermer</button>
         </div>
       </div>
     </div>
   </div>

   <script type="text/javascript">
     $(document).ready(function(){
      $(document).on('change', '#formulaire-medical-fichier', function(){
        var fichier_medical = document.getElementById("formulaire-medical-fichier");
        var label = document.getElementById('formulaire-medical-label');
        var name = fichier_medical.value;

        if (name){
          var ext = name.split('.').pop().toLowerCase();
          if(jQuery.inArray(ext, ['pdf']) == -1)
          {
            alert("Format de fichier invalide. Doit être un pdf.");
            fichier_medical.value = '';
            label.innerHTML="Choisir fichier...";
            return;
          }
          var oFReader = new FileReader();
          oFReader.readAsDataURL(fichier_medical.files[0]);
          var f = fichier_medical.files[0];
          var fsize = f.size||f.fileSize;
          if(fsize > 2000000)
          {
            alert("La taille du fichier est trop grosse.");
            fichier_medical.value = '';
            label.innerHTML="Choisir fichier...";
          }
          else
          {
            let nomfichierFullPath = fichier_medical.value;
            if(nomfichierFullPath){
              nomfichierFullPath = nomfichierFullPath.replace(/\//g, '\\');
                let nomfichierSplit = nomfichierFullPath.split("\\");
                nomfichier = nomfichierSplit[nomfichierSplit.length-1];
                label.innerHTML = nomfichier;
              }
            }
          }
          else{
            label.innerHTML="Choisir fichier...";
          }
       });

      $(document).on('click', '#ajouter-fichier-perso-btn-sauvegarder', function(){
        var fichier_medical = document.getElementById("formulaire-medical-fichier");
        var form_data = new FormData();
        form_data.append("file", fichier_medical.files[0]);

        $.ajax({
         url:"../../php/script/Client/ajouterFichierPerso.php",
         method:"POST",
         data: form_data,
         contentType: false,
         cache: false,
         processData: false,
         async: false,
         beforeSend:function(){

         },
         success:function(data)
         {
           alert("Energistrement du fichier effectuté avec succès.");
         }
        });
      });
     });
   </script>
