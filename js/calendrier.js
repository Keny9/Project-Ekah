
$(document).ready(function() {
  $( "#month" ).click(function() {
    var $this = $(this);
    calendar.view($this.data('calendar-view'));
  });
  $( "#day" ).click(function() {
    var $this = $(this);
    calendar.view($this.data('calendar-view'));
  });

  $( "#next" ).click(function() {
    var $this = $(this);
    calendar.navigate($this.data('calendar-nav'));

  });
  $( "#prev" ).click(function() {
    var $this = $(this);
    calendar.navigate($this.data('calendar-nav'));
  });

  var i = 0;
  $.each($('.cal-day-hour-part'), function(index, $event){
    var $this = $(this);
    console.log("ID");
    $this.attr('id', i);
    i++;
  });


  $(document).on('click','.cal-day-hour-part', function(){
      var $this = $(this);
      var heureElm = $this.find("b");

      var heure = heureElm.text();
      var date = $(".h3").text();

      console.log(heure);
      console.log(date);

      var couleur = $this.css("background-color");

      if(couleur == "rgba(0, 0, 0, 0)"){
        $this.css("background-color", "green");
        envoyeDispo(heure, date);
      }else{
        $this.css("background-color", "rgba(0, 0, 0, 0)");

        supprimerDispo(heure, date);
      }

   }
  );

});



function envoyeDispo(heure, date){

  var dates = date.split(" ");
  var jour = dates[1];
  var annee = dates[3];
  var mois = convertirMois(dates[2]);

  //Pour avoir l'heure + 30 minutes
  var heures = heure.split(":");
  var moment = new Date(annee, mois, jour, heures[0], heures[1]);
  moment = new Date(moment.getTime() + 30*60000);

  // console.log(moment);

  var heure_debut = heure;
  var heure_fin = "" + moment.getHours() + ":" + moment.getMinutes();

   // console.log(annee + " " + mois + " " + jour + " " + heure_debut + " " + heure_fin);


  $.ajax({
    type: "POST",
    async: false,
    url: "../../php/script/Horaire/ajouterDisponibilite.php",
    data: {"annee": annee,
           "mois": mois,
           "jour": jour,
           "heure_debut": heure_debut,
           "heure_fin": heure_fin
         },
    success: function(result){
        bool = true;
    },
    error: function (jQXHR, textStatus, errorThrown) {
        alert("An error occurred whilst trying to contact the server: " + jQXHR.status + " " + textStatus + " " + errorThrown);
    }
  });
  return bool;
}

function supprimerDispo(heure, date){

  var dates = date.split(" ");
  var jour = dates[1];
  var annee = dates[3];
  var mois = convertirMois(dates[2]);

  //Pour avoir l'heure + 30 minutes
  var heures = heure.split(":");
  var moment = new Date(annee, mois, jour, heures[0], heures[1]);
  moment = new Date(moment.getTime() + 30*60000);

  // console.log(moment);

  var heure_debut = heure;
  var heure_fin = "" + moment.getHours() + ":" + moment.getMinutes();

   // console.log(annee + " " + mois + " " + jour + " " + heure_debut + " " + heure_fin);


  $.ajax({
    type: "POST",
    async: false,
    url: "../../php/script/Horaire/supprimerDisponibilite.php",
    data: {"annee": annee,
           "mois": mois,
           "jour": jour,
           "heure_debut": heure_debut,
           "heure_fin": heure_fin
         },
    success: function(result){
        bool = true;
    },
    error: function (jQXHR, textStatus, errorThrown) {
        alert("An error occurred whilst trying to contact the server: " + jQXHR.status + " " + textStatus + " " + errorThrown);
    }
  });
  return bool;
}



function convertirMois(mois){
  switch(mois) {
  case "January,":
    return "01";
  case "February,":
    return "02";
  case "March,":
    return "03";
  case "April,":
    return "04";
  case "May,":
    return "05";
  case "June,":
    return "06";
  case "July,":
    return "07";
  case "August,":
    return "08";
  case "September,":
    return "09";
  case "October,":
    return "10";
  case "November,":
    return "11";
  case "December,":
    return "12";
  }
}
