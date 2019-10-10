
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
