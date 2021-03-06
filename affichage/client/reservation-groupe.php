<?php
session_start();
/**
 * Page de reservation un directeur ou une personne responsable fait une demande
 * pour une activite de groupe
 *
 * Nom :         reservation_groupe.php
 * Catégorie :   Page
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-12
 */

 $page_type=1;
 include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" content="">
    <link rel="shortcut icon" href="/favicon-ekah.ico" type="image/x-icon">
    <link rel="stylesheet" href="/main.css">
    <link rel="stylesheet" href="/inscription.css">
    <link rel="stylesheet" href="/reservation-questionnaire.css">
    <link rel="stylesheet" href="/reservation.css">
    <link rel="stylesheet" href="/reservation-groupe.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script type="text/javascript" src="/jquery-3.4.1.slim.js"></script>
    <script type="text/javascript" src="/global.js"></script>
    <script type="text/javascript" src="/reservation-groupe.js"></script> <!--C'est tu nécessaire de réutiliser reservation.js..? -->
    <title>Réservation Groupe</title>
  </head>
  <body>
    <div id="modal-demande" class="modal-modif-reservation">
      <div class="modal-content">
        <div class="modal-align-middle-mr">
          <div class="txt-reservation txt-bienv">Votre demande a été envoyée avec succès ! <br><br> <p class="modal-text">Nous analyserons votre demande et nous vous recontacterons très bientôt.</p> </div>
          <div class="modal-align-middle btn-modal-insc modal-align-middle-mr">
            <a href="/accueil"><button id="close-demande" type="button" class="btn-confirmer input-long btn-compte-existant" name="button">Terminer</button></a>
          </div>
      </div>
    </div>
  </div>

    <?php include "../global/header.php"; ?>
    <main>
      <div class="top-img">
        <img src="/relaxe.jpg" alt="Atelier et facilitation">
        <div class="shade"></div>
        <p class="txt-centered">Réservation de groupe</p>
      </div>

      <div class="reservation">
        <div class="txt-reservation txt-bienv txt-question">Envoyer votre demande dès maintenant</div><br>

        <form class="form-reservation-groupe" id="form-reservation-groupe" method="post">
          <div class="group-input-inscr">
            <label class="label-reservation label-col" for="service-groupe">Choisir un service</label>
            <div class="box-select">
              <select class="select-inscr input-long" name="service-groupe" id="serviceGroupe" onchange="changeListe(this);">
                <option class="option-vide" value="vide" selected="selected">Service</option>
                <option value="entrainement">Entraînements en équipe</option>
                <option value="enneagramme">Ennéagramme</option>
              </select>
            </div>
            <div class="group-input-inscr">
              <label class="label-reservation" for="entreprise">Nom de l'entreprise </label>
              <input type="text" name="entreprise" id="entreprise" class="input-inscr" value="">
            </div>
            <div class="group-input-inscr">
              <label class="label-reservation" for="nom">Nom complet</label>
              <input type="text" name="nom" id="nom" class="input-inscr" value="">
            </div>
            <div class="group-input-inscr">
              <label class="label-reservation" for="courriel">Adresse courriel</label>
              <input type="text" name="courriel" id="courriel" class="input-inscr" value="">
            </div>
            <div class="group-input-inscr">
              <label class="label-reservation label-tele" for="telephone">Téléphone</label>
              <input type="text" name="courriel" id="telephone" class="input-inscr input-tele" value="">
              <input type="text" name="poste" id="poste" class="input-inscr input-tele" value="" placeholder="Poste">
            </div>
            <div class="group-input-inscr">
              <label class="label-reservation" for="vous">Parlez-nous de vous</label>
              <textarea name="vous" id="vous" class="commentaire"></textarea>
            </div>
            <div class="group-input-inscr">
              <label class="label-reservation" for="message">Message/Demande</label>
              <textarea name="message" id="message" class="commentaire"></textarea>
            </div>
            <div class="group-input-inscr btn-ques">
              <a href="/accueil"><button type="button" name="retourDemandeGroupe" id="retourDemandeGroupe" class="bouton-re-que">RETOUR</button></a>
              <button type="button" name="confirmerDemandeGroupe" id="confirmerDemandeGroupe" class="bouton-re-que" onclick="sendEmail()">CONFIRMER</button>
            </div>
          </div>
        </form>
        <div id="loader" class="loader"></div>
      </div>

    </main>

    <?php include "../global/footer.php"; ?>
  </body>
</html>
