/**
 * Page JS pour login
 *
 * Nom :         login.js
 * Catégorie :   JavaScript
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-06
 */

$( document ).ready(function() {
  div = document.createElement('div');
  p = document.createElement('p');
  div.id = "error-login";
  div.className = "error-login";
  p.innerHTML = "Votre adresse courriel ou votre mot de passe est invalide.";

    $('#btnlogin').click(function(){
      if(validerLogin()){
        $('#formulaireLogin').attr('action', '_TEST_login.php');
        $('#formulaireLogin').submit();
      }
      else{
        return false;
      }
    });
});

function validerLogin(){
  var bool = false;
  $.ajax({
    type: "POST",
    async: false,
    url: "../../php/script/Client/validerLogin.php",
    data: {"courriel": $('#courriel').val(),
           "motDePasse": $('#motDePasse').val()},
    success: function(result){
      if(result == "Bon courriel bon mot de passe"){
        bool = true;
      }
      else{
        document.getElementById("logo").parentNode.insertBefore(div, document.getElementById("logo").nextSibling);
        div.appendChild(p);
      }
    },
    error: function (jQXHR, textStatus, errorThrown) {
        alert("An error occurred whilst trying to contact the server: " + jQXHR.status + " " + textStatus + " " + errorThrown);
    }
  });
  return bool;
}
