<?php
session_start();
$page_type = 1;
include $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/script/Login/connect.php";
$videosTable = include $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/script/Videos/consulterVideosTable.php";
$videos_clientTable = include $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/script/Videos/consulterVideos_clientTable.php";
$videos_client = [];
foreach($videos_clientTable as $row){
  if($row['utilisateur_id'] === $_SESSION['logged_in_user_id']) {
    $videos_client[] .= $row['videos_id'];
  }
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Vidéos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon-ekah.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/video-js.min.css">
    <link rel="stylesheet" href="/main.css">
    <link rel="stylesheet" href="/inscription.css">
    <link rel="stylesheet" href="/consulter-reservation.css">
    <link rel="stylesheet" href="/reservation.css">
    <link rel="stylesheet" href="/videos.css">
    <link rel="stylesheet" href="/video-brand.css">


    <script>
      const VIDEOS = JSON.parse('<?php echo json_encode($videosTable); ?>');
      const VIDEOS_CLIENT = JSON.parse('<?php echo json_encode($videos_client); ?>');
    </script>
    <script src="/video.min.js"></script>
    <script src="/jquery-3.4.1.slim.js"></script>
    <script src="/videos.js"></script>
    <script src='/video-brand.js'></script>
    <script src="/global.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript" src="/paiement.js"></script>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/affichage/global/header.php" ?>

    <main>
      <div id='modal-complete-video' class='modal-modif-reservation'>
        <div class='modal-content'>
          <div class='modal-align-middle-mr'>
            <div class='txt-reservation txt-bienv'>Réservation complétée. <br><br>
             Merci de faire confiance à l'équipe d'Ekah. <br>
             <a href='#' target='_blank'>Reçu du paiement</a> <br>
             Aussi consultable dans la liste de vos réservation.</div>
              <div class='modal-align-middle btn-modal-insc modal-align-middle-mr'>
                <button id='btn-confirm-reservation' type='submit' class='btn-confirmer input-court btn-coller' name='button'>Terminer</button>
              </div>
            </div>
          </div>
        </div>

      <div class="content">
        <div id="folderNav">
          <div class="folder-nav">
            <ul>
              <li>Catégories</li>
              <li><a href="#entrainement">Entraînement</a></li>
              <li><a href="#nutrition">Nutrition</a></li>
              <li><a href="#yoga">Yoga</a></li>
            </ul>
          </div>
        </div>

        <div class="article">
          <div class="title">
            <h2>Vidéos</h2>
          </div>
          <div class="subtitle">
            <p>Nous offrons une vaste gamme de guides vidéo éducatifs axée sur le développement humain et la santé.</p>
          </div>

          <div class="categorie-video">
            <h3 id="entrainement">Entraînement</h3>
            <p>Vidéos axées sur l'entraînement..</p>
            <div class="group-video">
              <h4>Mouvements fonctionnels de base</h4>
              <p>Description de la vidéo..</p>
              <div class="video-container">

                <video-js id="video-1" class="video-js vjs-default-skin" width="700" height="395" data-setup='{"controls": true}'>
                  <source src="<?php echo $videosTable[0]['fichier']; ?>" type="video/mp4">
                  <p class="vjs-no-js">Javascript a été désactivé ou n'est pas supporté. <br>Impossible de lire la vidéo.</p>
                </video-js>

              </div>
              <button type="button" name="btn-video" id="btn-video-1" class="btn-payer btn-video">Obtenir le guide</button>
            </div>
          </div>

          <div class="categorie-video">
            <h3 id="nutrition">Nutrition</h3>
            <p>Vidéos axées sur la nutrition..</p>
            <div class="group-video">
              <h4>Alimentation en Grèce antique</h4>
              <p>Description de la vidéo..</p>
              <div class="video-container">

                <video-js id="video-2" class="video-js vjs-default-skin" width="700" height="395" data-setup='{"controls": true}'>
                  <source src="<?php echo $videosTable[1]['fichier']; ?>" type="video/mp4">
                  <p class="vjs-no-js">Javascript a été désactivé ou n'est pas supporté. <br>Impossible de lire la vidéo.</p>
                </video-js>

              </div>
              <button type="button" name="btn-video" id="btn-video-2" class="btn-payer btn-video">Obtenir le guide</button>
            </div>
          </div>

          <div class="categorie-video">
            <h3 id="yoga">Yoga</h3>
            <p>Vidéos axées sur le yoga..</p>
            <div class="group-video">
              <h4>Les bases du Ashtanga Vinyasa</h4>
              <p>Description de la vidéo..</p>
              <div class="video-container">

                <video-js id="video-3" class="video-js vjs-default-skin" width="700" height="395" data-setup='{"controls": true}'>
                  <source src="<?php echo $videosTable[2]['fichier']; ?>" type="video/mp4">
                  <p class="vjs-no-js">Javascript a été désactivé ou n'est pas supporté. <br>Impossible de lire la vidéo.</p>
                </video-js>

              </div>
              <button type="button" name="btn-video" id="btn-video-3" class="btn-payer btn-video">Obtenir le guide</button>
            </div>
          </div>

        </div>
      </div>

    </main>

    <?php include $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/affichage/global/footer.php" ?>

    <script src="https://vjs.zencdn.net/7.5.5/video.js"></script>
  </body>
</html>
