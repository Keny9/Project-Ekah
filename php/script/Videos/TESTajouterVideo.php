<?php
include "./ajouterVideo.php";

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
    <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      nom: <input type="text" name="nom" value="<?php echo $nom ?>">
      <br><span class="error">* <?php echo $nomErr; ?></span>
      <br><br>
      fichier: <input type="text" name="fichier" value="<?php echo $fichier ?>">
      <br><span class="error">* <?php echo $fichierErr; ?></span>
      <br><br>
      poster: <input type="text" name="poster" value="<?php echo $poster ?>">
      <br><span class="error">* <?php echo $posterErr; ?></span>
      <br><br>
      prix: <input type="text" name="prix" value="<?php echo $prix ?>">
      <br><span class="error">* <?php echo $prixErr; ?></span>
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
