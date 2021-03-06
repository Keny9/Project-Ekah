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
ob_start();

$page_type=1;

include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Reservation/GestionAffichageReservation.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Reservation/GestionReservation.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/class/QuestionnaireReservation/Questionnaire.php';
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';

$recu_paiement_url = $_SESSION['recu_paiement_url'];
unset($_SESSION['recu_paiement_url']);

// Si le questionnaire n'est pas set
if ($_SESSION['questionnaire'] == null){
  // Redirect sur la page de réservation
  header('Location: /Project-Ekah/affichage/client/reservation.php?rComplete=1&recu_url='.$recu_paiement_url);
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

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" content="">
    <link rel="shortcut icon" href="/favicon-ekah.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/main.css">
    <link rel="stylesheet" href="/consulter-reservation.css">
    <link rel="stylesheet" href="/inscription.css">
    <link rel="stylesheet" href="/reservation.css">
    <link rel="stylesheet" href="/reservation-questionnaire.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script type="text/javascript" src="/jquery-3.4.1.slim.js"></script>
    <script type="text/javascript" src="/global.js"></script>
    <script type="text/javascript" src="/reservation.js"></script>
    <script type="text/javascript" src="/questionnaire.js"></script>
    <script type="text/javascript">
      const SUIVI_ID = <?php echo $_GET['res_id']; ?>;
    </script>
    <title>Réservation - Questions</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/header.php'; ?>
    <main>




      <div id="modal-question-reservation" class="modal-modif-reservation">
        <div class="modal-content">
          <div class="modal-align-middle-mr">
            <div class="txt-reservation txt-bienv">Réservation complétée. <br> Merci de faire confiance à l'équipe d'Ekah. </div>
            <div class="modal-align-middle btn-modal-insc modal-align-middle-mr">
              <button id="btn-confirm-reservation" type="submit" class="btn-confirmer input-court btn-coller" name="button">Terminer</button>
            </div>
        </div>
      </div>
    </div>

      <div class="top-img">
        <img src="/mouvement-intuitif.png" alt="Mouvement Intuitif">
        <div class="shade"></div>
        <p class="txt-centered"><?php echo $questionnaire_nom; ?></p>
      </div>

      <div class="reservation">
        <br>
        <p>Votre inscription est faite.</p>
        <p>
          Vous pouvez consulter votre facture en cliquant sur ce lien :
          <a target="_blank" href="<?php echo $recu_paiement_url ?>">
          Consulter votre reçu</a> - Une copie de votre reçu se trouve dans la liste de vos réservations.
        </p>
      <!--  <div class="txt-reservation txt-bienv txt-question">Remplir les champs suivants</div><br>   -->
        <div class="txt-explication">À titre préparatif, nous aimerions que vous remplissez ce questionnaire.</div>

        <form class="form-reservation-question" id="form-reservation-question" action="#" method="post">
          <div id="form-questions">
            <?php
              echo $stringQuestions;
            ?>
          </div>
          <div class="information">
            <p>*Ces informations resteront confidentielles au Collectif Ekah</p>
          </div>
          <div class="group-input-inscr">
            <p class="label-question">Veuiller dater et signer le questionnaire rempli</p>
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
