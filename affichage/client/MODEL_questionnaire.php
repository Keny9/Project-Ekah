<?php
/**
 * Page de reservation ou le client repond aux questions en lien avec le service choisi
 *
 * Nom :         reservation_questionnaire.php
 * Catégorie :   Page
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-11
 */

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" content="">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/inscription.css">
    <link rel="stylesheet" href="../../css/reservation.css">
    <link rel="stylesheet" href="../../css/reservation_questionnaire.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script type="text/javascript" src="../../js/jquery-3.4.1.slim.js"></script>
    <script type="text/javascript" src="../../js/global.js"></script>
    <script type="text/javascript" src="../../js/reservation.js"></script>
    <title>Réservation - Questions</title>
  </head>
  <body>

    <main>
      <div class="top-img">
        <img src="../../img/mouvement_intuitif.png" alt="Mouvement Intuitif">
        <div class="shade"></div>
        <p class="txt-centered">Mouvement Intuitif</p>
      </div>

      <div class="reservation">
        <div class="txt-reservation txt-bienv txt-question">Remplir les champs suivants</div><br>
        <div class="txt-explication">Avant de faire une réservation, nous aimerions apprendre à mieux vous connaître.</div>

        <form class="form-reservation-question" id="form-reservation-question" action="#" method="post">
          <div class="group-input-inscr">
            <label class="label-question" for="prob-sante">Souffrez-vous de problèmes de santé ou de maladies ? Si oui, lesquelles ?</label>
            <input type="text" name="prob-sante" id="prob-sante" value="" class="input-inscr input-long input-question">
          </div>
          <div class="group-input-inscr">
            <label class="label-question" for="medic">Prenez-vous des médicaments ? Si oui, lesquels et pour quelles raisons ?</label>
            <input type="text" name="medic" id="medic" value="" class="input-inscr input-long input-question">
          </div>
          <div class="group-input-inscr">
            <label class="label-question" for="blessure">Avez-vous <b>actuellement</b> des douleurs ou des blessures ? Si oui, lesquelles ?</label>
            <input type="text" name="blessure" id="blessure" value="" class="input-inscr input-long input-question">
          </div>
          <div class="group-input-inscr">
            <label class="label-question" for="blessure">Avez-vous des <b>antécédents</b> de douleurs ou de blessures ? Si oui, lesquelles ?</label>
            <input type="text" name="blessure" id="blessure" value="" class="input-inscr input-long input-question">
          </div>
          <div class="group-input-inscr">
            <label class="label-question" for="professionnel">Faites-vous affaires avec d'autres professionnels de la santé ? Si oui, lesquels (nom, coordonnées)</label>
            <input type="text" name="professionnel" id="professionnel" value="" class="input-inscr input-long input-question">
          </div>
          <div class="group-input-inscr">
            <label for="commentaire" class="label-question">Autres informations pertinentes en préparation au rendez-vous</label>
            <textarea name="commentaire" id="commentaire"></textarea>
          </div>
          <div class="group-input-inscr">
            <p class="label-question">Signez et datez la déclaration</p>
            <div class="group-input-inscr">
              <label for="signature" class="label-dec">Signature</label>
              <input type="text" name="signature" id="signature" value="" class="input-inscr input-question-dec">
            </div>
            <div class="group-input-inscr">
              <label for="date" class="label-dec">Date</label>
              <p id="date" value="" class="input-inscr input-question-dec">2019-10-11</p>
            </div>
            <div class="group-input-inscr btn-ques">
              <button type="button" name="retourQuestion" id="retourQuestion" class="bouton-re-que">RETOUR</button>
              <button type="submit" name="confirmerQuestion" id="confirmerQuestion" class="bouton-re-que">CONFIRMER</button>
            </div>
          </div>
        </form>
      </div>
    </main>

    <?php include "../global/footer.php"; ?>
  </body>
</html>
