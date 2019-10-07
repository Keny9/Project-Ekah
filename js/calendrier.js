
$(document).ready(function() {
  $( "#month" ).click(function() {
    alert("Mois");
    var $this = $(this);
    calendar.view($this.data('calendar-view'));
  });
  $( "#day" ).click(function() {
    alert( "Jour" );
    var $this = $(this);
    calendar.view($this.data('calendar-view'));
  });

  $('.btn-group button[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});
});
