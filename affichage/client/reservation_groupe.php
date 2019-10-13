<?php
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
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" content="">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/inscription.css">
    <link rel="stylesheet" href="../../css/reservation_questionnaire.css">
    <link rel="stylesheet" href="../../css/reservation.css">
    <link rel="stylesheet" href="../../css/reservation_groupe.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script type="text/javascript" src="../../js/jquery-3.4.1.slim.js"></script>
    <script type="text/javascript" src="../../js/global.js"></script>
    <script type="text/javascript" src="../../js/reservation.js"></script>
    <title>Réservation Groupe</title>
  </head>
  <body>
    <main>
      <div class="top-img">
        <img src="../../img/relaxe.jpg" alt="Atelier et facilitation">
        <div class="shade"></div>
        <p class="txt-centered">Réservation groupe</p>
      </div>

      <div class="reservation">
        <div class="txt-reservation txt-bienv txt-question">Envoyer votre demande dès maintenant</div><br>

        <form class="form-reservation-groupe" id="form-reservation-groupe" action="#" method="post">
          <div class="group-input-inscr">
            <label class="label-reservation label-col" for="service">Choisir un service</label>
            <div class="box-select">
              <select class="select-inscr input-long" name="service-groupe" id="service-groupe">
                <option class="option-vide" value="vide" selected="selected">Service</option>
                <option value="entrainement">Entraînements en équipe</option>
                <option value="enneagramme">Ennéagramme</option>
              </select>
            </div>
            <div class="group-input-inscr">
              <label class="label-reservation" for="entreprise">Nom de l'entreprise :</label>
              <input type="text" name="entreprise" id="entreprise" class="input-inscr" value="">
            </div>
            <div class="group-input-inscr">
              <label class="label-reservation" for="courriel">Adresse courriel</label>
              <input type="text" name="courriel" id="courriel" class="input-inscr" value="">
            </div>
            <div class="group-input-inscr">
              <label class="label-reservation" for="courriel">Adresse courriel</label>
              <input type="text" name="courriel" id="courriel" class="input-inscr" value="">
            </div>
            <div class="group-input-inscr">
              <label class="label-reservation label-tele" for="telephone">Téléphone</label>
              <input type="text" name="courriel" id="telephone" class="input-inscr input-tele" value="">
              <input type="text" name="poste" id="poste" class="input-inscr input-tele" value="">
            </div>
          </div>
        </form>
      </div>


    </main>

    <?php include "../global/footer.php"; ?>
  </body>
</html>
