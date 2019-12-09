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
    <link href="https://vjs.zencdn.net/7.5.5/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="/main.css">
    <link rel="stylesheet" href="/videos.css">
    <link rel="stylesheet" href="/fix.css">

    <script src="/jquery-3.4.1.slim.js"></script>
    <script src="/videos.js"></script>
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

                <video>
                </video>

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

                <video>
                </video>

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

                <video>
                </video>

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
