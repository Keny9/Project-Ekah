/**
 * Page JS pour inscription
 *
 * Nom :         inscription.js
 * Catégorie :   JavaScript
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-09-30
 */

var client_arr = null;
var   user_courriel = null;

// Appuie sur la touche ..
$(window).keydown(function(event){
  // .. Enter
  if(event.keyCode == 13) {
    event.preventDefault();
    // Fait l'action d'un clique sur le bouton 'Sauvegarder'
    $('#btnSauvegarder').click();
    return false;
  }
});

// Apres que le document soit prêt (après le window.onload = function())
$( document ).ready(function() {
  // FENÊTRE MODALE modifier-mon-mot-de-passe
  password_modal_close = document.getElementById('modifier-mon-mot-de-passe-btn-close');
  password_modal_fermer = document.getElementById('modifier-mon-mot-de-passe-btn-fermer');
  password_modal_sauvegarder = document.getElementById('modifier-mon-mot-de-passe-btn-sauvegarder');

  password_modal_close.removeAttribute("data-dismiss");
  password_modal_fermer.removeAttribute("data-dismiss");
  password_modal_sauvegarder.removeAttribute("data-dismiss");

  password_modal_sauvegarder.setAttribute("onclick", "updateMotDePasse()");
  modalDataDismiss(password_modal_close);
  modalDataDismiss(password_modal_fermer);

  $("#modifier-mon-mot-de-passe-modal").on('hidden.bs.modal', function(){
    // Reset les champs
    document.getElementById('mot-de-passe-actuel').value='';
    document.getElementById('mot-de-passe-nouveau').value='';
    document.getElementById('mot-de-passe-confirmation').value='';
  });

});

function updateMotDePasse(){
  var actualPassword = document.getElementById('mot-de-passe-actuel');
  var newPassword = document.getElementById('mot-de-passe-nouveau');
  var newPasswordConfirm = document.getElementById('mot-de-passe-confirmation');

  password_modal_sauvegarder.removeAttribute("data-dismiss");

  // mot de passe actuel est bien le bon
  if(!actualPasswordValid(CLIENT['id'], actualPassword.value)){
    alert("Le mot de passe actuel ne correspond pas à votre mot de passe actuel.")
    return;
  }

  // test regex du nouveau mot de passe
  if(!verifieMotDePasse(newPassword)){
    console.log("newPassword regex failed");
    alert("Le nouveau mot de passe doit contenir :\n au minimum 1 majuscule;\n au minimum 1 chiffre;\n au minimum 8 caractères.")
    return;
  }

  // Le mot de passe de confirmation n'est pas le même que le nouveau mot de passe
  if(newPassword.value != newPasswordConfirm.value){
    // Le mentionner au client
    console.log("Le nouveau mot de passe et la confirmation de celui-ci ne correspondent pas.");
    alert("Le nouveau mot de passe et la confirmation de celui-ci ne correspondent pas.");
    return;
  }

 var dataClient = {
    id: CLIENT.id,
    password: $('#mot-de-passe-nouveau').val()
  };

  var dataClientJson = JSON.stringify(dataClient);

// Requête ajax pour update le mot de passe
  $.ajax({
    url: "/Project-Ekah/php/script/Client/updateMotDePasse.php",
    data: {data: dataClientJson},
    async:false,
    success: function(result){
      console.log(result);
      alert("Modification du mot de passe effectuée avec succès.");
    },
  });

  password_modal_close.setAttribute("data-dismiss", "modal");
  password_modal_fermer.setAttribute("data-dismiss", "modal");
  password_modal_sauvegarder.setAttribute("data-dismiss", "modal");
}

function ajouterFichierPerso(){

}

// Set l'attribut data-dismiss à modal. e = element html
function modalDataDismiss(e){
  e.setAttribute("data-dismiss", "modal");
}

function actualPasswordValid(client_id, mot_de_passe){
  var reponse = false;
  $.ajax({
    url: "/Project-Ekah/php/script/Client/comparerMotDePasse.php",
    data: {client_id: client_id,
           mot_de_passe : mot_de_passe},
    async:false,
    success: function(result){
      if(result == "true"){
        console.log("actualPasswordValid : true");
        reponse = true;
      }
      else if (result == "false"){
        console.log("actualPasswordValid : false");
      }
      else{
        console.log("actualPasswordValid : else");
      }
    },
  });
  return reponse;
}

