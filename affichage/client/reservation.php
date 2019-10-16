<?php
/**
 * Page de reservation generale pour choisir un service
 *
 * Nom :         reservation.php
 * Catégorie :   Page
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-11
 */

session_start();

 if($_SESSION['userTypeId'] != 1){
   header('Location: /Project-Ekah/affichage/global/erreur.html');
 }

include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/class/Activite/activite.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Activite/gestionActivite.php";

$gActivite = new GestionActivite();
$activites = $gActivite->getAllActivite();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" content="">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/inscription.css">
    <link rel="stylesheet" href="../../css/reservation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script type="text/javascript" src="../../js/jquery-3.4.1.slim.js"></script>
    <script type="text/javascript" src="../../js/global.js"></script>
    <script type="text/javascript" src="../../js/reservation.js"></script>
    <title>Réservation</title>
  </head>
  <body>
    <?php //include "../global/header_client.php"; ?>

    <main>
      <div class="top-img">
        <img src="../../img/mouvement_intuitif.png" alt="Mouvement Intuitif">
        <div class="shade"></div>
        <p class="txt-centered">Réservation</p>
      </div>

      <div class="reservation">
        <div class="txt-reservation txt-bienv">Réservez dès maintenant</div>

        <form class="form-reservation" id="form-reservation" action="" method="post">
          <div class="group-input-inscr">
            <label class="label-reservation label-col" for="service">Choisir un service</label>
            <div class="box-select">
              <select class="select-inscr input-long" name="service" id="service" onchange="changeListe(this);">
                <option class="option-vide" value="vide" selected="selected">Service</option>
                <?php
                $separator = 1;
                echo "<option disabled class=\"select-section\">EN ATELIER</option>";
                foreach ($activites as $activite){
                  if ($activite->getId_type() == 4) break;

                  if ($activite->getId_type() != $separator){
                    $separator = $activite->getId_type();
                    if($separator == 2) echo "<option disabled class=\"select-section\">À DOMICILE</option>";
                    elseif($separator == 3) echo "<option disabled class=\"select-section\">EN LIGNE</option>";
                  }

                  echo"<option value=\"".$activite->getIdentifiant()."\">".$activite->getNom()."</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="group-input-inscr">
            <label class="label-reservation label-col" for="durree">Durée</label>
            <div class="box-select">
              <select class="select-inscr input-long" name="duree" id="duree" onchange="changeListe(this);">
                <option class="option-vide" value="vide" selected="selected">Durée</option>
                <option value="30">30 minutes</option>
                <option value="60">60 minutes</option>
                <option value="90">90 minutes</option>
              </select>
            </div>
          </div>
          <div class="group-input-inscr">
            <label class="label-reservation label-prix" for="prix">Prix</label>
            <p id="prix">120$</p>
          </div>
          <div class="group-input-inscr">
            <label class="label-reservation" for="facilitateur" id="label-facilitateur">Choisir un facilitateur</label>
            <input type="checkbox" name="facilitateur" id="facilitateur" onclick="check()" value="">
          </div>
          <div id="photo-facilitateur" class="group-input-inscr">
            <div class="block-photo-facilitateur">
              <div class="photo-facilitateur"></div>
              <div class="photo-facilitateur"></div>
              <div class="photo-facilitateur"></div>
            </div>
            <div class="block-photo-nom">
              <div class="photo-nom">Antoine</div>
              <div class="photo-nom">Alejandro</div>
              <div class="photo-nom">Philippe</div>
            </div>
          </div>
          <div class="group-input-inscr">
            <label class="label-reservation label-long">Sélectionner la date et l'heure désiré</label>
            <!--<img id="calendrier" src="../../img/calendar.JPG" alt="Calendrier">-->
            <?php //include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/calendrier.php' ?>
          </div>
          <div class="group-input-inscr">
            <label for="commentaire" class="label-reservation">Commentaire</label>
            <textarea name="commentaire" class="commentaire" id="commentaire"></textarea>
          </div>
          <div class="group-input-inscr">
            <button type="button" name="buttonSuivant" id="btnSuivant" class="btn-confirmer input-long">SUIVANT</button>
          </div>
          <div class="group-input-inscr btn-espace">
           <a href="/Project-Ekah/affichage/client/accueil_client.php"><button type="button" name="btnRetour" id="btnRetour" class="btn-confirmer input-long btn-compte-existant">RETOUR</button></a>
          </div>
        </form>

      </div>

    </main>

    <?php include "../global/footer.php"; ?>

  </body>
</html>
