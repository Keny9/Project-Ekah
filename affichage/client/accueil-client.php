<?php
session_start();
// Accueil du client
$page_type=1;
include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="shortcut icon" href="/favicon-ekah.ico" type="image/x-icon">
    <link rel="stylesheet" href="/Project-Ekah/utils/bootstrap-calendar/components/bootstrap2/css/bootstrap.css">
  	<link rel="stylesheet" href="/Project-Ekah/utils/bootstrap-calendar/components/bootstrap2/css/bootstrap-responsive.css">
  	<link rel="stylesheet" href="/Project-Ekah/utils/bootstrap-calendar/css/calendar.css">
    <link rel="stylesheet" href="/main.css">
    <link rel="stylesheet" href="/inscription.css">
    <link rel="stylesheet" href="/accueil-client.css">
    <link rel="stylesheet" href="/reservation.css">
    <link rel="stylesheet" href="/consulter-reservation.css">
    <link rel="stylesheet" href="/atelier.css">
    <link rel="stylesheet" href="/fix.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script type="text/javascript" src="/jquery-3.4.1.slim.js"></script>
    <script type="text/javascript" src="/Project-Ekah/utils/bootstrap-calendar/components/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/Project-Ekah/utils/bootstrap-calendar/components/underscore/underscore-min.js"></script>
    <script type="text/javascript" src="/Project-Ekah/utils/bootstrap-calendar/components/bootstrap2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Project-Ekah/utils/bootstrap-calendar/components/jstimezonedetect/jstz.min.js"></script>

    <script type="text/javascript" src="/Project-Ekah/utils/bootstrap-calendar/js/calendar.js"></script>
    <script type="text/javascript" src="/Project-Ekah/utils/bootstrap-calendar/js/app.js"></script>
    <script type="text/javascript" src="/Project-Ekah/utils/bootstrap-calendar/js/language/fr-FR.js"></script>

    <script type="text/javascript" src="/global.js"></script>
    <script type="text/javascript" src="/ateliers.js"></script>

  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/header.php' ?>

    <main>
      <div class="top-img">
        <img src="/reflexion.jpg" alt="Mouvement Intuitif">
        <div class="shade"></div>
        <p class="txt-centered">Les ateliers</p>
      </div>

      <div id="modal-inscription" class="modal-inscription">
        <div class="modal-content">
          <div class="modal-align-middle-insc img-conf-insc">
             <img src="/crochet.png" alt="Confirmation inscription">
          </div>
          <div class="modal-align-middle-insc txt-bravo-insc">
            <p>Félicitations !</p>
          </div>
          <div class="modal-align-middle-insc txt-modal-bienv-insc">
            <p>Vous êtes désormais inscrit à cet atelier !</p>
          </div>
          <div class="modal-align-middle-insc btn-modal-insc">
            <button type="submit" onclick="closeModalFin()" class="btn-confirmer input-court" name="button">Fermer</button>
          </div>
        </div>
      </div>

      <div class="reservation">
        <div class="btnCalandrier">
          <div class="legend">
            <div class="legend-vert"></div>
            <p class="legend-txt">= Atelier</p>
          </div>
          <div class="page-header">
            <h3 class=" h3"></h3>
          </div>
          <div class="">
            <button type="button" class="bouton-re-que bouton-nav" name="button" id="next"  data-calendar-nav="next">Suivant >></button>
            <button type="button" class="bouton-re-que bouton-nav" name="button" id="prev"  data-calendar-nav="prev"><< Précédent</button>
          </div>
        </div>

        <br><br>

        <div id="calendar"></div>
        <br><br>


        <script type="text/javascript">

        var calendar = $("#calendar").calendar(
          {
            language: 'fr-FR',
            tmpl_path: "/Project-Ekah/utils/bootstrap-calendar/tmpls/",
            weekbox: false,
            events_source: "/Project-Ekah/php/script/Horaire/afficherAllAteliers.php",

            onAfterViewLoad: function(view) {
              $('.page-header h3').text(this.getTitle());
            }
          });
        </script>

<!-- MODAL -->
        <div id="modal" class="modal-modif-reservation">
          <div class="modal-content">
              <div class="modal-align-middle-mr">

                <img src="/relaxe.jpg" class="img-modal" alt="Image">

                <h3 id="modal-titre" class="modal-titre">Titre</h3>

                <textarea readonly name="description" class="modal-description" id="modal-description" rows="8" cols="80">Description courte</textarea>

                <p id="modal-date">Date</p><br>
                <p id=modal-start>Heure</p><br>
                <p id="modal-fin">Durée</p><br>

                <p id="modal-adresse">Adresse</p><br>
                <p id="modal-prix">Prix</p><br>

              </div>
            <div class="modal-align-middle btn-modal-insc modal-align-middle-mr">
              <button id="btn-annuler" type="button" onClick="closeModal()" class="btn-confirmer input-long btn-compte-existant btn-coller" name="button">Annuler</button>
              <button type="submit" class="btn-confirmer input-court btn-coller" onclick="inscrireAtelier()" name="button">S'inscrire</button>
            </div>
          </div>
        </div>

      </div>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/footer.php' ?>
  </body>
</html>
