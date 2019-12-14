<?php
session_start();
$page_type = 1;
include $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/script/Login/connect.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Vidéos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon-ekah.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="/video-js.min.css">
    <link rel="stylesheet" href="/main.css">
    <link rel="stylesheet" href="/videos.css">
    <link rel="stylesheet" href="/video-brand.css">
    <script src="/video.min.js"></script>
    <script src="/jquery-3.4.1.slim.js"></script>
    <script src="/videos.js"></script>
    <script src='/video-brand.js'></script>
    <script src="/global.js"></script>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/affichage/global/header.php" ?>

    <main>
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
                  <source src="/Project-Ekah/video/test_video.mp4" type="video/mp4">
                  <p class="vjs-no-js">Javascript a été désactivé ou n'est pas supporté. <br>Impossible de lire la vidéo.</p>
                </video-js>

              </div>
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
                  <source src="/Project-Ekah/video/video.mp4" type="video/mp4">
                  <p class="vjs-no-js">Javascript a été désactivé ou n'est pas supporté. <br>Impossible de lire la vidéo.</p>
                </video-js>

              </div>
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
                  <source src="/Project-Ekah/video/oceans.mp4" type="video/mp4">
                  <p class="vjs-no-js">Javascript a été désactivé ou n'est pas supporté. <br>Impossible de lire la vidéo.</p>
                </video-js>

              </div>
            </div>
          </div>

        </div>
      </div>

    </main>

    <?php include $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/affichage/global/footer.php" ?>

    <script src="https://vjs.zencdn.net/7.5.5/video.js"></script>
  </body>
</html>
