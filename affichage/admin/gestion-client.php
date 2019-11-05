<?php
/**
* Page pour qu'un admin puisse gérer les clients
*
* Nom :         gestionClient.php
* Catégorie :   Page
* Auteur :      Karl Boutin
* Version :     1.0
* Date de la dernière modification : 2019-10-28
*/

$page_type=2;
include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" content="">
  <title>Gestion des clients</title>
  <link rel="shortcut icon" href="../../img/favicon-ekah.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../css/dataTable.css"/>
  <link rel="stylesheet" href="../../css/main.css">
  <link rel="stylesheet" href="../../css/inscription.css">
  <link rel="stylesheet" href="../../css/reservation.css">
  <link rel="stylesheet" href="../../css/gestionClient.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <script type="text/javascript" src="../../js/jquery-3.4.1.slim.js"></script>
  <script type="text/javascript" src="../../js/gestionClient.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
  <script type="text/javascript" src="../../js/global.js"></script>
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/header.php'; ?>
  <main>
    <div class="reservation">
      <div class="txt-consulter">Gestion des clients</div>

      <div class="block-tbl">
        <table id="table_client" class="cell-border hover row-border">
          <thead>
            <tr id="header">
              <th id="th-1">Nom</th>
              <th>Prénom</th>
              <th>Adresse courriel</th>
              <th>Téléphone</th>
              <th>Date d'inscription</th>
              <th>Réservations</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>

      <div class="profil" id="profil">

        <div class="txt-consulter">Profil de <br><span id="nomClient"></span></div>

        <div class="error" id="error-blank">
          <div class="icon-error">
            <i class="fas fa-exclamation-circle"></i>
          </div>
          <div class="text-error">
            Ces champs ne peuvent pas être vide.
          </div>
        </div>

        <div class="group-input-inscr">
          <label class="label-consulter">Date de naissance</label>
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
          <label class="label-consulter">Adresse</label>
          <input type="text" name="noAdresse" id="noAdresse" value="" class="input-inscr input-date" placeholder="No. Adresse">
          <input type="text" name="rue" id="rue" value="" class="input-inscr input-date second-input" placeholder="Rue">
          <input type="text" name="ville" id="ville" value="" class="input-inscr input-date second-input" placeholder="Ville">
        </div>

        <div class="group-input-inscr">
          <label class="label-consulter">Code postal</label>
          <input type="text" name="codePostal" id="codePostal" value="" class="input-inscr input-long" placeholder="Code postal">
        </div>

        <div class="group-input-inscr">
          <label class="label-consulter">Pays</label>
          <div class="box-select">
            <select class="select-inscr input-long" name="pays" id="pays" onchange="changePays()">
              <option class="option-vide" value="vide" selected="selected">Pays</option>
              <option value="Canada">Canada</option>
              <option value="États-Unis">États-Unis</option>
            </select>
          </div>
        </div>

        <div class="group-input-inscr">
          <label class="label-consulter">Téléphone</label>
          <input type="text" name="telephone" id="telephone" class="input-inscr input-long" placeholder="Téléphone" value="">
        </div>

        <div class="group-input-inscr">
          <div class="error-courriel" id="error-courriel">
            <p>Cette adresse courriel est déjà utilisé.*</p>
          </div>
          <label class="label-consulter">Adresse courriel</label>
          <input type="text" name="courriel" id="courriel" class="input-inscr input-long" placeholder="Courriel" value="">
        </div>

        <div class="group-input-inscr">
          <button type="button" onclick="updateProfil()" name="btnSauvegarde" id="btnSauvegarde" class="btn-confirmer input-long">Sauvegarder</button>
        </div>

      </div>
    </div>

  </main>

  <?php include "../global/footer.php"; ?>
</body>
</html>
