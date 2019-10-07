
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



});

// Retourne si le courriel entré existe déjà dans la BD
function evenement(){
  alert("evenement");
  var bool = true;
  $.ajax({
    type: "POST",
    async: false,
    url: "../../php/script/Horaire/ajouterHoraire.php",
    data: {
      test: "Test"
  },
    success: function(result){
      alert("Sucess");
    },
    error: function (jQXHR, textStatus, errorThrown) {
        alert("An error occurred whilst trying to contact the server: " + jQXHR.status + " " + textStatus + " " + errorThrown);
    }
  });
}
