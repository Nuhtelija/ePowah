<?php
$title = "Home";
$highhome = "w3-blue";
session_start();
require_once 'nav.php';
?>

<link href='css/fullcalendar.min.css' rel='stylesheet' />
<link href='css/jquery-ui.min.css' rel='stylesheet'/>
<script src='js/moment.min.js'></script>
<script src='js/jquery.min.js'></script>
<script src='js/fullcalendar.min.js'></script>
<script>
    
	$(document).ready(function() {
		$('#calendar').fullCalendar({
            theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listMonth'
			},
			defaultDate: '2017-04-12',
			editable: false,
			eventLimit: true, // allow "more" link when too many events
            timeFormat: 'H(:mm)', // uppercase H for 24-hour clock
			events: "events.php"
            
		});
		
	});

</script>
<style>

	body {
		padding: 0;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: auto;
	}
    

</style>
  
    <br>
	<div id='calendar'></div>

