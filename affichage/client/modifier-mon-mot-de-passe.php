<?php
/*
* Page à insérer qui contient une fenêtre modale pour la modification d'un mot de passe
*
*
*
*
*
* Auteur : Maxime Lussier
*/

 ?>
<!DOCTYPE html>
<!--
  <head>
    <meta charset="utf-8">
    <title></title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="../../css/modal.css">


    <script type="text/javascript" src="../../js/jquery-3.4.1.slim.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
-->
    <!-- Trigger the modal with a button -->
<!--    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
-->
    <!-- Modal -->
    <div id="modifier-mon-mot-de-passe-modal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Modification du mot de passe</h4>
            <button type="button"id="modifier-mon-mot-de-passe-btn-close" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <p>Vous souhaitez changer votre mot de passe?</p>
            <span>Insérez votre mot de passe <b>actuel</b></span>
            <input type="password" name="mot-de-passe-actuel" id="mot-de-passe-actuel" value="">
            <span>Insérez votre <b>nouveau</b> mot de passe</span>
            <input type="text" name="mot-de-passe-nouveau" id="mot-de-passe-nouveau" value="">
            <span>Confirmez votre nouveau mot de passe</span>
            <input type="text" class="mb-2" name="mot-de-passe-confirmation" id="mot-de-passe-confirmation" value="">
          </div>
          <div class="modal-footer">
            <button type="button" id="modifier-mon-mot-de-passe-btn-sauvegarder"class="btn btn-default mr-auto" data-dismiss="modal">Sauvegarder le changement</button>
            <button type="button" id="modifier-mon-mot-de-passe-btn-fermer"class="btn btn-default" data-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>
