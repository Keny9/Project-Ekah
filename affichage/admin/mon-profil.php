<?php
session_start();
/**
 * Page 'mon-profil'. Le client peut modifier ses informations personnelles
 * ici.
 *
 * Nom :         mon-profil.php
 * Catégorie :   Page
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-11-03
 */
 $page_type=2;
 include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';
 include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Client/getMonProfil.php';

 ?>

 <!DOCTYPE html>
 <html lang="fr" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0" content="">
     <link rel="shortcut icon" href="/favicon-ekah.ico" type="image/x-icon">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" href="/main.css">
     <link rel="stylesheet" href="/inscription.css">
     <link rel="stylesheet" href="/modal.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

<?php //<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> ?>
     <script type="text/javascript" src="/jquery-3.4.1.slim.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     <script type="text/javascript" src="/global.js"></script>
     <script type="text/javascript">
       // variable qui contient un array JSON des informations du client
       const CLIENT = <?php echo $client_json ?>;
     </script>
     <script type="text/javascript" src="/mon-profil.js"></script>
     <title>Mon profil</title>
   </head>
   <body>
     <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/header.php'; ?>
     <?php include "modifier-mon-mot-de-passe.php"; ?>
     <div id="modal-inscription" class="modal-inscription">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-align-middle img-conf-insc">
              <img src="/crochet.png" alt="Confirmation inscription">
           </div>
           <div class="modal-align-middle txt-bravo">
             <p>Changements faits</p>
           </div>
           <div class="modal-align-middle txt-modal-bienv">
             <p>Modification effectutée avec succès</p>
           </div>
           <div class="modal-align-middle btn-modal-insc">
           <button type="button" id="modal-inscription-btn-confirm" class="btn-confirmer input-court" name="button">Confirmer</button>
           </div>
         </div>
       </div>
     </div>
     <main>
       <div class="inscription">
         <div class="logo-inscr">
           <img src="/logo-ekah-header.png" alt="Ekah">
         </div>
         <div class="txt-inscr">
           <p>Mon profil</p>
         </div>
         <div class="error" id="error-blank">
           <div class="icon-error">
             <i class="fas fa-exclamation-circle"></i>
           </div>
           <div class="text-error">
             Ces champs ne peuvent pas être vide.
           </div>
         </div>
         <form class="form-inscr" id="mickeymouse" action="" method="post">



           <div class="group-input-inscr">
             <div class="box-select">
               <select class="select-inscr input-long" name="pays" id="pays" onchange="changePays()">
                 <option class="option-vide" value="vide" selected="selected">Pays</option> <!-- Definir la facon d'inclure les pays principaux -->
                 <option value="Canada">Canada</option>
                 <option value="États-Unis">États-Unis</option>
               </select>
             </div>
           </div>
           <div class="group-input-inscr">
             <input type="text" name="prenom" id="prenom" class="input-inscr" placeholder="Prénom" value="">
             <input type="text" name="nom" id="nom" class="input-inscr second-input" placeholder="Nom de famille"value="">
           </div>
           <div class="group-input-inscr">
             <input type="text" id="jour" name="jour" class="input-inscr input-date m-long" placeholder="Jour de naissance" value="" maxlength="2">
             <div class="box-select m-top">
               <select class="select-inscr second-input input-date m-long" name="mois" id="mois" onchange="changeMois()">
                 <option class="option-vide" value="vide" selected="selected">Mois</option>
                 <option value="1">Janvier</option>
                 <option value="2">Février</option>
                 <option value="3">Mars</option>
                 <option value="4">Avril</option>
                 <option value="5">Mai</option>
                 <option value="6">Juin</option>
                 <option value="7">Juillet</option>
                 <option value="8">Août</option>
                 <option value="9">Septembre</option>
                 <option value="10">Octobre</option>
                 <option value="11">Novembre</option>
                 <option value="12">Décembre</option>
               </select>
             </div>
             <input type="text" name="annee" id="annee" class="input-inscr input-date second-input m-long m-top" placeholder="Année" value="" maxlength="4">
           </div>
           <div class="group-input-inscr">
             <input type="text" name="codePostal" id="codePostal" value="" class="input-inscr input-long" placeholder="Code postal">
           </div>
           <div class="group-input-inscr">
             <input type="text" name="noAdresse" id="noAdresse" title="Numéro d'adresse" value="" class="input-inscr input-date" placeholder="No. Adresse">
             <input type="text" name="rue" id="rue" value="" class="input-inscr input-date second-input" placeholder="Rue">
             <input type="text" name="ville" id="ville" value="" class="input-inscr input-date second-input" placeholder="Ville">
           </div>
           <div class="group-input-inscr">
             <input type="text" name="telephone" id="telephone" class="input-inscr input-long" placeholder="Téléphone" value="">
           </div>
           <div class="group-input-inscr">
             <div class="error-courriel" id="error-courriel">
               <p>Cette adresse courriel est déjà utilisée.*</p>
             </div>
             <input type="text" name="courriel" id="courriel" class="input-inscr input-long" placeholder="Courriel" value="">
           </div>

          <div class="group-input-inscr">
            <button type="button" id="modifier-mon-mot-de-passe-toggle" class="btn btn-link" data-toggle="modal" data-target="#modifier-mon-mot-de-passe-modal">Modifier mon mot de passe</button>
          </div>
           <div class="group-input-inscr">
             <button type="button" name="btnSauvegarder" id="btnSauvegarder" class="btn-confirmer input-long btn-compte-existant" onclick="validerFormInscription()">Sauvegarder</button>
           </div>
         </form>
       </div>

     </main>

     <?php include $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/affichage/global/footer.php"; ?>
   </body>
 </html>
