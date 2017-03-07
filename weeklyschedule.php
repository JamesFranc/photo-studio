<?php
session_start();
include('create-events-json.php');

include('header.php');

echo "<div class='jumbotron'><h2><i class='fa fa-calendar fa-fw fa-2x'></i>Schedule</h2></div>";

include('buttons.php');

echo "<div>&nbsp;</div>";

?>
<head>
  <meta charset='utf-8' />
  <link href='fullcalendar/fullcalendar.css' rel='stylesheet' />
  <link href='fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
  <script src='fullcalendar/lib/moment.min.js'></script>
  <script src='fullcalendar/lib/jquery.min.js'></script>
  <script src='fullcalendar/fullcalendar.min.js'></script>
  <script>
  $(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      defaultDate: new Date(),
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: {
        url: 'fullcalendar/misc/php/get-events.php',
        error: function() {
          $('#script-warning').show();
        }
      },
      loading: function(bool) {
        $('#loading').toggle(bool);
      }
    });

  });

  </script>
  <style>

  /*body {
    margin: 0;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    /*font-size: 14px;*/
  /*} */

  #script-warning {
    display: none;
    background: #eee;
    border-bottom: 1px solid #ddd;
    padding: 0 10px;
    line-height: 40px;
    text-align: center;
    font-weight: bold;
    font-size: 12px;
    color: red;
  }

  #loading {
    display: none;
    position: absolute;
    top: 10px;
    right: 10px;
  }

  #calendar {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 10px;
  }

  </style>
</head>
<body>

  <div id='script-warning'>
    <code>php/get-events.php</code> must be running.
  </div>

  <div id='loading'>loading...</div>

  <div id='calendar'></div>

</body>
</html>
