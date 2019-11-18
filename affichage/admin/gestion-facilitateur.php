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
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>

    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/footer.php'; ?>

  </body>
</html>
