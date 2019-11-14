<?php
session_start();
/**
 * Page pour qu'un admin puisse voir toutes les reservations
 *
 * Nom :         consulter-reservation.php
 * Catégorie :   Page
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-23
 */
 $page_type=2;
 include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';

 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Individu/Utilisateur/Facilitateur/Facilitateur.php";
 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Facilitateur/gestionFacilitateur.php";

 $gFacilitateur = new GestionFacilitateur();
 $arrFacilitateur = $gFacilitateur->getAllFacilitateurActif();

 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Liste des réservations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" content="">
    <link rel="shortcut icon" href="../../img/favicon-ekah.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/dataTable.css"/>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/inscription.css">
    <link rel="stylesheet" href="../../css/reservation.css">
    <link rel="stylesheet" href="../../css/consulter-reservation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script type="text/javascript" src="../../js/jquery-3.4.1.slim.js"></script>
    <script type="text/javascript" src="../../js/consulter_reservation_admin.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="../../js/global.js"></script>

  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/header.php'; ?>
    <main>

      <div id="modal-modif-reservation" class="modal-modif-reservation">
        <div class="modal-content">
            <div class="modal-align-middle-mr">
               <label class="label-reservation" for="activite">Facilitateur</label>
               <div class="box-select">
                 <select class="select-inscr input-long" name="service" id="service" onchange="changeListe(this);">
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

      <div class="reservation">
        <div class="txt-consulter">Listes des réservations</div>

        <div class="block-tbl">
          <table id="table_reservation" class="cell-border hover row-border">
            <thead>
              <tr>
                <th id="th-1" class="all">Activité</th>
                <th class="all">Client</th>
                <th class="min-desktop">Lieu</th>
                <th class="min-desktop">Date/Heure</th>
                <th class="min-desktop">Coût</th>
                <th class="all">Facilitateur</th>
                <th class="all">Modifier</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>

        <div class="suivi" id="suivi">
          <div class="group-input-inscr">
            <label for="commentaire" class="label-consulter">Qu'est-ce qui a été effectué :</label>
            <textarea name="fait" class="commentaire" id="fait"></textarea>
          </div>

          <div class="group-input-inscr">
            <label for="commentaire" class="label-consulter">Suggestions pour la prochaine rencontre :</label>
            <textarea name="suggestion" class="commentaire" id="commentaire"></textarea>
          </div>

          <div class="group-input-inscr">
            <button type="button" onclick="sauvegarder()" name="btnSauvegarde" id="btnSauvegarde" class="btn-confirmer input-long">Sauvegarder</button>
          </div>
        </div>

      </div>

    </main>

    <?php include "../global/footer.php"; ?>

  </body>
</html>
