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

$prix_format[] = number_format($videosTable[0]['prix']*0.01, 2, ',', '');
$prix_format[] = number_format($videosTable[1]['prix']*0.01, 2, ',', '');
$prix_format[] = number_format($videosTable[2]['prix']*0.01, 2, ',', '');

/*********Infos paiements***********/
try{
  // Retourne $client
  include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Client/getMonProfil.php';

  $_SESSION['client'] = $client;


  $dt = new DateTime(null,new DateTimeZone('UTC'));
  $dt->setTimezone(new DateTimeZone('America/Toronto'));
  $date = $dt->format('m/d/Y');
  $time = $dt->format('H:i');

} catch (Exception $e){
  echo "Une erreur est survenue. <br>";
  echo "<a href='accueil_client.php'>Retour à l'accueil</a>";
  exit();
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
    <link rel="stylesheet" href="/video-brand.css">
    <link rel="stylesheet" href="/videos.css">


    <script>
      const VIDEOS = JSON.parse('<?php
      require_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Video/GestionVideo.php";
      $gv = new GestionVideo();
      echo json_encode($gv->consulterVideosTable());
       //echo json_encode($videosTable);
       ?>');
      const VIDEOS_CLIENT = JSON.parse('<?php
      require_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Video/GestionVideo.php";
      $gv = new GestionVideo();
      echo json_encode($gv->consulterVideos_clientTable());
       //echo json_encode($videos_client);
       ?>');
      const PRIX = JSON.parse('<?php echo json_encode($prix_format); ?>');
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
      <?php
        if(isset($_GET['vComplete']) && $_GET['vComplete'] == 1 ){
          if(isset($_GET['recu_url'])) $recu_url = $_GET['recu_url'];
          else $recu_url = "";
        echo "<div id='modal-complete-video' class='modal-modif-reservation'>
          <div class='modal-content'>
            <div class='modal-align-middle-mr'>
              <div class='txt-reservation txt-bienv'>Vidéo acheté.<br><br>
               Merci de faire confiance à l'équipe d'Ekah. <br>
               <a href='$recu_url' target='_blank'>Reçu du paiement</a> <br>
               </div>
                <div class='modal-align-middle btn-modal-insc modal-align-middle-mr'>
                  <button id='btn-confirm-video' type='submit' class='btn-confirmer input-court btn-coller' name='button'>Terminer</button>
                </div>
              </div>
            </div>
          </div>";
        }
    ?>

        <div id='modal-paiement-video' class='modal-modif-reservation'>
          <div class='modal-content'>
            <span id="btn-close" class="close">&times;</span>
            <div class='modal-align-middle-mr'>
              <div class="body-container">
                <div class="top">
                   <img src="/powered-by-stripe.png" alt="Powered by Stripe" title="Powered by Stripe"><br>
                   <label></label>
                </div>
                <div class="body">
                  <div class="header">
                    <div class="item">
                      <img class="logo" src="/icon-ekah.png" alt="Ekah Logo" title="Logo d'Ekah">
                    </div>
                    <div class="item">
                      <label>Formulaire de paiement</label>
                    </div>
                    <div class="item">
                      <label>Collectif Ekah 2019</label>
                    </div>
                  </div>

                  <div class="main">
                    <div class="info-container">
                      <div class="item">
                        <label>Client :</label>
                        <span><?php echo $client['prenom']." ".$client['nom'] ?></span>
                      </div>
                      <div class="item">
                        <label>Vidéo :</label>
                        <span id="nomVideo"></span>
                      </div>
                      <div class="item">
                        <label>Date :</label>
                        <span><?php echo $date; ?></span>
                      </div>
                      <div class="item">
                        <label>Heure :</label>
                        <span><?php echo $time; ?></span>
                      </div>
                      <div class="item">
                        <label>Montant :</label>
                        <span id="montantVideo">$ CAD</span>
                      </div>
                    </div>
                  </div>

                  <div class="main">
                    <form action="/Project-Ekah/php/script/Videos/paiement-video.php" method="post" id="payment-form">
                      <input type="hidden" name="token" />
                      <input type="hidden" name="id-video" id="id-video" value="">
                      <input type="hidden" name="prix-video" value="" id="prix-video">
                      <div class="group">
                        <label>
                          <span>Numéro de carte</span>
                          <div id="card-number-element" class="field"></div>
                        </label>
                        <label>
                          <span>Date d'expiration</span>
                          <div id="card-expiry-element" class="field"></div>
                        </label>
                        <label>
                          <span>CVC</span>
                          <div id="card-cvc-element" class="field"></div>
                        </label>
                        <label>
                          <span>Code postal</span>
                          <input id="postal-code" name="postal_code" class="field" placeholder="J1N 1Z1" />
                        </label>
                      </div>
                      <div class="error"></div>
                      <button class="btn-stripe" type="submit" id="btn-paiement"></button>

                    </form>
                  </div>
                </div>
                <div class="bottom">
                  <img src="/logo-ekah-header.png" alt="Ekah logo" title="Logo d'Ekah">
                </div>
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
