<?php
/**
* Page pour permettre a un utilisateur de récupérer son mot de passe
*
* Nom :         password-reset.php
* Catégorie :   Page
* Auteur :      Karl Boutin
* Version :     1.0
* Date de la dernière modification : 2019-11-27
*/

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" content="">
    <title>Mot de passe oublié ?</title>
    <link rel="shortcut icon" href="../../img/favicon-ekah.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/inscription.css">
    <link rel="stylesheet" href="../../css/reservation.css">
    <link rel="stylesheet" href="../../css/password-reset.css">
    <script type="text/javascript"></script>
  </head>
  <body>

    <main>
      <form class="" id="form-reco-pass" action="" method="post">
        <div class="block-reset">
          <div class="txt-reservation txt-bienv big-txt">Mot de passe oublié ?</div>
          <div class="txt-reservation txt-bienv">Un courriel vous sera envoyé avec les instructions pour modifier votre mot de passe.</div>

          <div class="group-input-inscr">
            <input type="text" name="courriel" id="courriel" class="input-inscr" placeholder="Courriel" value="">
          </div>

          <div class="group-input-inscr">
            <button type="button" name="buttonSuivant" id="btnSuivant" class="btn-confirmer input-long">Envoyez les instructions</button>
          </div>

          <div class="group-input-inscr margin-less">
           <a href="/Project-Ekah/affichage/global/login.php"><button type="button" name="btnRetour" id="btnRetour" class="btn-confirmer input-long btn-compte-existant">Retour</button></a>
          </div>
        </div>
      </form>
    </main>

  </body>
</html>
