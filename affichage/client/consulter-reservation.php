<?php
session_start();
/**
 * Page pour qu'un client puisse visualiser ses réservations
 *
 * Nom :         consulter-reservation.php
 * Catégorie :   Page
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-18
 */


 $page_type=1;
 include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mes réservations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" content="">
    <link rel="shortcut icon" href="/favicon-ekah.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/datatable.css"/>
    <link rel="stylesheet" href="/main.css">
    <link rel="stylesheet" href="/reservation.css">
    <link rel="stylesheet" href="/consulter-reservation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script type="text/javascript" src="/jquery-3.4.1.slim.js"></script>
    <script type="text/javascript" src="/consulter-reservation.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="/global.js"></script>

  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/header.php'; ?>
    <main>
      <div class="top-img">
        <img src="/operation-mpo.jpg" alt="Mouvement Intuitif">
        <div class="shade"></div>
        <p class="txt-centered">Mes réservations</p>
      </div>
      <div class="reservation">
        <div id="txtConsulter" class="txt-consulter">Jettez un petit coup d'oeil à vos réservations</div>

        <div class="legende">
          <div class="legende-carr">
            <div id="carre1" class="carre"></div><span class="txt-legende">Réservation annulée</span>
          </div>
          <div class="legende-carr">
            <div id="carre2" class="carre"></div><span class="txt-legende">Réservation complétée</span>
          </div>
          <div class="legende-carr">
            <div id="carre4" class="carre"></div><span class="txt-legende">Réservation à venir</span>
          </div>
        </div>

        <div class="block-tbl">
          <table id="table_reservation" class="cell-border hover row-border">
            <thead>
                <tr>
                    <th id="th-1">Activité</th>
                    <th>Date/Heure</th>
                    <th>Lieu</th>
                    <th>Coût</th>
                    <th>Facilitateur</th>
                    <th>Facture</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
        </div>

    </main>

    <?php include "../global/footer.php"; ?>

  </body>
</html>
