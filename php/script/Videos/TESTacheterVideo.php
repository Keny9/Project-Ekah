<?php
session_start();
$page_type = 1;
include $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/script/Login/connect.php";

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <style media="screen">
      .error{
        color: #F00;
      }
    </style>
  </head>
  <body>
    <form class="" action="./acheterVideo.php" method="post">
      video_id: <input type="text" name="videos_id" value="">
      <br><br>
      <button type="submit" name="button">submit</button>
    </form>
  </body>

  <script>
  document.addEventListener('DOMContentLoaded', (event) => {
    console.log('DOM fully loaded and parsed');

    var errors = document.querySelectorAll('form span');
    console.log(errors);

    errors.forEach(function(error){
      if (error.innerHTML == "* "){
        error.style.display = "none";
      }
    });
  });
  </script>
</html>
