<?php
/**
 * Page pour qu'un admin puisse voir toutes les reservations
 *
 * Nom :         consulter-reservation.php
 * Catégorie :   Page
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-23
 */

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

    <main>
      <div class="reservation">
        <div class="txt-consulter">Listes des réservations</div>

        <div class="block-tbl">
          <table id="table_reservation" class="cell-border hover row-border">
            <thead>
              <tr>
                <th id="th-1">Activité</th>
                <th>Client</th>
                <th>Lieu</th>
                <th>Date/Heure</th>
                <th>Coût</th>
                <th>Facilitateur</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>

    </main>

    <?php include "../global/footer.php"; ?>

  </body>
</html>
