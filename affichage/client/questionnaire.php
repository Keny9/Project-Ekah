<?php
session_start();
/**
* Page de reservation ou le client repond aux questions en lien avec le service choisi
*
* Nom :         reservation_questionnaire.php
* Catégorie :   Page
* Auteur :      Karl Boutin
* Version :     1.0
* Date de la dernière modification : 2019-10-11
*/

include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Reservation/GestionAffichageReservation.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/class/QuestionnaireReservation/questionnaire.php';

$page_type=1;
include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';

// Si le questionnaire n'est pas set
if (!isset($_SESSION['questionnaire'])){
  // Redirect sur la page de réservation
  header('Location: /Project-Ekah/affichage/client/reservation.php');
  exit();
}

// Set les attributs du questionnaire
$questionnaire_id = $_SESSION['questionnaire']->getIdentifiant();
$questionnaire_nom = $_SESSION['questionnaire']->getNomQuestionnaire();

unset($_SESSION['questionnaire']); // Unset session var

$gReservation = new GestionReservation();
$gAffichage = new GestionAffichageReservation();

$arrayQuestion = $gReservation->questionSelectAllWithQuestionnaireId($questionnaire_id);
$stringQuestions = $gAffichage->printQuestionArray($arrayQuestion);
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" content="">
    <link rel="shortcut icon" href="../../img/favicon-ekah.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/inscription.css">
    <link rel="stylesheet" href="../../css/reservation.css">
    <link rel="stylesheet" href="../../css/reservation_questionnaire.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script type="text/javascript" src="../../js/jquery-3.4.1.slim.js"></script>
    <script type="text/javascript" src="../../js/global.js"></script>
    <script type="text/javascript" src="../../js/reservation.js"></script>
    <script type="text/javascript" src="../../js/questionnaire.js"></script>
    <script type="text/javascript">
      const SUIVI_ID = <?php echo $_GET['res_id']; ?>;
    //  alert(SUIVI_ID);
    </script>
    <title>Réservation - Questions</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/header.php'; ?>
    <main>
      <div class="top-img">
        <img src="../../img/activite/mouvement_intuitif.png" alt="Mouvement Intuitif">
        <div class="shade"></div>
        <p class="txt-centered"><?php echo $questionnaire_nom ?></p>
      </div>

      <div class="reservation">
        <div class="txt-reservation txt-bienv txt-question">Remplir les champs suivants</div><br>
        <div class="txt-explication">Avant de faire une réservation, nous aimerions apprendre à mieux vous connaître.</div>

        <form class="form-reservation-question" id="form-reservation-question" action="#" method="post">
          <div id="form-questions">
            <?php
              echo $stringQuestions;
            ?>
          </div>
          <div class="group-input-inscr">
            <p class="label-question">Signez et datez la déclaration</p>
            <div class="group-input-inscr">
              <label for="signature" class="label-dec">Signature</label>
              <input type="text" name="signature" id="signature" value="" class="input-inscr input-question-dec">
            </div>
            <div class="group-input-inscr">
              <label for="date" class="label-dec">Date</label>
              <p id="date" value="" class="input-inscr input-question-dec"><?php date_default_timezone_set("America/New_York"); echo date("Y-m-d"); ?></p>
            </div>
            <div class="group-input-inscr btn-ques">
              <button type="button" name="retourQuestion" id="retourQuestion" class="bouton-re-que">RETOUR</button>
              <button type="button" name="confirmerQuestion" id="confirmerQuestion" class="bouton-re-que">CONFIRMER</button>
            </div>
          </div>
        </form>
      </div>
    </main>

    <?php include "../global/footer.php"; ?>
  </body>
</html>
