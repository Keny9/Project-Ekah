<?php
/**
 * Page pour consulter les réservations d'un client
 *
 * Nom :         consulter-reservation-client.php
 * Catégorie :   Page
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-23
 */
 $page_type=2;
 include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';

// La variable GET[id] n'est pas définit
if(!isset($_GET['id'])){ // Retour à la page précédente
  echo '<script type="text/javascript">
          alert("Page inaccessible.");
          window.history.back();
        </script>';
}
 $idClient = $_GET['id'];

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
    <script type="text/javascript" src="../../js/consulter_reservation_client.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="../../js/global.js"></script>

  </head>
  <body>

    <main>
      <div class="reservation">
        <div class="txt-consulter">Listes des réservations <br> </div>

        <div class="block-tbl">
          <table id="table_reservation_client" class="cell-border hover row-border">
            <thead>
              <tr>
                <th id="th-1" class="all">Activité</th>
                <th class="all">Client</th>
                <th class="min-desktop">Lieu</th>
                <th class="min-desktop">Date/Heure</th>
                <th class="min-desktop">Coût</th>
                <th class="all">Facilitateur</th>
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
            <textarea name="suggestion" class="commentaire" id="suggestion"></textarea>
          </div>

          <div class="group-input-inscr">
            <button type="button" name="btnSauvegarde" id="btnSauvegarde" class="btn-confirmer input-long">Sauvegarder</button>
          </div>
        </div>

      </div>

    </main>

    <?php include "../global/footer.php"; ?>

  </body>
</html>
