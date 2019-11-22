<?php
  session_start();
  /**
  * Page pour qu'un admin créer ou modifier un facilitateur
  *
  * Nom :         gestion-facilitateur.php
  * Catégorie :   Page
  * Auteur :      Karl Boutin
  * Version :     1.0
  * Date de la dernière modification : 2019-11-18
  */
  $page_type=2;
  include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" content="">
    <title>Les facilitateurs</title>
    <link rel="shortcut icon" href="../../img/favicon-ekah.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/dataTable.css"/>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/inscription.css">
    <link rel="stylesheet" href="../../css/reservation.css">
    <link rel="stylesheet" href="../../css/gestion-facilitateur.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script type="text/javascript" src="../../js/jquery-3.4.1.slim.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="../../js/gestion-facilitateur.js"></script>
    <script type="text/javascript" src="../../js/global.js"></script>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/header.php'; ?>

    <div id="modal-modif-reservation" class="modal-modif-reservation">
      <div class="modal-content">
        <div class="modal-align-middle-mr">
           <label class="label-reservation" for="activite">Facilitateur</label>
           <div class="box-select">
             <select class="select-inscr input-long" name="facilitateur" id="facilitateur" onchange="changeFacilitateur(this);">
               <option class="option-vide" value="vide" selected="selected">Facilitateur</option>
               <?php
               foreach ($arrFacilitateur as $facilitateur){
                 echo "<option value=\"".$facilitateur->getId()."\">".$facilitateur->getPrenom()." ".$facilitateur->getNom()."</option>";
               }
               ?>
             </select>
           </div>
        </div>
        <div class="modal-align-middle btn-modal-insc modal-align-middle-mr">
          <button type="submit" class="btn-confirmer input-court btn-coller" name="button">Sauvegarder</button>
          <button id="btn-annuler" type="button" class="btn-confirmer input-long btn-compte-existant btn-coller" name="button">Annuler</button>
        </div>
      </div>
    </div>

    <main>
      <div class="reservation">
        <div class="txt-consulter">Les Facilitateurs</div>
        <div class="block-tbl">
          <table id="table_client" class="cell-border hover row-border">
            <thead>
              <tr id="header">
                <th id="th-1">Nom</th>
                <th>Prénom</th>
                <th>Adresse courriel</th>
                <th>Téléphone</th>
                <th>État</th>
                <th>Agenda</th>
              </tr>
            </thead>
          </table>
        </div>

        <p id="link-c-f" class="link-facilitateur">Créer un facilitateur</p>

        <div class="profil" id="profil">
          <div class="txt-consulter">Créer un facilitateur</div>

          <div class="inscription">
            <div class="logo-inscr">
              <img src="../../img/logo_ekah_header.png" alt="Ekah">
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

              <div id="modal-inscription" class="modal-inscription">
                <div class="modal-content">
                  <div class="modal-align-middle img-conf-insc">
                     <img src="../../img/crochet.png" alt="Confirmation inscription">
                  </div>
                  <div class="modal-align-middle txt-bravo">
                    <p>Félicitations !</p>
                  </div>
                  <div class="modal-align-middle txt-modal-bienv">
                    <p>Bienvenue dans l'équipe !</p>
                  </div>
                  <div class="modal-align-middle btn-modal-insc">
                    <button type="submit" class="btn-confirmer input-court" name="button">Terminer</button>
                  </div>
                </div>
              </div>

              <div class="group-input-inscr">
                <input type="text" name="prenom" id="prenom" class="input-inscr" placeholder="Prénom" value="">
                <input type="text" name="nom" id="nom" class="input-inscr second-input" placeholder="Nom de famille"value="">
              </div>
              <div class="group-input-inscr">
                <input type="text" name="telephone" id="telephone" class="input-inscr input-long" placeholder="Téléphone" value="">
              </div>
              <div class="group-input-inscr">
                <div class="error-courriel" id="error-courriel">
                  <p>Cette adresse courriel est déjà utilisé.*</p>
                </div>
                <input type="text" name="courriel" id="courriel" class="input-inscr input-long" placeholder="Courriel" value="">
              </div>
              <div class="group-input-inscr">
                <input type="password" name="motDePasse" id="motDePasse" class="input-inscr input-long" placeholder="Mot de passe" value="" onclick="afficheExigence()">
                <div id="block-requis" class="block-requis-psw">
                  <i class="fas fa-exclamation-circle"></i><p>Utiliser au moins 8 charactères.</p><br><br>
                  <i class="fas fa-exclamation-circle"></i><p>Utiliser au moins 1 nombre et une lettre.</p><br><br>
                  <i class="fas fa-exclamation-circle"></i><p>Utiliser au moins 1 lettre majuscule.</p><br><br>
                </div>
              </div>
              <div class="group-input-inscr">
                <button type="button" name="btnInscription" id="btnInscription" class="btn-confirmer input-long" onclick="return validerFormInscription()">Créer le facilitateur</button>
              </div>

            </form>
          </div>

        </div>
      </div>

    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/footer.php'; ?>

  </body>
</html>