//Lorsque le document est prêt
window.onload = function(){
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

/*
  prenom = document.getElementById("prenom");
  nom = document.getElementById("nom");
  courriel = document.getElementById("courriel");
  telephone = document.getElementById("telephone");
  motDePasse = document.getElementById("motDePasse");
  codePostal = document.getElementById("codePostal");
  jour = document.getElementById("jour");
  mois = document.getElementById("mois"); //C'est un select
  annee = document.getElementById("annee");
  adresse = document.getElementById("noAdresse");
  rue = document.getElementById("rue");
  ville = document.getElementById("ville");
*/
  prenom = document.getElementById("prenom");
  nom = document.getElementById("nom");
  courriel = document.getElementById("courriel");
  telephone = document.getElementById("telephone");
  //motDePasse = document.getElementById("motDePasse");
  codePostal = document.getElementById("codePostal");
  jour = document.getElementById("jour");
  mois = document.getElementById("mois"); //C'est un select
  annee = document.getElementById("annee");
  adresse = document.getElementById("noAdresse");
  rue = document.getElementById("rue");
  ville = document.getElementById("ville");
  pays = document.getElementById("pays"); // C'est un select

  setMonProfilChamps();


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

/*  motDePasse.addEventListener("focusout", function(){
    if(verifieMotDePasse(motDePasse)){
      inputUnrequired(motDePasse, "Mot de passe");
    }
  });*/

  jour.addEventListener("focusout", function(){
    if(verifieJour(jour)){
      inputUnrequired(jour, "Jour de naissance");
    }
  });

  annee.addEventListener("focusout", function(){
    if(verifieAnnee(annee)){
      inputUnrequired(annee, "Jour de naissance");
    }
  });

  mois.addEventListener("focusout", function(){
    if(!siSelectVide(mois)){
      inputUnrequired(mois, "Mois");
    }
  });

  if(mois.options[mois.selectedIndex].value != "vide"){
    mois.style.color = "#000000";
  }

  if(pays.options[pays.selectedIndex].value != "vide"){
    pays.style.color = "#000000";
  }

  codePostal.addEventListener("focusout", function(){
    if(verifieCodePostal(codePostal)){
      inputUnrequired(codePostal, "Code postal");
    }
  });

  rue.addEventListener("focusout", function(){
    if(verifieNomPrenom(rue)){
      inputUnrequired(rue, "Rue");
    }
  });

  noAdresse.addEventListener("focusout", function(){
    if(verifieNoAdresse(noAdresse)){
      inputUnrequired(noAdresse, "No. Adresse");
    }
  });

  ville.addEventListener("focusout", function(){
    if(verifieNomPrenom(ville)){
      inputUnrequired(ville, "Ville");
    }
  });

  // Set le onClick du bouton de confirmation de la fenêtre modale de confirmation
  $('#modal-inscription-btn-confirm').click(function(){
    location.reload(); // Reload la page
  });
};

// Initialise les champs avec les infos du client
function setMonProfilChamps(){
  if(CLIENT.date_naissance == null){
    date_naissance = null;
  }
  else{
    date_naissance = CLIENT['date_naissance'].split('-');
  }

  prenom.value = CLIENT['prenom'];
  nom.value = CLIENT['nom'];
  courriel.value = CLIENT['courriel'];
  telephone.value = CLIENT['telephone'];
  //motDePasse.value = CLIENT[''];
  codePostal.value = CLIENT['code_postal'];

  if(date_naissance != null){
    jour.value = date_naissance[2];
    mois.value = date_naissance[1];
    annee.value = date_naissance[0];

    // Enlève le 0 de trop dans le mois de naissance
    if(parseInt(date_naissance[1]) < 10){
      mois.value = date_naissance[1].substr(1);
    }
  }

  adresse.value = CLIENT['no_civique'];
  rue.value = CLIENT['rue'];
  ville.value = CLIENT['ville'];
  pays.value = CLIENT['pays'];
  user_courriel = CLIENT['courriel'];


}

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

 //Change la couleur du texte lorsqu'on sélectionne un élément de la liste mois
 function changeMois(){
   var list = document.getElementById("mois");
   var selectedValue = list.options[list.selectedIndex].value;

   if(selectedValue != "vide"){
     list.style.color = "#000000";
   }
 }

