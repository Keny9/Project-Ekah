<?php
session_start();
$page_type=2;
include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';

// TODO: faire des 'include' comme plus haut
// TODO: la page ne devrait pas include de gestionnaire.. Seulement des scripts
require_once("../../php/gestionnaire/Activite/gestionActivite.php");
require_once("../../php/gestionnaire/Duree/gestionDuree.php");
require_once("../../php/gestionnaire/Question/gestionQuestion.php");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../../img/favicon-ekah.ico" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <link rel="stylesheet" href="../../css/gestionReservation.css">
  <link rel="stylesheet" href="../../css/main.css">

  <script src="../../js/global.js"></script>
  <script src="../../js/gestionReservation.js"></script>
  <title>Gestion Réservation</title>
</head>

<body onload="ouvrir()">
  <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/header.php' ?>
<main class="mainReservation">

  <!-- MODAL -->
          <div id="modal" class="modal-modif-reservation">
            <div class="modal-content">
                <div class="modal-align-middle-mr">

                  <img src="../../img/activite/relaxe.jpg" class="img-modal" alt="Image">

                  <h3 id="modal-titre" class="modal-titre">Créer un atelier</h3>

                  <label for="date">Date (2000-01-31)</label><br />
                  <input id="date" class="input-atelier" type="text" name="date" value="" placeholder="date (2000-01-31)"><br><br>

                  <label for="heure">Heure (Ex: 08:30 / 18:00)</label><br />
                  <input id="heure" class="input-atelier" type="text" name="heure" value="" placeholder="Heure (Ex: 08:30 / 18:00)"><br><br>

                  <label for="duree">Durée (En minute)</label><br />
                  <input id="duree" class="input-atelier" type="text" name="duree" value="" placeholder="Minute (Ex: 30 / 90)"><br><br>

                  <label for="adresse">Adresse</label><br />
                  <input id="adresse" class="input-atelier" type="text" name="adresse" value="" placeholder="Adresse (16 rue étoile, Sherbrooke, J1E 1J1)"><br><br>

                  <label for="atelier">Atelier</label><br />
                  <select class="select-inscr input" name="atelier" id="atelier">
                    <?php
                      require_once '../../php/gestionnaire/Activite/gestionAffichageActivite.php';
                      $gaa = new GestionAffichageActivite();
                      echo $gaa->getAllAtelier();
                    ?>
                  </select>

                  <!-- <label for="prix">Prix</label><BR />
                  <input id="prix" class="input-atelier" type="text" name="prix" value="" placeholder="Pirx (Ex: 30 / 90)"><br><br> -->

                </div>
              <div class="modal-align-middle btn-modal-insc modal-align-middle-mr">
                <button type="submit" class="btn-confirmer input-court btn-coller" onclick="ajouterAtelier()" name="button">Créer</button>
                <button id="btn-annuler" type="button" onClick="closeModal()" class="btn-confirmer input-long btn-compte-existant btn-coller" name="button">Annuler</button>
              </div>
            </div>
          </div>





  <h1 class="titreReservation">Gestion des Réservations</h1>
    <div class="tableauActivite">
      <?php
                     require_once '../../php/gestionnaire/Reservation/gestionAffichageGestionReservation.php';
                     $gagr = new GestionAffichageGestionReservation();
                     echo $gagr->getAllQuestion();
                   ?>
    <?php
                   require_once '../../php/gestionnaire/Reservation/gestionAffichageGestionReservation.php';
                   $gagr = new GestionAffichageGestionReservation();
                   echo $gagr->getAllActivite();
                 ?>
                 <input type="button" class="submitSupprimer" onclick="supprime();" value="Désactivé" />
                 <input type="button" class="submitAjout" onclick="ajouterActive();" value="Ajouter" /><br>
                 <input type="button" class="submitModifier" onclick="modifier();" value="Modifier" /><br>
                 <button type="button" onclick="openModal();" class="bouton-re-que" name="button">Créer un atelier</button>
    </div>

    <div class="reservationMain">
      <h2 class="texteEkha">Aperçu de la réservation</h2>
      <div class="reservationHeader"><img class="imgHeader" src="../../img/logo_ekah_header.png" alt="Ekah"></div>
      <div class="reservationImg"><img class="imgPrincipal" src="../../img/imgDehors.jpg" alt="Soins a domicile"> <div class="titreImg" id="titre"></div></div>
      <h3 class="reservez texteEkha">Réserver dès maintenant</h3><br>
      <h6 class="choisirServ texteEkha">Nom du service:</h6>
      <h6 class="choisirDuree texteEkha">Quelles durées sont acceptées:</h6><br><br>

      <textarea class="boxService" name="service" id="nom"></textarea>
      <div class="tableauDuree">
      <?php
                     require_once '../../php/gestionnaire/Reservation/gestionAffichageGestionReservation.php';
                     $gagr = new GestionAffichageGestionReservation();
                     echo $gagr->getAllDuree();
                   ?>

    </div>

    <h6 class="choisirType texteEkha">Quelle est le type de l'activité:</h6><br><br>
    <?php
                   require_once '../../php/gestionnaire/Reservation/gestionAffichageGestionReservation.php';
                   $gagr = new GestionAffichageGestionReservation();
                   echo $gagr->getAllTypeActivite();
                 ?>


    <div id="typeSelect" class="cacher">
      yo
    </div>
    <h6 class="duree texteEkha">Durée:</h6>
    <?php
                   require_once '../../php/gestionnaire/Reservation/gestionAffichageGestionReservation.php';
                   $gagr = new GestionAffichageGestionReservation();
                   echo $gagr->getDureeActivite(1);
                 ?>
    <h6 class="descriptionC texteEkha">Description du service:</h6>
    <textarea class="boxDescription" name="descriptionC" cols="40" rows="5" id="descriptionC"></textarea>
    <br />
    <h6 class="descriptionC texteEkha">Questions de l'activité:</h6>
    <?php
                    require_once '../../php/gestionnaire/Reservation/gestionAffichageGestionReservation.php';
                    $gagr = new GestionAffichageGestionReservation();
                    echo $gagr->getQuestionActivite(1);
                  ?>
      <input type="button" class="submitSupprimerQuestion" onclick="supprimerQuestion();" value="Supprimer" />
    <h4 class="descriptionC texteEkha">Ajouter des questions spécifiques</h4>
      <input class="inputQuestion" type="text"  placeholder="Question" id="question"/>
      <input class="inputNb" type="text"  placeholder="Nombre de lignes de la case" id="nbLigne"/>
      <input type="button" class="submitAjoutQuestion" onclick="ajouterQuestionnaire();" value="Ajouter" />

    </div>

      <div class="group-input-inscr btn-espace">
       <a href="/Project-Ekah/affichage/admin/accueil_admin.php"><button type="button" name="btnRetour" id="btnRetour" class="btn-confirmer submitRetour">Retour</button></a>
      </div>

</main>
<?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/footer.php' ?>
</body>

</html>

<?php
  unset($_SESSION["error"]);
 ?>
