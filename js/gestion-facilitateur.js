/**
 * Page JS pour la gestion des facilitateurs
 *
 * Nom :         gestion-facilitateur.js
 * Catégorie :   JavaScript
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-11-18
 */

$(document).ready(function(){
  listInput = document.querySelectorAll("input");

  listInput.forEach(function(e){
    e.addEventListener("focusin", function(){
      e.style.borderBottomColor = "#f0592a";
      e.style.transition = "all 0.4s";
    });
  });

  listInput.forEach(function(e){
    e.addEventListener("focusout", function(){
      e.style.borderBottomColor = "#9E9E9E";
    });
  });

  prenom = document.getElementById("prenom");
  nom = document.getElementById("nom");
  courriel = document.getElementById("courriel");
  telephone = document.getElementById("telephone");
  motDePasse = document.getElementById("motDePasse");

  prenom.addEventListener("focusout", function(){
    if(verifieNomPrenom(prenom)){
      inputUnrequired(prenom, "Prénom");
    }
  });

  nom.addEventListener("focusout", function(){
    if(verifieNomPrenom(nom)){
      inputUnrequired(nom, "Nom");
    }
  });

  courriel.addEventListener("focusout", function(){
    if(verifieCourriel(courriel)){
      inputUnrequired(courriel, "Courriel");
    }
  });

  telephone.addEventListener("focusout", function(){
    if(verifieTelephone(telephone)){
      inputUnrequired(telephone, "Courriel");
    }
  });

  motDePasse.addEventListener("focusout", function(){
    if(verifieMotDePasse(motDePasse)){
      inputUnrequired(motDePasse, "Mot de passe");
    }
  });

  //Initialiser Data table
  table = $('#table_client').DataTable({
      "ajax":{
        "url": "../../php/script/Facilitateur/getDataFacilitateur.php",
        "dataSrc": ""
      },
      "columns" : [
        {"data": "nom"},
        {"data": "prenom"},
        {"data": "courriel"},
        {"data": "telephone"},
        {"data": "etat"},
        {"data": null,
        render: function(data, type, row){
          // Set la référence vers l'agenda d'un facilitateur
          return '<a href="../admin/disponibilite.php?id='+data.id+'" target="_blank"><span class="calendar"></span></a>';
        }},
      ],
      "language":{
        "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
      },
      responsive: false,
    });

    $('#table_client').DataTable().draw();
    jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');

    //Créer l'événement du click sur le texte `Créer un facilitateur`
    $("#link-c-f").click(function(){
      $("#profil").slideDown("slow"); //Afficher le block du profil avec une animation
      document.querySelector('#profil').scrollIntoView({ //Animation du scroll au block profil (smooth)
        behavior: 'smooth'
      });
    });

    //Ajouter click sur le bouton annuler de la fenêtre modale: pour pouvoir fermer la fenêtre
    $("#btn-annuler").click(function(){
      closeModal();
    });

});

//Fonction si input vide qui montre que le champ est requis
 function inputRequired(e){
    e.style.borderBottomColor = "#ff0000";
    e.classList.add('redPlaceholder');
 }

//Fonction qui remet les couleurs par défauts
 function inputUnrequired(e, placeholder){
   e.style.borderBottomColor = "#9E9E9E";
   e.classList.add('borderBottomColor');
   e.classList.add('defaultPlaceholder');
   e.placeholder = placeholder;
 }

 //Fonction qui valide le formulaire avant de submit
 function validerFormInscription(){
   groupDateEmpty = true; //Les dates ne sont pas rempli
   codePostalEmpty = true;
   groupAdressEmpty = true; //Adresse ne sont pas rempli

   //Verification des elements qui sont *required
   if(siVide(prenom) || siVide(nom) || siVide(courriel) || siVide(telephone) || siVide(motDePasse)){
     indiqueChampVide();
     document.getElementById("error-blank").style.display = "block";
     return false;
   }


   document.getElementById("error-blank").style.display = "none";

   //Verification des input avec les regex qui sont *required
   if(!verifieNomPrenom(prenom) || !verifieNomPrenom(nom) || !verifieCourriel(courriel) || !verifieTelephone(telephone) || !verifieMotDePasse(motDePasse)){
     indiqueChampInvalide();
     return false;
   }

   // Si le courriel existe déjà dans la BD
   if(courrielExiste()){
     inputRequired(courriel);
     document.getElementById("error-courriel").style.display = "block";
     return false;
   }

   // Change l'attribut Action du Formulaire
   $("#modal-inscription").css("display", "block");
   $('#mickeymouse').attr('action', '../../php/script/Facilitateur/ajouterFacilitateur.php');
   return true;
 }

 //Verifie que le nom de famille ou le prenom est valide (Regex)
 function verifieNomPrenom(e){
   var nomRegex = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð,. '-]+$/;
   return nomRegex.test(e.value);
 }