//Change la couleur du texte lorsqu'on sélectionne un élément de la liste pays
 function changePays(){
   var list = document.getElementById("pays");
   var selectedValue = list.options[list.selectedIndex].value;

   if(selectedValue != "vide"){
     list.style.color = "#000000";
   }
 }

 //Fonction qui valide le formulaire avant de submit
 function validerFormInscription(){
   groupDateEmpty = true; //Les dates ne sont pas rempli
   codePostalEmpty = true;
   groupAdressEmpty = true; //Adresse ne sont pas rempli

   //Verification des elements qui sont *required
   if(siVide(prenom) || siVide(nom) || siVide(courriel) || siVide(telephone)/* || siVide(motDePasse)*/){
     indiqueChampVide();
     document.getElementById("error-blank").style.display = "block";
     return false;
   }

   //Si les 3 ne sont pas vides alors pas d'erreur que c'est vide
   if((!siVide(jour) && !siSelectVide(mois) && !siVide(annee))){
     groupDateEmpty = false;
   }

   //Si les 3 ne sont pas vides alors pas d'erreur que c'est vide
   if(!siVide(noAdresse) && !siVide(rue) && !siVide(ville)){
     groupAdressEmpty = false;
   }

   // si code postal pas vide
   if(!siVide(codePostal)){
     codePostalEmpty = false;
   }

   //Si un des 3 n'est pas vide les autres ne doivent pas etre vide egalement ou si les 3 sont pas vides alors correct
   if((!siVide(jour) || !siSelectVide(mois) || !siVide(annee)) && groupDateEmpty == true){
     indiqueTempsVide();
     document.getElementById("error-blank").style.display = "block";
     return false;
   }

   //Si un des 3 n'est pas vide les autres ne doivent pas etre vide egalement ou si les 3 sont pas vides alors correct
   if((!siVide(noAdresse) || !siVide(rue) || !siVide(ville)) && groupAdressEmpty == true){
     indiqueAdresseVide();
     document.getElementById("error-blank").style.display = "block";
     return false;
   }

   document.getElementById("error-blank").style.display = "none";

   //Verification des input avec les regex qui sont *required
   if(!verifieNomPrenom(prenom) || !verifieNomPrenom(nom) || !verifieCourriel(courriel) || !verifieTelephone(telephone)/* || !verifieMotDePasse(motDePasse)*/){
     indiqueChampInvalide();
     return false;
   }

   //Les dates sont remplis (les 3)
   if(groupDateEmpty == false){
     if(!verifieJour(jour) || !verifieAnnee(annee)){
       indiqueChampDateInvalide();
       return false;
     }
   }

   //Les input d'adresse sont remplis
   if(groupAdressEmpty == false){
     if(!verifieNomPrenom(rue) || !verifieNomPrenom(ville) || !verifieNoAdresse(noAdresse)){
       indiqueChampAdresseInvalide();
       return false;
     }
   }

   //Le code postal est rempli
   if(codePostalEmpty == false){
     if(!verifieCodePostal(codePostal)){
       indiqueChampCodeInvalide();
       return false;
     }
   }

   // si le courriel entré est différent de celui utilisé
   if(user_courriel != courriel.value){
     // Si le courriel existe déjà dans la BD
     if(courrielExiste()){
       inputRequired(courriel);
       document.getElementById("error-courriel").style.display = "block";
       return false;
     }
   }

  updateProfil();

  return true;
 }

 //Verifie que le nom de famille ou le prenom est valide (Regex)
 function verifieNomPrenom(e){
   var nomRegex = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð,. '-]+$/;
   return nomRegex.test(e.value);
 }

//Verifie que le jour est valide. Si le jour est d'une longueur de 1 ou 2 et que c'est numérique
 function verifieJour(e){
   var jourRegex = /^[0-9]{1,2}$/;
   return jourRegex.test(e.value);
 }

