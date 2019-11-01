var index = null;
var data = null;

$(document).ready(function(){
  selectedLine = null; //La ligne sélectionné
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

  courriel = document.getElementById("courriel");
  telephone = document.getElementById("telephone");
  codePostal = document.getElementById("codePostal");
  jourE = document.getElementById("jour");
  moisE = document.getElementById("mois"); //C'est un select
  anneeE = document.getElementById("annee");
  adresse = document.getElementById("noAdresse");
  rue = document.getElementById("rue");
  ville = document.getElementById("ville");

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

  jourE.addEventListener("focusout", function(){
    if(verifieJour(jourE)){
      inputUnrequired(jourE, "Jour de naissance");
    }
  });

  anneeE.addEventListener("focusout", function(){
    if(verifieAnnee(anneeE)){
      inputUnrequired(anneeE, "Jour de naissance");
    }
  });

  moisE.addEventListener("focusout", function(){
    if(!siSelectVide(moisE)){
      inputUnrequired(moisE, "Mois");
    }
  });

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

$('#table_client').DataTable({
    "ajax":{
      "url": "../../php/script/Client/getDataClient.php",
      "dataSrc": ""
    },
    "columns" : [
      {"data": "nom"},
      {"data": "prenom"},
      {"data": "courriel"},
      {"data": "telephone"},
      {"data": "date_inscription"},
      {"data": null,
      render: function(data, type, row){
        return '<a href="../admin/consulter-reservation-client.php?id=5" target="_blank"><span class="calendar"></span></a>';
      }},
    ],
    "language":{
      "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
    },
    responsive: false,
  });

  $('#table_client').DataTable().draw();
  jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');

// Sur un clique d'une ligne
  $('#table_client tbody').on('click', 'tr', function (){ //Lors du click sur une ligne du tableau
    $("#profil").slideDown("slow"); //Afficher le block du profil avec une animation
    // Une ligne est selectionnée
    if(selectedLine != null){
      // Il y a eu changement dans les textareas
      if(profilUpdated()){
        // Demande de confirmation de sauvegarde
        if(confirm("Voulez-vous sauvegarder les changements?")){
          updateProfil();
        }
      }
    }

    //Get les données du client et de son profil
    index = $('#table_client').DataTable().cell(this, 0).index();
    data = $('#table_client').DataTable().row(index.row ).data();
    console.log(data);
    //console.log(selectedLine);

    // Set le titre du suivi
    $("#nomClient").text(data.prenom + " " + data.nom);

    // Prépare les données pour la date de naissance
    var annee = jour = date_naissance = null;
    var mois = "vide";
    if(data.date_naissance != null) { // Date naissance n'est pas null
      var date_naissance = data.date_naissance;
      var date_array = date_naissance.split("-");
      var annee = date_array[0];
      var mois = date_array[1];
      var jour = date_array[2];

      if (mois[0] == 0){ // La valeur du mois commence par un 0  (01, 02, ..)
        // Enlève le 0
        mois = mois.slice(1);
      }
    }
    // Set les données du profil du client séléctionné dans les cases
    $('#jour').val(jour);
    $('#mois').val(mois);
    $('#annee').val(annee);
    $('#noAdresse').val(data.no_civique);
    $('#rue').val(data.rue);
    $('#ville').val(data.ville);
    $('#codePostal').val(data.code_postal);
    $('#pays').val(data.pays);
    $('#telephone').val(data.telephone);
    $('#courriel').val(data.courriel);

    courrielValue = data.courriel;

    if(selectedLine != null){

      if(selectedLine.css("background-color") == $(this).css("background-color")){ //La meme ligne est sélectionné
        selectedLine.css("background-color", "#FFFFFF");
        selectedLine = null;
        $("#profil").slideUp("slow"); //Cacher le block du profil avec animation
      }
      else{ //Une autre ligne est sélectionné
        selectedLine.css("background-color", "#FFFFFF");
        $(this).css("background-color", "#b0bed9");
        selectedLine = $(this);
      }
    }
    else{ //Premiere fois qu'on selectionne une ligne
      document.querySelector('#profil').scrollIntoView({ //Animation du scroll au block profil (smooth)
        behavior: 'smooth'
      });
      $(this).css("background-color", "#b0bed9");
      selectedLine = $(this);
    }

  });

});