//Verifier que le courriel est valide
 function verifieCourriel(e){
   var courrielRegex = /^\S+@\S+\.\S+$/;
   return courrielRegex.test(e.value);
 }

//S'assurer que le mot de passe respecte certaines conditions (au moins 8 charactère, 1 minuscule, 1 majuscule et au moins 1 chiffre)
 function verifieMotDePasse(e){
   var motDePasseRegex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])[A-Za-z\d!@#$%^&*?]{8,}$/;
   return motDePasseRegex.test(e.value);
 }

//Veririfer que le numero de telephone entree est valide . Au moins 10 chiffres.
 function verifieTelephone(e){
   var telephoneRegex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
   return telephoneRegex.test(e.value);
 }

//Indique quels champs sont vides à l'utilisateur
 function indiqueChampVide(){

   if(siVide(prenom)){
     inputRequired(prenom);
   }

   if(siVide(nom)){
     inputRequired(nom);
   }

   if(siVide(courriel)){
     inputRequired(courriel);
   }

   if(siVide(telephone)){
     inputRequired(telephone);
   }

   if(siVide(motDePasse)){
     inputRequired(motDePasse);
   }

 }

//Indique quels champs sont invalides a l'utilisateur
 function indiqueChampInvalide(){

   if(!verifieNomPrenom(prenom)){
     inputRequired(prenom);
     prenom.value = null;
     prenom.placeholder = "Prénom invalide *";
   }

   if(!verifieNomPrenom(nom)){
     inputRequired(nom);
     prenom.value = null;
     prenom.placeholder = "Nom invalide *";
   }

   if(!verifieCourriel(courriel)){
     inputRequired(courriel);
     courriel.value = null;
     courriel.placeholder = "Courriel invalide *";
   }

   if(!verifieTelephone(telephone)){
     inputRequired(telephone);
     telephone.value = null;
     telephone.placeholder = "Téléphone invalide *";
   }

   if(!verifieMotDePasse(motDePasse)){
     inputRequired(motDePasse);
     motDePasse.value = null;
     motDePasse.placeholder = "Mot de passe invalide *";
     document.getElementById("block-requis").style.border = "1px solid #eb0909";
   }
 }

 //Verifie si le champ de l'element est vide
 function siVide(e){
   if(e.value == null || e.value == ""){
     return true;
   }
   return false;
 }

//Verifie si la selection de la liste est vide
 function siSelectVide(e){
   if(e.options[e.selectedIndex].value == null || e.options[e.selectedIndex].value == "" || e.options[e.selectedIndex].value == "vide"){
     return true;
   }
   return false;
 }

//Affiche les exigences du mot de passe
 function afficheExigence(){
   document.getElementById("block-requis").style.display = "block";
 }

 // Retourne si le courriel entré existe déjà dans la BD
 function courrielExiste(){
   var bool = true;
   $.ajax({
     type: "POST",
     async: false,
     url: "../../php/script/Client/siCourrielExiste.php",
     data: {"courriel": $('#courriel').val()},
     success: function(result){
       if(result == 'false'){
         bool = false;
       }
     },
     error: function (jQXHR, textStatus, errorThrown) {
         alert("An error occurred whilst trying to contact the server: " + jQXHR.status + " " + textStatus + " " + errorThrown);
     }
   });
   return bool;
 }


//Fermer la fenetre modale de modification d'une réservation
function closeModal(){
  $("#modal-modif-reservation").css("display", "none");
}

//Ouvrir la fenêtre modal
function openModal(){
  $("#modal-modif-reservation").css("display", "block");
}