//Valider que l'annee entree contient 4 chiffres et qu'il est numerique
 function verifieAnnee(e){
   var anneeRegex = /^[0-9]{4}$/;
   return anneeRegex.test(e.value);
 }

//Verifier que le courriel est valide
 function verifieCourriel(e){
   var courrielRegex = /^\S+@\S+\.\S+$/;
   return courrielRegex.test(e.value);
 }

//S'assurer que le code postal est valide selon le format Canadien pour l'instant
 function verifieCodePostal(e){
   var codePostalRegex = /^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/;
   return codePostalRegex.test(e.value);
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

 //Verifie si le numero d'adresse est un numero valide
 function verifieNoAdresse(e){
   if(Number.isInteger(parseInt(e.value))){
    return true;
  }
  else{
    return false;
  }
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

/*   if(siVide(motDePasse)){
     inputRequired(motDePasse);
   }
*/
 }

//Indique quels champs sont vide pour la date de naissance
 function indiqueTempsVide(){
   if(siVide(jour)){
     inputRequired(jour);
   }

   if(siSelectVide(mois)){
     inputRequired(mois);
   }

   if(siVide(annee)){
     inputRequired(annee);
   }
 }

//Indique quels champs sont vide pour l'adresse
 function indiqueAdresseVide(){
   if(siVide(noAdresse)){
     inputRequired(noAdresse);
   }

   if(siVide(rue)){
     inputRequired(rue);
   }

   if(siVide(ville)){
     inputRequired(ville);
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

 }

//Si les champs sont remplis, indique lesquels sont invalides
 function indiqueChampDateInvalide(){
   if(!verifieJour(jour)){
     inputRequired(jour);
     jour.value = null;
     jour.placeholder = "Jour invalide *";
   }

   if(!verifieAnnee(annee)){
     inputRequired(annee);
     annee.value = null;
     annee.placeholder = "Année invalide *";
   }
 }

 //Si le champs du code postal est rempli, mais qu'il n'est pas valide
 function indiqueChampCodeInvalide(){
   inputRequired(codePostal);
   codePostal.value = null;
   codePostal.placeholder = "Code postal invalide *";
 }

//Si les champs sont remplis, mais non valide
 function indiqueChampAdresseInvalide(){

   if(!verifieNoAdresse(noAdresse)){
     inputRequired(noAdresse);
     noAdresse.value = null;
     noAdresse.placeholder = "No. invalide *";
   }

   if(!verifieNomPrenom(rue)){
     inputRequired(rue);
     rue.value = null;
     rue.placeholder = "Rue invalide *";
   }

   if(!verifieNomPrenom(ville)){
     inputRequired(ville);
     ville.value = null;
     ville.placeholder = "Ville invalide *";
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
     url: "/Project-Ekah/php/script/Client/siCourrielExiste.php",
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

 // Update le profil du client
 function updateProfil(){
//   if(valideFormProfil() == true){
     var jour = $('#jour').val();
     var mois = $('#mois').val();
     var annee = $('#annee').val();
     var date_naissance = null;



     // Toutes les variables de la date de naissance sont entrées
     if(jour && mois && annee){
       var date_naissance = annee+"-"+mois+"-"+jour;
     }

     var dataClient = {
       id_client: CLIENT.id,
       id_adresse: CLIENT.id_adresse,
       telephone: $('#telephone').val(),
       date_naissance: date_naissance,
       no_civique: $('#noAdresse').val(),
       rue: $('#rue').val(),
       ville: $('#ville').val(),
       code_postal: $('#codePostal').val(),
       pays: $('#pays').val(),
       courriel: $('#courriel').val(),
       nom: $('#nom').val(),
       prenom: $('#prenom').val()
     };

     var dataClientJson = JSON.stringify(dataClient);

     $.ajax({
       url: "/Project-Ekah/php/script/Client/updateProfilClient.php",
       data: {data: dataClientJson},
       async:false,
       success: function(result){
         console.log(result);
         //location.reload();
         //Affiche la fenêtre modale
         $("#modal-inscription").css("display", "block");
       },
     });
   }
//   else{
//     return false;
//   }
// }