// Update le profil du client et reload la page
function updateProfil(){

  if(valideFormProfil() == true){
    var date_naissance = null; // TODO: arranger ça

    var dataClient = {
      id_client: data.id,
      id_adresse: data.id_adresse,
      telephone: $('#telephone').val(),
      date_naissance: date_naissance,
      no_civique: $('#noAdresse').val(),
      rue: $('#rue').val(),
      ville: $('#ville').val(),
      code_postal: $('#codePostal').val(),
      pays: $('#pays').val(),
      courriel: $('#courriel').val()
    };

    var dataClientJson = JSON.stringify(dataClient);

    $.ajax({
      url: "../../php/script/Client/updateProfilClient.php",
      data: {data: dataClientJson},
      async:false,
      success: function(result){
        console.log(result);
        location.reload();
      },
    });
  }
  else{
    return false;
  }
}

// Retourne si les champs du profil ont été changés
function profilUpdated(){
  bool = false;
  let lTelephone = $('#telephone').val();
  let lDataTelephone = data.telephone;
  if(!lTelephone) lTelephone = null;
  if(!lDataTelephone) lDataTelephone = null;

  // TODO: comparer la date de naissance
  if(!($('#noAdresse').val() == data.no_civique)){bool = true;}
  if(!($('#rue').val() == data.rue)){bool = true;}
  if(!($('#ville').val() == data.ville)){bool = true;}
  if(!($('#codePostal').val() == data.code_postal)){;bool = true;}
  if(!($('#pays').val() == data.pays)){bool = true;}
  if(!(lTelephone == lDataTelephone)){bool = true;}
  if(!($('#courriel').val() == data.courriel)){bool = true;}

  return bool;
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

//Valider le formulaire de modification du profil
function valideFormProfil(){
  groupDateEmpty = true; //Les dates ne sont pas rempli
  codePostalEmpty = true;
  groupAdressEmpty = true; //Adresse ne sont pas rempli

  //Verification des elements qui sont *required
  if(siVide(courriel) || siVide(telephone)){
    indiqueChampVide();
    document.getElementById("error-blank").style.display = "block";
    return false;
  }

  //Si les 3 ne sont pas vides alors pas d'erreur que c'est vide
  if((!siVide(jourE) && !siSelectVide(moisE) && !siVide(anneeE))){
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
  if((!siVide(jourE) || !siSelectVide(moisE) || !siVide(anneeE)) && groupDateEmpty == true){
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
  if(!verifieCourriel(courriel) || !verifieTelephone(telephone)){
    indiqueChampInvalide();
    return false;
  }

  //Les dates sont remplis (les 3)
  if(groupDateEmpty == false){
    if(!verifieJour(jourE) || !verifieAnnee(anneeE)){
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

  // Si le courriel existe déjà dans la BD
  if($("#courriel").val() != courrielValue){
    if(courrielExiste()){
      inputRequired(courriel);
      document.getElementById("error-courriel").style.display = "block";
      return false;
    }
  }

  return true;
}
/*----------------------------------------FIN DE LA VÉRIFICATION---------------------------*/

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

  //Si les champs sont remplis, indique lesquels sont invalides
   function indiqueChampDateInvalide(){
     if(!verifieJour(jourE)){
       inputRequired(jourE);
       jour.value = null;
       jour.placeholder = "Jour invalide *";
     }

     if(!verifieAnnee(anneeE)){
       inputRequired(anneeE);
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

   //Indique quels champs sont vides à l'utilisateur
    function indiqueChampVide(){
      if(siVide(courriel)){
        inputRequired(courriel);
      }

      if(siVide(telephone)){
        inputRequired(telephone);
      }
    }

   //Indique quels champs sont vide pour la date de naissance
    function indiqueTempsVide(){
      if(siVide(jourE)){
        inputRequired(jourE);
      }

      if(siSelectVide(moisE)){
        inputRequired(moisE);
      }

      if(siVide(anneeE)){
        inputRequired(anneeE);
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
